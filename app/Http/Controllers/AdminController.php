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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

    public function renderInscriptions()
    {
        $inscriptions = DB::table('formation_clients')
            ->join('clients', 'formation_clients.client_id', '=', 'clients.id')
            ->join('formations', 'formation_clients.formation_id', '=', 'formations.id')
            ->select(
                'formation_clients.id as inscription_id',
                'formation_clients.created_at as date_inscription',
                'clients.id as client_id',
                'clients.nom',
                'clients.prenom',
                'clients.email',
                'clients.telephone',
                'formations.intitule as formation_intitule'
            )
            ->orderBy('formation_clients.created_at', 'desc')
            ->get();

        return view('admin/inscriptions/inscriptions', compact('inscriptions'));
    }

    public function destroyInscription($id)
    {
        DB::table('formation_clients')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'L\'inscription de l\'élève a été retirée avec succès.');
    }


    public function renderAnnonces(){
        $annonces=Annonce::latest()->get();
        return view('admin/annonces/index', compact('annonces'));
    }

    public function createAnnonces(){
        return view("admin/annonces/create");
    }

    public function storeAnnonce(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'categorie.required' => 'La catégorie est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ]);

        $data = [
            'titre' => $request->titre,
            'categorie' => $request->categorie,
            'description' => $request->description,
        ];

        // Traitement et sauvegarde de l'image si elle est présente
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('annonces', 'public');
            $data['image'] = $path;
        }

        Annonces::create($data);

        return redirect()->route('annonces.index')->with('success', 'Annonce créée avec succès.');
    }

    public function updateAnnonce(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $annonce = Annonce::findOrFail($id);
        
        $data = [
            'titre' => $request->titre,
            'description' => $request->description,
            'categorie' => $request->categorie,
        ];

        // Traitement de l'image si une nouvelle image est téléchargée
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('annonces', 'public');
            $data['image'] = $path;
        }

        $annonce->update($data);
        return redirect()->back()->with('success', 'Annonce mise à jour avec succès.');
    }

    public function destroyAnnonce($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();
        return redirect()->back()->with('success', 'Annonce supprimée avec succès.');
    }

    public function renderSettings()
    {
        $admin = Auth::user(); // Récupère l'administrateur connecté
        
        return view('admin.settings', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        // Vérification de l'ancien mot de passe si changement demandé
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
            }
            $admin->password = Hash::make($request->new_password);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }

    


}
