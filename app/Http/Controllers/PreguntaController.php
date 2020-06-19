<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Test;
use App\Curso;
use App\Tema;
use App\Pregunta;
use App\Respuesta;

class PreguntaController extends Controller
{
    public function creapregunta($id)
    {
        $test = Test::findOrFail($id);
        /* dd($test); */
        $temaTest = Tema::findOrFail($test->tema_id);
        /* dd($temaTest); */

        $curso = Curso::findOrfail($temaTest->curso_id);
        /* dd($curso); */

        return view('profesor/tests/preguntas.creapregunta', array('test'=>$test, 'curso' => $curso));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $cursos = Curso::all(); */
        /* dd($curso); */
        
        
        /*dd($collecionExamen); */
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
        
        /* dd($request); */
      
        /* Validamos que los datos sean correctos: */
        $correcta = 0;
        $incorrecta = 0;
        if($request->respuestaCorrecta1 == 'N') {

            $incorrecta++;

        } else {

            $correcta++;

        }
        
        if($request->respuestaCorrecta2 == 'N') {
            $incorrecta++;
        } else {
            $correcta++;
        }
        if($request->respuestaCorrecta3 == 'N') {
            $incorrecta++;
        } else {
            $correcta++;
        }

        
        if($correcta != 1 && $incorrecta != 2) {
            return back()->withInput($request->input())->with('una-correcta', 'Solo puede tener una respuesta correcta');
        }

        if($request->respuestaCorrecta1 == 'N' && $request->respuestaCorrecta2 == 'N' && $request->respuestaCorrecta3 == 'N') {

            return back()->withInput($request->input())->with('todas-incorrectas', 'Debe elegir alguna respuesta correcta');
        }

        /* if($request->pregunta == null || $request->solucionPregunta1 == null || $request->solucionPregunta2 == null || $request->solucionPregunta3 == null) {
           
               return back()->withInput($request->input())->with('no-validacion', '');
        } */

        $validator = Validator::make($request->only('pregunta','solucionPregunta1','solucionPregunta2','solucionPregunta3'), [
            'pregunta' => 'required|string',
            'solucionPregunta1' => 'required|string',
            'solucionPregunta2' => 'required|string',
            'solucionPregunta3' => 'required|string',
        ]);
        /* Si falla la validación, nos lleva al index y nos muestra mensaje de error */
        if($validator->fails()) {
            
            /* return redirect()->route('alumnaprimero.index')->withErrors($validator)->withInput(); */
            return redirect()->route('preguntas.creapregunta', $request->test)->with('no-validacion', '');
        }

        $curso = $request->curso;
        
        /* Creamos nueva pregunta: */
        $nuevaPregunta = new Pregunta();
        $identificadorTest = $request->test;
        /* Guardamos el enunciado para trabajar con esta pregunta más tarde: */
        $enunciado = $request->pregunta;
        $nuevaPregunta->enunciadopregunta = $request->pregunta;

        if ($request->hasFile('imagenPregunta')) {
            $aleatorio = mt_rand(100, 9999);
            $nombreOriginalImagen = $request->imagenPregunta->getClientOriginalName();
            $nombreImagen = $aleatorio.'-'.$nombreOriginalImagen;
            $request->imagenPregunta->storeAs('images', $nombreImagen, 'public');
            $nuevaPregunta->imagen = $nombreImagen;
        }
        
        $nuevaPregunta->test_id = $request->test;
        /* Guardamos la nueva pregunta: */
        $nuevaPregunta->save();

        $preguntaGuardada = Pregunta::where('enunciadopregunta', $enunciado)->get();

        /* Si hay preguntas que comparten enunciado, he de controlar esto para añadirle las respuestas a la última pregunta que añada: */
        if(count($preguntaGuardada) == 1) {
            $idpregunta = $preguntaGuardada[0]->id;
        } else {
            $numeroPreguntasMismoEnunciado = count($preguntaGuardada);
            $indiceUltimaPregunta = $numeroPreguntasMismoEnunciado - 1;
            $idpregunta = $preguntaGuardada[$indiceUltimaPregunta]->id;
        }
        

        $nuevaRespuesta = new Respuesta();
        $nuevaRespuesta->enunciadorespuesta = $request->solucionPregunta1;
        $nuevaRespuesta->correcta = $request->respuestaCorrecta1;
        $nuevaRespuesta->pregunta_id = $idpregunta;
        $nuevaRespuesta->save();

        $nuevaRespuesta = new Respuesta();
        $nuevaRespuesta->enunciadorespuesta = $request->solucionPregunta2;
        $nuevaRespuesta->correcta = $request->respuestaCorrecta2;
        $nuevaRespuesta->pregunta_id = $idpregunta;
        $nuevaRespuesta->save();

        $nuevaRespuesta = new Respuesta();
        $nuevaRespuesta->enunciadorespuesta = $request->solucionPregunta3;
        $nuevaRespuesta->correcta = $request->respuestaCorrecta3;
        $nuevaRespuesta->pregunta_id = $idpregunta;
        $nuevaRespuesta->save();
        /* dd($idpregunta); */

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editarPregunta = Pregunta::findOrFail($id);
        /* dd($editarPregunta); */
        $idTest = $editarPregunta->test_id;

        $testPregunta = Test::findOrfail($idTest);
        /* dd($testPregunta); */
        $temaTest = Tema::findOrFail($testPregunta->tema_id);
        /* dd($temaTest); */
        $cursoTest = Curso::findOrFail($temaTest->curso_id);

        $listadoRespuestas = $editarPregunta->respuestas;

        return view('profesor/tests.edit', array('testPregunta'=>$testPregunta, 'editarPregunta'=>$editarPregunta, 'listadoRespuestas'=>$listadoRespuestas, 'temaTest'=>$temaTest, 'cursoTest'=>$cursoTest));
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
        $idPregunta = $request->idpregunta;
        
        /* Controlamos que solo haya una pregunta correcta: */
        $correcta = 0;
        $incorrecta = 0;

        if($request->respuestaCorrecta1 == 'N') {
            $incorrecta++;
        } else {
            $correcta++;
        }
        
        if($request->respuestaCorrecta2 == 'N') {
            $incorrecta++;
        } else {
            $correcta++;
        }
        if($request->respuestaCorrecta3 == 'N') {
            $incorrecta++;
        } else {
            $correcta++;
        }

        if($correcta != 1 && $incorrecta != 2) {
            return back()->withInput($request->input())->with('una-correcta', 'Solo puede tener una respuesta correcta');
        }

        /* Validamos que pregunta y respuestas no vengan vacías: */
        $validator = Validator::make($request->only('enunciadopregunta','solucionPregunta1','solucionPregunta2','solucionPregunta3'), [
            'enunciadopregunta' => 'required|string',
            'solucionPregunta1' => 'required|string',
            'solucionPregunta2' => 'required|string',
            'solucionPregunta3' => 'required|string',
        ]);
        /* Si falla la validación, nos lleva al index y nos muestra mensaje de error */
        if($validator->fails()) {
            
            /* return redirect()->route('alumnaprimero.index')->withErrors($validator)->withInput(); */
            
            return redirect()->route('preguntas.edit',$idPregunta)->with('campo-blanco', '');
        }

        $input = $request->input();
        /* dd($input); */
        $pregunta = Pregunta::findOrFail($id);
        /* dd($pregunta); */

        $idtest = $request->idtest;
        $pregunta->enunciadopregunta = $request->enunciadopregunta;
        if(isset($request->imagenPregunta2)){
            /* dd("hola1"); */
            if ($request->hasFile('imagenPregunta2')) {
                /* dd("hola2"); */

                $imagen = $request->imagenPregunta2->getMimeType();
        
                if ($imagen != "image/jpeg" && $imagen != "image/png" && $imagen != "image/bmp" && $imagen != "image/svg+xml" && $imagen != "image/gif") {
                    
                    return redirect()->route('preguntas.edit',$idPregunta)->with('formato-imagen-no-valido', '');

                }

                $aleatorio = mt_rand(100, 9999);
                $nombreOriginalImagen = $request->imagenPregunta2->getClientOriginalName();
                $nombreImagen = $aleatorio.'-'.$nombreOriginalImagen;
                /* Si cambia la imagen, eliminamos la imagen anterior para que no se vayan acumulando: */
                if($pregunta->imagen) {
                    Storage::delete("/public/images/".$pregunta->imagen);
                }
                $request->imagenPregunta2->storeAs('images', $nombreImagen, 'public');
                $pregunta->imagen = $nombreImagen;
            } else {
                /* dd("hola3"); */
                $nombreImagen = null;
                $request->imagenPregunta2->storeAs('images', $nombreImagen, 'public');
                $pregunta->imagen = $nombreImagen;
            }
        } else if (isset($request->imagenPregunta)){
            
            if ($request->hasFile('imagenPregunta')) {
                /* dd("hola4"); */
                $imagen = $request->imagenPregunta->getMimeType();
        
                if ($imagen != "image/jpeg" && $imagen != "image/png" && $imagen != "image/bmp" && $imagen != "image/svg+xml" && $imagen != "image/gif") {
                    
                    return redirect()->route('preguntas.edit',$idPregunta)->with('formato-imagen-no-valido', '');

                }
                
                $aleatorio = mt_rand(100, 9999);
                $nombreOriginalImagen = $request->imagenPregunta->getClientOriginalName();
                $nombreImagen = $aleatorio.'-'.$nombreOriginalImagen;
                $request->imagenPregunta->storeAs('images', $nombreImagen, 'public');
                $pregunta->imagen = $nombreImagen;
            } else if ($request->imagenPregunta != "null") {
               
                $pregunta->imagen = $request->imagenPregunta;
            } else {
                /* dd("hola6"); */
                /* Si el profesor elimina una imagen que ya haya en una pregunta: */
                $nombreImagen = NULL;
                $pregunta->imagen = $nombreImagen;
            }
        }
        /* $pregunta->imagen = $imagenPregunta; */
        $pregunta->save();

        $listadoRespuestas = $pregunta->respuestas;
        /* dd($listadoRespuestas); */
        
        $editarRespuesta = Respuesta::findOrFail($listadoRespuestas[0]->id);
        $editarRespuesta->enunciadorespuesta = $request->solucionPregunta1;
        $editarRespuesta->correcta = $request->respuestaCorrecta1;
        $editarRespuesta->pregunta_id = $id;
        $editarRespuesta->save();

        $editarRespuesta = Respuesta::findOrFail($listadoRespuestas[1]->id);
        $editarRespuesta->enunciadorespuesta = $request->solucionPregunta2;
        $editarRespuesta->correcta = $request->respuestaCorrecta2;
        $editarRespuesta->pregunta_id = $id;
        $editarRespuesta->save();

        $editarRespuesta = Respuesta::findOrFail($listadoRespuestas[2]->id);
        $editarRespuesta->enunciadorespuesta = $request->solucionPregunta3;
        $editarRespuesta->correcta = $request->respuestaCorrecta3;
        $editarRespuesta->pregunta_id = $id;
        $editarRespuesta->save();

        /* dd($listadoRespuestas); */
        return redirect()->route('tests.vertest', $idtest)->with('datos-actualizados', 'Registro guardado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminarPregunta = Pregunta::findOrFail($id);

        $eliminarRespuestas = $eliminarPregunta->respuestas;
        /* dd($eliminarRespuestas); */

        foreach ($eliminarRespuestas as $respuesta) {
            $respuesta->delete();
        }

        $eliminarPregunta->delete();

        /* Eliminamos la imagen de la carpeta: */
        if($eliminarPregunta->imagen) {
            Storage::delete("/public/images/".$eliminarPregunta->imagen);
        }

        /* Información que debemos mandar a la vista para que se sigan visualizando el resto de preguntas y respuestas de ese test: */
        $idTest = $eliminarPregunta->test_id;
        $test = Test::findOrFail($idTest);
        
        $idTema = $test->tema_id;
        
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

        /* Tema al que pertenece el test: */
        $tema = Tema::findOrFail($idTema);
        $idCurso = $tema->curso_id;
        
        /* Curso al que pertenece el test: */
        $curso = Curso::findorFail($idCurso);
        return redirect()->route('tests.vertest', $idTest)->with('pregunta-eliminada', 'Pregunta eliminada correctamente.', array('eliminarPregunta'=>$eliminarPregunta, 'curso'=>$curso, 'test'=>$test,'coleccionPreguntas' => $coleccionPreguntas, 'coleccionRespuestas' => $coleccionRespuestas));
        /* return view('profesor/tests.vertest', array('eliminarPregunta'=>$eliminarPregunta, 'curso'=>$curso, 'test'=>$test,'coleccionPreguntas' => $coleccionPreguntas, 'coleccionRespuestas' => $coleccionRespuestas)); */
    }

    public function confirm($id)
    {
        /* Información relativa a la pregunta que queremos eliminar en concreto: */
        $eliminarPregunta = Pregunta::findOrFail($id);

        $respuestasPregunta = $eliminarPregunta->respuestas;
        
        /* Información que debemos mandar a la vista para que se sigan visualizando el resto de preguntas y respuestas de ese test: */
        $idTest = $eliminarPregunta->test_id;
        $test = Test::findOrFail($idTest);
        /* Chequeamos si el test tiene notas para avisar al profesor de que va a eliminar una pregunta que pertenece a un examen que tiene notas: */
        $hayNotas = $test->alumnas;

        $idTema = $test->tema_id;

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

        /* Tema al que pertenece el test: */
        $tema = Tema::findOrFail($idTema);
        $idCurso = $tema->curso_id;
        
        /* Curso al que pertenece el test: */
        $curso = Curso::findorFail($idCurso);

        if (count($coleccionPreguntas) != 0 && count($hayNotas) == 0) {
            return view('profesor/tests.vertest', array('status'=>200, 'eliminar' => 'si', 'eliminarPregunta'=>$eliminarPregunta, 'curso'=>$curso, 'test'=>$test,'coleccionPreguntas' => $coleccionPreguntas, 'coleccionRespuestas' => $coleccionRespuestas));
        } else if (count($coleccionPreguntas) != 0 && count($hayNotas) != 0) {
            return view('profesor/tests.vertest', array('status'=>200, 'eliminarConNotas' => 'si', 'eliminarPregunta'=>$eliminarPregunta, 'curso'=>$curso, 'test'=>$test,'coleccionPreguntas' => $coleccionPreguntas, 'coleccionRespuestas' => $coleccionRespuestas));
        }else {
            return view('profesor/tests.vertest', array('status'=>404, 'curso'=>$curso, 'test', $test));
        }
    }
}
