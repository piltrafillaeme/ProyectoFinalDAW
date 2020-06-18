<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    public $table = "profesores";
    
    
    /* RELACIÓN 1-N CON CURSO */
    public function cursos() {

        return $this->hasMany('App\Curso');

    }

    /* RELACIÓN 1-N CON TEMA */
    public function temas() {

        return $this->hasMany('App\Tema');

    }

    /* -------------------------------------------------------------------------- */
    /*                           FUTURA MEJORA - HÁBITOS                          */
    /* -------------------------------------------------------------------------- */

    /* RELACIÓN 1-N CON HABITO */
    public function habitos() {

        return $this->hasMany('App\Habito');
    
    }
}
