<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Client;
use App\Models\Formateur;
use App\Models\Module;
use App\Models\Annonce;


class CustomerController extends Controller
{
    public function showFormation(){
        $formations=Formation::with(['modules','formateurs'])
            ->latest()
            ->paginate(9);;
        return view('customer/formations', compact('formations'));
    }

    public function createInscriptions(){
        $formations=Formation::with(['modules','formateurs'])->get();
        return view('customer/inscriptions', compact('formations'));
    }

    public function storeInscription(Request $request){
        // Validation des données soumises
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telephone' => 'nullable|string|max:20',
        'domaine' => 'required|string|max:255',
        'occupation' => 'required|in:Eleve,Etudiant,Jeune Professionel,Chomeur,Professionel experimente',
    ], [
        'nom.required' => 'Le nom est obligatoire.',
        'prenom.required' => 'Le prénom est obligatoire.',
        'email.required' => 'L\'adresse e-mail est obligatoire.',
        'email.email' => 'Veuillez entrer une adresse e-mail valide.',
        'domaine.required' => 'Le domaine d\'activité/études est obligatoire.',
        'occupation.required' => 'Veuillez sélectionner votre occupation.',
        'occupation.in' => 'L\'occupation sélectionnée est invalide.',
    ]);

    // 1. Récupérer ou créer le client avec les nouveaux champs
    $client = DB::table('clients')->where('email', $request->email)->first();

    if (!$client) {
        $clientId = DB::table('clients')->insertGetId([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'domaine' => $request->domaine,
            'occupation' => $request->occupation,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    } else {
        $clientId = $client->id;
        // Mise à jour optionnelle des informations si le client existe déjà
        DB::table('clients')->where('id', $clientId)->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'domaine' => $request->domaine,
            'occupation' => $request->occupation,
            'updated_at' => now(),
        ]);
    }

    // 2. Vérifier si l'inscription existe déjà
    $dejaInscrit = DB::table('formation_clients')
        ->where('formation_id', $formationId)
        ->where('client_id', $clientId)
        ->exists();

    if ($dejaInscrit) {
        return redirect()->back()->with('error', 'Vous êtes déjà inscrit(e) à cette formation !');
    }

    // 3. Associer la formation au client
    DB::table('formation_clients')->insert([
        'formation_id' => $formationId,
        'client_id' => $clientId,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Félicitations ! Votre inscription a bien été enregistrée.');
    
    }


    public function showAnnonces(Request $request){

        $query = Annonce::query();

        // Filtrage par catégorie si sélectionnée
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // Récupérer les annonces avec pagination
        $annonces = $query->latest()->paginate(9);

        // Récupérer la liste des catégories uniques pour le filtre
        $categories = Annonce::whereNotNull('categorie')
            ->distinct()
            ->pluck('categorie');

            return view('customer/annonces', compact('annonces', 'categories'));
    }
}

