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

    protected $fillable = ['indirizzo', 'comune'];

    // Method of Author model
    public function iscritti()
    {
        // the property $author->books returns an array of Books
        return $this->hasMany(Iscritto::class,'iscritto_id','id');
    }
}
