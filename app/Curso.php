<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $table = 'cursos';

    /* RELACIÓN 1-N CON PROFESOR */
    public function profesores() {

        return $this->belongsTo('App\Profesor');

    }

    /* RELACIÓN 1-N CON ALUMNA */
    public function alumnas() {

        return $this->hasMany('App\Alumna');

    }

    /* RELACIÓN 1-N CON TEMA */
    public function temas() {

        return $this->hasMany('App\Tema');

    }
}
