@extends('layout.admin')

@section('title', 'Ajouter une œuvre')

@section('content')
<div class="container">
    <h1 class="my-4">Ajouter une œuvre</h1>
    <form action="{{ route('oeuvres.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="artiste">Artiste</label>
            <input type="text" name="artiste" id="artiste" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="categorie_id">Catégorie</label>
            <select name="categorie_id" id="categorie_id" class="form-control" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="annee_fabrication">Année de fabrication</label>
            <input type="number" name="annee_fabrication" id="annee_fabrication" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="date_acquisition">Date d'acquisition</label>
            <input type="date" name="date_acquisition" id="date_acquisition" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="prix_estime">Prix estimé</label>
            <input type="number" step="0.01" name="prix_estime" id="prix_estime" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
