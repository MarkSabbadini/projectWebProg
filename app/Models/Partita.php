<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partita extends Model
{
    /** @use HasFactory<\Database\Factories\PartitaFactory> */
    use HasFactory;

    protected $table = 'partita';

    protected $fillable = ['id_squadra_home','id_squadra_away','goal_home','goal_away','data'];

    public function squadraCasa()
    {
        return $this->belongsTo(Squadra::class, 'id_squadra_home', 'id');
    }

    /**
     * Relazione (N partite : 1 squadra) con la squadra ospite.
     */

    public function squadraOspite()
    {
        return $this->belongsTo(Squadra::class, 'id_squadra_away', 'id');
    }

    /**
     * Relazione (1 partita : N gol) con la tabella 'goal'.
     * 'id_partita' è la colonna FK nella tabella 'goal',
     * 'id' è la PK di questa tabella 'partita'.
     */

    public function goals()
    {
        return $this->hasMany(Goal::class, 'id_partita', 'id');
    }


}
