<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tercero;
use Response;
use Auth;
use App\Curso;
use App\Tema;
use App\Test;
use App\Pregunta;
use App\Alumna;
use App\Nota;

class terceroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso = Auth::user()->clase;
        $alumnasTercero = Tercero::where('curso_id',$curso)->get();
        
         /* Obtenemos información de los temas del curso correspondiente: */
         $cursoTercero = Curso::find($curso);
         $temasTercero = $cursoTercero->temas;

         return view('alumnas/tercero.index', array('temasTercero'=>$temasTercero, 'curso'=>$cursoTercero ));
    }

    public function vertemas($idCurso)
    {

        /* Obtenemos información de los temas del curso correspondiente: */
        $cursoTercero = Curso::findOrFail($idCurso);
        $temasTercero = $cursoTercero->temas;
        

        return view('alumnas/tercero.vertemas', array('temasTercero'=>$temasTercero));
    }

    public function vernotas($usernameAlumna)
    {
        $alumna = Alumna::where('usuario', $usernameAlumna)->first();
        $curso = Curso::where('id', $alumna->curso_id)->first();
        
        $tests = $alumna->tests;

        $coleccionNombreTests = array();
        $coleccionTemas = array();
        
        if(count($tests) != 0) {
            foreach ($tests as $test) {
                $tema = Tema::findOrFail($test->tema_id);
                
                array_push($coleccionTemas, $tema);
            }
            $idTema = $alumna->tests[0]->tema_id;
            
            
            return view('alumnas/tercero.notas', array('curso' => $curso, 'alumna'=>$alumna, 'tests' => $tests, 'coleccionTemas' => $coleccionTemas));
        } else {
            
            return view('alumnas/tercero.notas', array('curso' => $curso, 'alumna'=>$alumna));
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()) {
            $alumna = Alumna::where('usuario', $request->alumna)->first();

            $test = Test::where('id', $request->test)->first();

            $idTest = $test->id;

            $idTema = $request->tema;

            $notaAlumna = $request->nota;

            $alumna->tests()->attach($idTest, ['nota' => $notaAlumna]);

            $curso = Auth::user()->clase;
            $alumnasTercero = Tercero::where('curso_id',$curso)->get();

        /* Obtenemos información de los temas del curso correspondiente: */
        $cursoTercero = Curso::find($curso);
        $temasTercero = $cursoTercero->temas;
        
        $returnHTML = view('alumnas/tercero.index', ['alumnasTercero'=>$alumnasTercero, 'temasTercero'=>$temasTercero])->render();
        
        $url = '/tercero/'.$idTema;
 
            return response()->json([
                array('success' => true, 'url' =>$url, 'nota' => $notaAlumna,'html' =>$returnHTML)
            ]);
        } else {
            return response()->json([
                array('success' => false, 'url' =>$url, 'nota' => $notaAlumna, 'html' =>$returnHTML)
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tema = Tema::find($id);

        $testsTema = $tema->tests;

        $nombreUsuaria = Auth::user()->username;

        $alumna = Alumna::where('usuario',$nombreUsuaria)->first();

        $notas = Nota::where('alumna_id',$alumna->id)->get();

        $testsHechos = array();
        $notasTestsHechos = array();
        $testsSinHacer = array();

        foreach($testsTema as $test) {
            $notaTest = Nota::where('alumna_id',$alumna->id)->where('test_id',$test->id)->first();
            if(Nota::where('alumna_id',$alumna->id)->where('test_id',$test->id)->first()) {
                array_push($testsHechos, $test);
                $nota = Nota::where('alumna_id',$alumna->id)->where('test_id',$test->id)->first();
                array_push($notasTestsHechos, $nota);
                
            } else {
                array_push($testsSinHacer, $test);
            }
        }

        return view('alumnas/primero.teststema', array('tema'=>$tema, 'testsTema'=>$testsTema, 'testsHechos'=>$testsHechos, 'testsSinHacer'=>$testsSinHacer, 'notasTestsHechos'=>$notasTestsHechos));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function vertest($id)
    {
        /* Busco el test que tenga como id el que le paso por parámetro: */
        $test = Test::find($id);
       
        /* Busco las preguntas de ese test en concreto (gracias a la relación N-N entre ambas tablas): */
        $buscandoPreguntas = $test->preguntas;
        
        /* Creo arrays donde guardaré toda la información encontrada para luego enviarla a la vista: */
        $coleccionPreguntas = array();
        $coleccionRespuestas = array();
        
        /* Para cada una de las preguntas, necesito recoger las respuestas que tiene cada pregunta: */
        foreach ($buscandoPreguntas as $preguntita) {
            
            /* Guardo información de cada pregunta que haya: */
            $pregunta = Pregunta::find($preguntita->id);

            array_push($coleccionPreguntas, $preguntita);

            /* Según cada pregunta, busco sus respectivas respuestas: */
            $buscandoRespuestas = $pregunta->respuestas;
            
            foreach ($buscandoRespuestas as $value) {

                array_push($coleccionRespuestas, $value);
             
            }
            /* dd($coleccionRespuestas); */
        }
        
         /* Información extra para mostrar en la vista: */
         $tema = Tema::find($test->tema_id);
         $curso = Curso::find($tema->curso_id);

        return view('alumnas/tercero.vertest', array('coleccionPreguntas' => $coleccionPreguntas, 'coleccionRespuestas' => $coleccionRespuestas, 'test' => $test, 'curso' => $curso, 'tema'=>$tema));
    }
}
