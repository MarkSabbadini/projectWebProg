<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iscritto extends Model
{
    use HasFactory;
    protected $table = 'iscritto';
 
    protected $fillable = ['nome', 'cognome','cellulare','email'];

    // Metodi per andare a gestire le "associazioni"
    public function iscrizioni()
    {
        
        return $this->hasMany(Iscrizione::class,'iscritto_id','id');
    }

    public function address()
    {
        
        return $this->hasOne(Indirizzo::class,'iscritto_id','id');
    }
}
