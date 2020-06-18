<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habito extends Model
{

    /* -------------------------------------------------------------------------- */
    /*                           FUTURA MEJORA - HÁBITOS                          */
    /* -------------------------------------------------------------------------- */
    
    public $table = "habitos";
    
    /* RELACIÓN 1-N CON PROFESOR */
    public function profesores() {

        return $this->belongsTo('App\Profesor');

    }

    /* RELACIÓN N-N CON ALUMNA */
    public function alumnas() {

        return $this->belongsToMany('App\Alumna');

    } 
}
