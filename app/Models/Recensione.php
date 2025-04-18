<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recensione extends Model
{
    use HasFactory;

    protected $table = 'recensioni';

    protected $fillable = ['id_evento', 'id_utente', 'commento', 'voto'];

    public function utente()
    {
        return $this->belongsTo(Utente::class, 'id_utente');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }
}

