<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $table = "tests";
    
    /* RELACIÓN 1-N CON TEMA */
    public function temas() {

        return $this->belongsTo('App\Tema');

    }

    /* RELACIÓN 1-N CON PREGUNTA */
    public function preguntas() {
        
        return $this->hasMany('App\Pregunta');
    }

    /* RELACIÓN N-N CON ALUMNAS */
    public function alumnas() {
        
        return $this->belongsToMany('App\Alumna', 'alumna_test')
                    ->withPivot('nota')
                    ->withTimestamps();
                    
    }


}
