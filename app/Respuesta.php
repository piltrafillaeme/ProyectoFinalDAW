<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    public $table = "respuestas";

    /* RELACIÓN 1-N CON PREGUNTA */
    public function preguntas() {

        return $this->belongsTo('App\Pregunta');

    }
}
