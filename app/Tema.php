<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{

    public $table = "temas";

    protected $fillable = [
    
        'nombretema', 'curso_id',
    
    ];
    
    /* RELACIÓN 1-N CON CUESTIONARIO */
    public function tests() {

        return $this->hasMany('App\Test');

    }

    /* RELACIÓN 1-N CON PROFESOR */
    public function profesores() {

        return $this->belongsTo('App\Profesor');

    }

    /* RELACIÓN 1-N CON CURSO */
    public function cursos() {

        return $this->belongsTo('App\Curso');

    }

}
