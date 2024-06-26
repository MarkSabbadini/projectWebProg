<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indirizzo extends Model
{
    use HasFactory;
    protected $table = 'indirizzo';
    // protected $primaryKey = 'alter_field_as_primary_key';
    // use SoftDeletes;
    // public $timestamps = false;

    protected $fillable = ['via_civico', 'comune', 'provincia'];

    // Possiamo avere 2 iscritti con stesso indirizzo!
    public function iscritto()
    {
        // the property $address->author returns an object of type Author
        return $this->belongsToMany(Iscritto::class,'iscritto_id','id');
    }
}
