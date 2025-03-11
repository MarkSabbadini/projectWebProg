<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    /** @use HasFactory<\Database\Factories\GoalFactory> */
    use HasFactory;

    protected $table = 'goal';

    protected $fillable = ['id_marcatore','id_partita','minuto'];

    /**
     * Relazione (N goal : 1 partita).
     * 'id_partita' è la colonna FK in questa tabella 'goal',
     * 'id' la PK di 'partita'.
     */
    public function partita()
    {
        return $this->belongsTo(Partita::class, 'id_partita', 'id');
    }

    /**
     * Relazione (N goal : 1 calciatore).
     * 'id_marcatore' è la colonna FK in questa tabella,
     * 'id' la PK di 'calciatore'.
     */
    public function calciatore()
    {
        return $this->belongsTo(Calciatore::class, 'id_marcatore', 'id');
    }


}
