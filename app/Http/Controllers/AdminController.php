<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Client;
use App\Models\Formateur;
use App\Models\Module;
use App\Models\Annonce;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;

class AdminController extends Controller
{
    public function renderOverview()
    {
        // 1. Statistiques Clés (KPIs)
        $stats = [
            'formations_disponibles' => Formation::where('disponible', 'oui')->count(), 
            'total_clients'          => Client::count(), 
            'total_formateurs'       => Formateur::count(), 
            'total_annonces'         => Annonce::count(), 
        ];

        // 2. Derniers Clients Inscrits (avec leurs formations associées)
        $recentClients = Client::with('formations') // relation BelongsToMany avec Formation
            ->latest()
            ->take(6)
            ->get();

        // 3. Dernières Annonces Publiées
        $recentAnnonces = Annonce::latest() 
            ->take(4)
            ->get();

        // 4. Formations à venir ou récentes
        $recentFormations = Formation::withCount(['clients', 'modules']) 
            ->latest()
            ->take(5)
            ->get();

        // 5. Répartition des Clients par Occupation (pour graphiques/stats)
        $occupations = Client::selectRaw('occupation, count(*) as total') 
            ->groupBy('occupation')
            ->pluck('total', 'occupation');

        return view('admin.overview', compact(
            'stats',
            'recentClients',
            'recentAnnonces',
            'recentFormations',
            'occupations'
        ));
    }


    public function renderFormations(){
        try {
            $formations = Formation::with(['formateurs', 'modules'])->latest()->get();
            return view('admin/formations/formations_index', compact('formations'));
        } catch (Exception $e) {
            return back()->with('error', 'Erreur lors du chargement des formations : ' . $e->getMessage());
        }
    }

    public function createFormation(){
        $formateurs=Formateur::get();
        return view('admin/formations/formation_create', compact('formateurs'));
    }

    public function storeFormation(Request $request)
    {
        $validated = $request->validate([
            'intitule'     => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categorie'    => 'nullable|string|max:255',
            'prix'         => 'required|integer|min:0',
            'disponible'   => 'required|in:oui,non',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after_or_equal:date_debut',
            'formateurs'   => 'nullable|array',
            'formateurs.*' => 'exists:formateurs,id',
            'modules'      => 'nullable|array',
            'modules.*'    => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // 1. Calcul automatique de la durée (en jours)
            $debut = Carbon::parse($request->date_debut);
            $fin = Carbon::parse($request->date_fin);
            $validated['duree'] = $debut->diffInDays($fin);

            // 2. Gestion de l'upload d'image
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('formations', 'public');
            }

            // 3. Création de la formation
            $formation = Formation::create($validated);

            // 4. Synchronisation des formateurs (relation Many-to-Many)
            if ($request->filled('formateurs')) {
                $formation->formateurs()->sync($request->formateurs);
            }

            // 5. Enregistrement des modules associés dans la table 'modules'
            if ($request->has('modules')) {
                // Filtrer les entrées vides ou composées d'espaces
                $modulesToInsert = array_filter(array_map('trim', $request->modules));

                if (!empty($modulesToInsert)) {
                    // Préparation du tableau pour la création groupée via la relation Eloquent
                    $formattedModules = array_map(function ($nom) {
                        return ['nom' => $nom];
                    }, $modulesToInsert);

                    // Insertion directe liée à la formation (associe automatiquement formation_id)
                    $formation->modules()->createMany($formattedModules);
                }
            }

            DB::commit();
            return redirect()->route('formations.index')->with('success', 'Formation créée avec succès.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Erreur lors de la création de la formation : ' . $e->getMessage());
        }
    }

    public function editFormation($id){
        try {
            $formation = Formation::with(['formateurs', 'modules'])->findOrFail($id); 
            $formateurs = Formateur::get(); 
            $modules = Module::get(); 
            return view('admin.formations.edit', compact('formation', 'formateurs', 'modules'));
        } catch (Exception $e) {
            return redirect()->route('formations.index')->with('error', 'Formation introuvable ou erreur : ' . $e->getMessage());
        }
    }

