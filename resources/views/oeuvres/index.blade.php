@extends('layout.admin')

@section('title', 'Liste des œuvres')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des œuvres</h1>
    <a href="{{ route('oeuvres.create') }}" class="btn btn-primary mb-3">Ajouter une œuvre</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Artiste</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($oeuvres as $oeuvre)
                <tr>
                    <td>{{ $oeuvre->titre }}</td>
                    <td>{{ $oeuvre->artiste }}</td>
                    <td>{{ $oeuvre->categorie->nom }}</td>
                    <td>
                        <a href="{{ route('oeuvres.edit', $oeuvre->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('oeuvres.destroy', $oeuvre->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
