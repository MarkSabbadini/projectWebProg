<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iscrizione extends Model
{
    use HasFactory;
    protected $table = "iscrizione";

    protected $fillable = ['id_utente','id_evento'];

    public function iscritti()
    {
        // the property $book->author returns an object of type Author
        return $this->belongsTo(Utente::class,'','id');
    }
}

