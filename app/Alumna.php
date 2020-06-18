<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumna extends Model
{
    public $table = "alumnas";
    
    protected $fillable = [
        'nombrealumna', 'apellidoalumna', 'usuario', 'passwordalumna', 'curso_id', 'letra', 
    ]; 

    /* RELACIÓN 1-N CON CURSO */
    public function cursos() {

        return $this->belongsTo('App\Curso');

    }

    /* RELACIÓN N-N CON TESTS */
    public function tests() {
        return $this->belongsToMany('App\Test', 'alumna_test')
                    ->withPivot('nota')
                    ->withTimestamps();
    }

    /* -------------------------------------------------------------------------- */
    /*                           FUTURA MEJORA - HÁBITOS                          */
    /* -------------------------------------------------------------------------- */

    /* RELACIÓN N-N CON HÁBITOS*/
    public function habitos() {

        return $this->belongsToMany('App\Habito');
        
    }
}
