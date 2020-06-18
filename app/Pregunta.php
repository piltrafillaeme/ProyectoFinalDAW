<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public $table = "preguntas";

    /* RELACIÓN 1-N CON RESPUESTA */
    public function respuestas() {
        return $this->hasMany('App\Respuesta');
    }

    /* RELACIÓN 1-N CON TEST */
    public function tests() {

        return $this->belongsTo('App\Test');

    }

}
