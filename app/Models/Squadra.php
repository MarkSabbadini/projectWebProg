<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squadra extends Model
{

    use HasFactory;
    protected $table = 'squadra';
 
    protected $fillable = ['nome'];

    // Metodi per andare a gestire le "associazioni"

    public function calciatori()
{
    return $this->hasMany(Calciatore::class, 'nome_squadra', 'nome');
}



}

