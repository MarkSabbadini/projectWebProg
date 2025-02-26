<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    use HasFactory;
    protected $table = 'iscritto';
 
    protected $fillable = ['nome', 'cognome','cellulare','email','via','civico','comune','provincia','nazione'];

    // Metodi per andare a gestire le "associazioni"
    public function iscrizioni()
    {
        
        return $this->belongsToMany(Iscrizione::class,'id_utente','id');
    }

}
