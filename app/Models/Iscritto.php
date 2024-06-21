<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iscritto extends Model
{
    use HasFactory;
    protected $table = 'iscritto';
    // protected $primaryKey = 'alter_field_as_primary_key';
    // use SoftDeletes;
    // public $timestamps = false;

    protected $fillable = ['nome', 'cognome','cellulare','email'];

    // Method of Author model
    public function iscrizioni()
    {
        // the property $author->books returns an array of Books
        return $this->hasMany(Iscrizione::class,'iscritto_id','id');
    }

    // Method of Author model
    public function address()
    {
        // the property $author->address returns an object of type Address
        return $this->hasOne(Indirizzo::class,'iscritto_id','id');
    }
}
