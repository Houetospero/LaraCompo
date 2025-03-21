@extends('layout.admin')

@section('title', 'Modifier une œuvre')

@section('content')
<div class="container">
    <h1 class="my-4">Modifier l'œuvre</h1>
    <form action="{{ route('oeuvres.update', $oeuvre->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ $oeuvre->titre }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="artiste">Artiste</label>
            <input type="text" name="artiste" id="artiste" class="form-control" value="{{ $oeuvre->artiste }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="categorie_id">Catégorie</label>
            <select name="categorie_id" id="categorie_id" class="form-control" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $oeuvre->categorie_id == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="annee_fabrication">Année de fabrication</label>
            <input type="number" name="annee_fabrication" id="annee_fabrication" class="form-control" value="{{ $oeuvre->annee_fabrication }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="date_acquisition">Date d'acquisition</label>
            <input type="date" name="date_acquisition" id="date_acquisition" class="form-control" value="{{ $oeuvre->date_acquisition }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="prix_estime">Prix estimé</label>
            <input type="number" step="0.01" name="prix_estime" id="prix_estime" class="form-control" value="{{ $oeuvre->prix_estime }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $oeuvre->description }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
            @if($oeuvre->photo)
                <img src="{{ asset('storage/' . $oeuvre->photo) }}" alt="Photo de l'œuvre" width="100" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
