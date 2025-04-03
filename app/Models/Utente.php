<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    use HasFactory;
    protected $table = 'utente';

    protected $fillable = ['user_id','nome', 'cognome', 'cellulare', 'email', 'via', 'comune', 'provincia', 'nazione'];

    // Metodi per andare a gestire le "associazioni"
    public function iscrizioni()
    {

        return $this->belongsToMany(Evento::class, 'iscrizione', 'id_utente', 'id_evento');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
