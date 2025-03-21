<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OeuvreController extends Controller
{
    /**
     * Affiche la liste des œuvres.
     */
    public function index()
    {
        $oeuvres = Oeuvre::with('categorie')->get();
        return view('oeuvres.index', compact('oeuvres'));
    }

    /**
     * Affiche le formulaire de création d'une œuvre.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('oeuvres.create', compact('categories'));
    }

    /**
     * Enregistre une nouvelle œuvre.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'artiste' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'annee_fabrication' => 'required|integer',
            'date_acquisition' => 'required|date',
            'prix_estime' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Gestion de l'upload de la photo
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('oeuvres', 'public');
        }

        Oeuvre::create($data);
        return redirect()->route('oeuvres.index')->with('success', 'Œuvre créée avec succès.');
    }

    /**
     * Affiche les détails d'une œuvre.
     */
    public function show(Oeuvre $oeuvre)
    {
        return view('oeuvres.show', compact('oeuvre'));
    }

    /**
     * Affiche le formulaire de modification d'une œuvre.
     */
    public function edit(Oeuvre $oeuvre)
    {
        $categories = Categorie::all();
        return view('oeuvres.edit', compact('oeuvre', 'categories'));
    }

    /**
     * Met à jour une œuvre existante.
     */
    public function update(Request $request, Oeuvre $oeuvre)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'artiste' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'annee_fabrication' => 'required|integer',
            'date_acquisition' => 'required|date',
            'prix_estime' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Gestion de l'upload de la photo
        if ($request->hasFile('photo')) {
            // Supprime l'ancienne photo si elle existe
            if ($oeuvre->photo) {
                Storage::disk('public')->delete($oeuvre->photo);
            }
            $data['photo'] = $request->file('photo')->store('oeuvres', 'public');
        }

        $oeuvre->update($data);
        return redirect()->route('oeuvres.index')->with('success', 'Œuvre mise à jour avec succès.');
    }

    /**
     * Supprime une œuvre.
     */
    public function destroy(Oeuvre $oeuvre)
    {
        // Supprime la photo si elle existe
        if ($oeuvre->photo) {
            Storage::disk('public')->delete($oeuvre->photo);
        }

        $oeuvre->delete();
        return redirect()->route('oeuvres.index')->with('success', 'Œuvre supprimée avec succès.');
    }
}
