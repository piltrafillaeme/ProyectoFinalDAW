<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Profesor;
use App\Alumna;
use App\User;
use App\Test;
use App\Nota;
use App\Curso;
use App\Charts\NotasChart;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Accedo a todas las alumnas registradas: */
        $listadoalumnas = Alumna::orderBy('curso_id')->orderBy('letra')->orderBy('apellidoalumna')->paginate(10);

        return view('profesor.index', compact('listadoalumnas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::all();
        
        return view('profesor.create', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Creamos nueva alumna: */
        $nuevaAlumna = new Alumna();

        /* Asociamos los datos introducidos por el profesor: */
        $nuevaAlumna->nombrealumna = $request->name;
        $nuevaAlumna->apellidoalumna = $request->apellidos;
        $nuevaAlumna->usuario = $request->usuario;
        $nuevaAlumna->curso_id = $request->clase;
        $nuevaAlumna->letra = $request->letra;
        $nuevaAlumna->passwordalumna = $request->password;
        
        /* Validamos que todo sea correcto: */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'apellidos' => 'required',
            'usuario' => 'required|unique:alumnas',
            'clase' => 'required',
            'letra' => 'required',
            'password' => 'required',
        ]);

        /* $errors = $validator->errors(); */
        
        /* Si la validación falla, mostramos mensaje de error: */
        if($validator->fails()) {

            $failedRules = $validator->failed();
            
           return back()->withInput($request->input())->withErrors($validator);

            /* return redirect()->route('profesor.index')->withInput()->withErrors($validator); */
        }

        /* Si todo es correcto, guardamos la nueva alumna: */
        $nuevaAlumna->save();

        /* Como para el login nos basamos en la tabla user, cada vez que guardemos en la tabla alumnas, hemos de guardar tb el registro en la tabla users: */
        $usuarios = new User();
        $usuarios->name = $request->name;
        $usuarios->apellidos = $request->apellidos;
        $usuarios->username = $request->usuario;
        $usuarios->clase = $request->clase;
        $usuarios->password = bcrypt($request->password);
        $usuarios->save();

        return redirect()->route('profesor.index')->with('datos-guardados', 'Registro guardado correctamente.');
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
        $listadoalumnas = Alumna::findOrFail($id);
        $cursos = Curso::all();

        return view('profesor.edit', compact('listadoalumnas', 'cursos'));
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
        /* Actualizamos registro según el id en la tabla alumnas: */
        $listadoalumnas = Alumna::findOrFail($id);

        /* Tomamos el valor del nombre y el usuario para después también actualizar la tabla users, q es la que da acceso a la aplicación: */
        $nombreAlumna = array('nombrealumna' => $listadoalumnas->nombrealumna);
        $usernameAlumna = array('username' => $listadoalumnas->usuario);

        /* Asociamos cada columna de la bbdd con el valor introducido en cada input: */
        $listadoalumnas->nombrealumna = $request->name;
        $listadoalumnas->apellidoalumna = $request->apellidos;
        $listadoalumnas->usuario = $request->usuario;
        $listadoalumnas->curso_id = $request->clase;
        $listadoalumnas->letra = $request->letra;
        $listadoalumnas->passwordalumna = $request->password;

        

        /* Validamos que los datos sean correctos: */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'apellidos' => 'required',
            'usuario' => ['required', Rule::unique('alumnas')->ignore($id),],
            'clase' => 'required',
            'letra' => 'required',
            'password' => 'required',
        ]);

        
        /* Si la validación falla, mostramos mensaje de error: */
        if($validator->fails()) {

            $failedRules = $validator->failed();

            return back()->withInput($request->input())->withErrors($validator);

        }

        /* Si no falla, guardamos los cambios: */
        $listadoalumnas->save();
        
        /*A la vez, también guardamos los datos actualizados en la tabla users: */
        $usuarios = User::where('name', $nombreAlumna)->where('username',$usernameAlumna)->first();
         
        $usuarios->name = $request->name;
        $usuarios->apellidos = $request->apellidos;
        $usuarios->username = $request->usuario;
        $usuarios->clase = $request->clase;
        $usuarios->password = bcrypt($request->password);
        $usuarios->save();

        /* Volvemos a la página inicial y mostramos mensaje de actualización correcta: */
        return redirect()->route('profesor.index')->with('datos-actualizados', 'Registro actualizado correctamente.');
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* Eliminamos registro según el id en la tabla alumnas: */
        $alumna = Alumna::findOrFail($id);

        /* Tomamos el valor del nombre y el usuario para después también eliminar el registro de la tabla users, q es la que da acceso a la aplicación: */
        $nombreAlumna = array('nombrealumna' => $alumna->nombrealumna);
        $usernameAlumna = array('usuario' => $alumna->usuario);

        /* Eliminamos de la tabla alumnas: */
        $alumna->delete();

        /* Eliminamos de la tabla users: */
        $usuarios = User::where('name', $nombreAlumna)->where('username',$usernameAlumna)->first();
        $usuarios->delete();

        return redirect()->route('profesor.index')->with('datos-eliminados', 'Registro eliminado correctamente.');
    }

    public function confirm($id)
    {
        $listadoalumnas = Alumna::paginate(10);
        $eliminarAlumna = Alumna::findOrFail($id);

        if(count($listadoalumnas) != 0) {
            return view('profesor/index', array('status'=>200, 'eliminar' => 'si','eliminarAlumna'=>$eliminarAlumna, 'listadoalumnas' => $listadoalumnas));
        } else {
            return view('profesor/index', array('status'=>404, 'listadoalumnas' => $listadoalumnas));
        }
    }

    public function vernotasalumna ($idAlumna) {
        
        $notasAlumna = Nota::where('alumna_id', $idAlumna)->get();
        $alumna = Alumna::find($idAlumna);

        $labels = array();
        $notas = array();
        
        if(count($notasAlumna) != 0){
            
            foreach($notasAlumna as $nota) {
                $idTest = $nota->test_id;
                $test = Test::find($idTest);
                $nombreTest = $test->nombretest;
                array_push($labels,$nombreTest);
                array_push($notas,$nota->nota);
            }

            return view('profesor/vernotasalumna', array('alumna'=>$alumna))->with('labels', json_encode($labels))->with('notas', json_encode($notas, JSON_NUMERIC_CHECK));
        
        } else {
        
            return redirect()->route('profesor.index')->with('no-notas','');
        
        }
    }
}
