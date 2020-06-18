<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Curso;
use App\Tema;
use App\Nota;
use App\Pregunta;
use App\Respuesta;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::all();

        return view('profesor/tests.index', compact('cursos'));

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
        $input = $request->input();

        $nuevoTest = new Test();
        $nuevoTest->nombretest = $request->nombretest;
        $nuevoTest->tema_id = $request->tema;
        $nuevoTest->save();
        $curso = $request->curso;

        return redirect()->route('tests.testscurso', $curso)->with('datos-guardados', 'Registro guardado correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::find($id);

        $buscandotemas = $curso->temas;
        $coleccionTemas = array();
        $coleccionTests = array();
        
        foreach ($buscandotemas as $temita) {
            
            $tema = Tema::find($temita->id);

            array_push($coleccionTemas, $temita);

            $buscandotest = $tema->tests;
            $ordenadosTest = $buscandotest->sortBy('created_at');
            
            foreach ($ordenadosTest as $value) {

                
                array_push($coleccionTests, $value);
             
            }

        }

        return view('profesor/tests.testscurso', array('coleccionTemas' => $coleccionTemas, 'coleccionTests' => $coleccionTests, 'tema' => $tema,'curso' => $curso));
    }

    /* FUnción hecha para editar aspectos generales de un test en concreto (nombre, curso...) */
    public function editartest($id) {

        $test = Test::findOrFail($id);
        
        $idtema = $test->tema_id;

        $temaCorrespondiente = Tema::find($idtema);

        $idcurso = $temaCorrespondiente->curso_id;

        $cursoCorrespondiente = Curso::find($idcurso);
       
        $buscandotemas = $cursoCorrespondiente->temas;
        $coleccionTemas = array();
        $coleccionTests = array();
        
        foreach ($buscandotemas as $temita) {
            
            $tema = Tema::find($temita->id);

            array_push($coleccionTemas, $temita);
            
            $buscandotest = $tema->tests;
            
            foreach ($buscandotest as $value) {

                array_push($coleccionTests, $value);
             
            }
           
        }

        if(count($coleccionTests) != 0) {
            return view('profesor/tests.testscurso', array('status'=>200,'editar' => 'si','test'=>$test, 'coleccionTemas' => $coleccionTemas, 'coleccionTests' => $coleccionTests, 'tema' => $tema,'curso' => $cursoCorrespondiente));
        } else {
            
            return view('profesor/tests.testscurso', array('status'=>404, 'test'=>$test, 'coleccionTemas' => $coleccionTemas, 'coleccionTests' => $coleccionTests, 'tema' => $tema,'curso' => $cursoCorrespondiente));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        /* LO SIGUIENTE ES RECIBIENDO EL IDENTIFICADOR DEL TEST:
        $editarTest = Test::find($id);

        $listadoPreguntas = $editarTest->preguntas;
        $listadoRespuestas = array();

        foreach ($listadoPreguntas as $pregunta) {
            $idpregunta = Pregunta::find($pregunta->id);

            $buscandoRespuestas = $idpregunta->respuestas;

            array_push($listadoRespuestas, $buscandoRespuestas);
        }

        return view('profesor/tests.edit', array('editarTest'=>$editarTest, 'listadoPreguntas'=>$listadoPreguntas, 'listadoRespuestas'=>$listadoRespuestas)); */
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
   
        $test = Test::findOrFail($id);
        $idtema = $test->tema_id;
        
        $temaCorrespondiente = Tema::find($idtema);

        $idcurso = $temaCorrespondiente->curso_id;

        $test->nombretest = $request->nombretest;
        $test->tema_id = $request->tema;
        $test->save();

        return redirect()->route('tests.testscurso', $idcurso)->with('datos-actualizados', 'Registro editado correctamente.', 'curso', $idcurso);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         /* Información relativa al test que queremos eliminar en concreto: */
         $eliminarTest = Test::findOrFail($id);

         $eliminarPreguntas = $eliminarTest->preguntas;

         foreach ($eliminarPreguntas as $pregunta) {
             $eliminarRespuestas = $pregunta->respuestas;
             /* Borramos las respuestas de cada pregunta: */
             foreach ($eliminarRespuestas as $respuesta) {
                 $respuesta->delete();
             }
             /* Borramos la pregunta: */
             $pregunta->delete();
         }

         $eliminarTest->delete();

        /* Información que debemos mandar a la vista para que se sigan visualizando el resto de tests */
        /* Necesito saber a qué curso pertenece el test: */
        $idTema = $eliminarTest->tema_id;
        $tema = Tema::findOrFail($idTema);
        $idCurso = $tema->curso_id;
        $curso = Curso::findOrFail($idCurso);

        /* Busco todos los test que pertenezcan a los temas del curso en cuestión: */
        $buscandotemas = $curso->temas;
        $coleccionTemas = array();
        $coleccionTests = array();
        
        foreach ($buscandotemas as $temita) {
            
            $tema = Tema::find($temita->id);

            array_push($coleccionTemas, $temita);
            
            $buscandotest = $tema->tests;
            
            foreach ($buscandotest as $value) {

                array_push($coleccionTests, $value);
             
            }
        }

        return redirect()->route('tests.testscurso', $idCurso)->with('datos-eliminados', 'Registro editado correctamente.', array('coleccionTemas' => $coleccionTemas, 'coleccionTests' => $coleccionTests, 'eliminarTest'=>$eliminarTest, 'tema' => $tema,'curso' => $curso));
    }

    public function confirm($id) {

        /* Información relativa al test que queremos eliminar en concreto: */
        $eliminarTest = Test::findOrFail($id);

        $hayNotas = $eliminarTest->alumnas;

        $preguntasTest = $eliminarTest->preguntas;

        /* Información que debemos mandar a la vista para que se sigan visualizando el resto de tests */
        /* Necesito saber a qué curso pertenece el test: */
        $idTema = $eliminarTest->tema_id;
        $tema = Tema::findOrFail($idTema);
        $idCurso = $tema->curso_id;
        $curso = Curso::findOrFail($idCurso);

        /* Busco todos los test que pertenezcan a los temas del curso en cuestión: */
        $buscandotemas = $curso->temas;
        $coleccionTemas = array();
        $coleccionTests = array();
        
        foreach ($buscandotemas as $temita) {
            
            $tema = Tema::find($temita->id);

            array_push($coleccionTemas, $temita);
            
            $buscandotest = $tema->tests;
            
            foreach ($buscandotest as $value) {

                array_push($coleccionTests, $value);
             
            }
           
        }
        
        if(count($coleccionTests) != 0 && count($hayNotas) == 0) {

            return view('profesor/tests.testscurso', array('status'=>200, 'eliminar' => 'si','coleccionTemas' => $coleccionTemas, 'coleccionTests' => $coleccionTests, 'eliminarTest'=>$eliminarTest, 'tema' => $tema,'curso' => $curso));
        
        } else if (count($coleccionTests) != 0 && count($hayNotas) != 0) {
        
            return view('profesor/tests.testscurso', array('status'=>200, 'eliminarConNotas' => 'si','coleccionTemas' => $coleccionTemas, 'coleccionTests' => $coleccionTests, 'eliminarTest'=>$eliminarTest, 'tema' => $tema,'curso' => $curso));
        
        }else {
        
            return view('profesor/tests.testscurso', array('coleccionTemas' => $coleccionTemas, 'coleccionTests' => $coleccionTests, 'tema' => $tema,'curso' => $curso));
        
        }
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

        }
        
         /* Información extra para mostrar en la vista: */
         $tema = Tema::find($test->tema_id);
         $curso = Curso::find($tema->curso_id);

        return view('profesor/tests.vertest', array('coleccionPreguntas' => $coleccionPreguntas, 'coleccionRespuestas' => $coleccionRespuestas, 'test' => $test, 'curso' => $curso));
    }

    public function createst($id) {
        $curso = Curso::find($id);
        $temasDelCurso = $curso->temas;
        return view('profesor/tests.createst', array('curso'=>$curso, 'temasDelCurso'=>$temasDelCurso));
    }

    public function vernotas($id) {

        $test = Test::find($id);

        /* Información extra para mostrar en la vista: */
        $tema = Tema::find($test->tema_id);
        $curso = Curso::find($tema->curso_id);
        $alumnas = $test->alumnas;
        
        $alumnasOrdenadas = $alumnas->sortBy('apellidoalumna');
        $alumnasA = array();
        $alumnasB = array();

        foreach($alumnasOrdenadas as $alumna) {
            if($alumna->letra == 'A') {
                array_push($alumnasA, $alumna);
            }
            if($alumna->letra == 'B') {
                array_push($alumnasB, $alumna);
            }
        }

        if(count($alumnasA) != 0 || count($alumnasB) != 0) {
            return view('profesor/tests.vernotas', array('test'=>$test, 'tema'=>$tema, 'curso'=>$curso, 'alumnasA'=>$alumnasA,'alumnasB'=>$alumnasB,'alumnas'=>$alumnasOrdenadas));
        }else {
            return view('profesor/tests.vernotas', array('test'=>$test, 'tema'=>$tema, 'curso'=>$curso));
        }
    }



}