    public function updateFormation(Request $request, $id)
    {
        // 1. Validation des champs transmis par le formulaire
        $validated = $request->validate([
            'intitule'     => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categorie'    => 'nullable|string|max:255',
            'prix'         => 'required|numeric|min:0',
            'disponible'   => 'required|in:oui,non',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after_or_equal:date_debut',
            'formateurs'   => 'nullable|array',
            'formateurs.*' => 'exists:formateurs,id',
            'modules'      => 'nullable|array',
            'modules.*'    => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $formation = Formation::findOrFail($id);

            // 2. Calcul automatique de la durée (en jours)
            $debut = Carbon::parse($validated['date_debut']);
            $fin = Carbon::parse($validated['date_fin']);
            $validated['duree'] = $debut->diffInDays($fin);

            // 3. Gestion de l'image
            if ($request->hasFile('image')) {
                if ($formation->image && Storage::disk('public')->exists($formation->image)) {
                    Storage::disk('public')->delete($formation->image);
                }
                $validated['image'] = $request->file('image')->store('formations', 'public');
            }

            // 4. Mise à jour des informations
            $formation->update($validated);

            // 5. Synchronisation des formateurs dans la table pivot
            $formation->formateurs()->sync($request->input('formateurs', []));

            // 6. Mise à jour des modules
            $formation->modules()->delete();

            if ($request->has('modules')) {
                $modulesToInsert = array_filter(array_map('trim', $request->modules));

                if (!empty($modulesToInsert)) {
                    $formattedModules = array_map(function ($nom) {
                        return ['nom' => $nom];
                    }, $modulesToInsert);

                    $formation->modules()->createMany($formattedModules);
                }
            }

            DB::commit();
            return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Redirection avec le message d'erreur d'exception
            return back()->withInput()->with('error', 'Erreur lors de la modification : ' . $e->getMessage());
        }
    }

    public function destroyFormation($id)
    {
        try {
            $formation = Formation::findOrFail($id);

            if ($formation->image && Storage::disk('public')->exists($formation->image)) {
                Storage::disk('public')->delete($formation->image);
            }

            $formation->delete();
            return redirect()->route('formations.index')->with('success', 'Formation supprimée avec succès.');
        } catch (Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }


    public function renderFormateurs(){
        try {
            // Charger les formateurs avec leurs formations associées (si la relation existe)
            $formateurs = Formateur::with('formations')->latest()->get();
            return view('admin/formateurs/formateurs_index', compact('formateurs'));
        } catch (Exception $e) {
            return back()->with('error', 'Erreur lors du chargement des formateurs : ' . $e->getMessage());
        }
    }

    public function createFormateur(){
        return view('admin/formateurs/formateurs_create');
    }
    
    public function storeFormateur(Request $request){
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:formateurs,email',
            'qualification' => 'required|string|max:255',
        ]);

        try{
            DB::table('formateurs')->insert([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'qualification' => $request->input('qualification'),
        ]);

        return back()->withInput()->with('success_add', 'Formateur ajoute avec succes!');

        }  catch (\Exception $e) {
            // Log actual error for debugging
            Log::error('Formateur creation failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'ajout du formateur.'. $e->getMessage());
        } 
        
    }

    public function editFormateur($id){
        try {
            $formateur = Formateur::findOrFail($id);
            return view('admin.formateurs.edit', compact('formateur'));
        } catch (Exception $e) {
            return redirect()->route('formateurs.index')->with('error', 'Formateur introuvable : ' . $e->getMessage());
        }
    }

    public function updateFormateur(Request $request, $id){
        $validated = $request->validate([
            'nom'           => 'required|string|max:255',
            'prenom'        => 'required|string|max:255',
            'email'         => 'required|email|unique:formateurs,email,' . $id . '|max:255',
            'qualification' => 'required|string|max:255',
        ]);

        try {
            $formateur = Formateur::findOrFail($id);
            $formateur->update($validated);

            return redirect()->route('formateurs.index')->with('success', 'Formateur mis à jour avec succès.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Erreur lors de la modification : ' . $e->getMessage());
        }
    }

    public function destroyFormateur($id)
    {
        try {
            $formateur = Formateur::findOrFail($id);
            $formateur->delete();

            return redirect()->route('formateurs.index')->with('success', 'Formateur supprimé avec succès.');
        } catch (Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }


    public function renderModules(){
        $formations=DB::table('formations')->get();
        $modules = DB::table('modules')->get();
        return view('admin/modules', compact(['modules','formations']));
    }

    public function storeModule(Request $request){
        $request->validate([
            'nom' => 'required|string|max:255',
            'formation_id' => 'required|exists:formations,id',
        ]);

        try{
            DB::table('modules')->insert([
            'nom' => $request->input('nom'),
            'formation_id' => $request->input('formation_id'),
        ]);

        return back()->withInput()->with('success_add', 'Module ajoute avec succes!');

        }catch (\Exception $e) {
            // Log actual error for debugging
            Log::error('Module creation failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'ajout du module.'. $e->getMessage());
        }

        
    }

   

    public function renderInscriptions(){
        $inscriptions = DB::table('inscriptions')->get();
        return view('admin/inscriptions', compact('inscriptions'));
    }

    public function renderAnnonces(){
        return view('admin/annonces');
    }


}
