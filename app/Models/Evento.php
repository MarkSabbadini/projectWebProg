<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'evento';

    protected $fillable = ['nome','edizione','tipo','descrizione','locandina'];

    public function iscritti()
    {
        
        return $this->belongsToMany(Utente::class,'iscrizione','id_evento','id_utente');
    }
}
