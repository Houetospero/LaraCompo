<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OeuvreController;
use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', [HomeController::class, 'accueil']);

// Routes pour les catégories (en utilisant Route::resource)
Route::resource('categories', CategorieController::class)->except(['show']);

// Routes pour les œuvres (déjà correctement définies)
Route::resource('oeuvres', OeuvreController::class);
