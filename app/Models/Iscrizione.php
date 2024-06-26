<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iscrizione extends Model
{
    use HasFactory;
    protected $table = "iscrizione";
    // protected $primaryKey = 'alter_field_as_primary_key';
    // use SoftDeletes;
    // public $timestamps = false;

    protected $fillable = ['id_iscritto', 'tipo_iscrizione', 'tipo_evento'];

    public function iscritti()
    {
        // the property $book->author returns an object of type Author
        return $this->belongsTo(Iscritto::class,'iscritto_id','id');
    }
}

