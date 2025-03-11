<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calciatore extends Model
{
    /** @use HasFactory<\Database\Factories\CalciatoreFactory> */
    use HasFactory;

    protected $table = 'calciatore';
 
    protected $fillable = ['nome_squadra','nome','cognome','numero','ruolo'];

    public function squadra()
{
    return $this->belongsTo(Squadra::class, 'nome_squadra', 'nome');
}
}
