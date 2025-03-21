<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
     public function oeuvres()
    {
        return $this->hasMany(Oeuvre::class);
    }
}
