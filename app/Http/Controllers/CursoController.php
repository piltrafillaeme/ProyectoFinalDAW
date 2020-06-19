<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Curso;
use App\Alumna;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::All();
        $alumnas = Alumna::All();

        return view('profesor/cursos.index', array('cursos' => $cursos, 'alumnas' => $alumnas));
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
        
        /* Validamos que no se agregue un curso que ya existe: */
        $validator = Validator::make($request->all(), [
            'name' => 'unique:cursos,nombrecurso',
        ]);

        
        /* Si la validación falla, mostramos mensaje de error: */
        if($validator->fails()) {
            
            $failedRules = $validator->failed();

            return redirect()->route('cursos.index')->with('datos-no-guardados',  '');
            /* return back()->withInput($request->input())->withErrors($validator); */

        }

        $nuevoCurso = new Curso();

        $nuevoCurso->nombrecurso = $request->name;
        $nuevoCurso->save();

        return redirect()->route('cursos.index')->with('datos-guardados',  'Registro actualizado correctamente.');
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
        $cursos = Curso::all();
        $alumnas = Alumna::all();

        if(count($cursos) != 0) {
            return view('profesor/cursos.index', array('status'=>200, 'editar' => 'si','curso'=>$curso, 'cursos'=>$cursos, 'alumnas' => $alumnas));
        } else {
            return view('profesor/cursos.index', array('status'=>404, 'cursos'=>$cursos, 'alumnas' => $alumnas));
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

        /* Validamos que no se agregue un curso que ya existe: */
         $validator = Validator::make($request->all(), [
            'name' => 'unique:cursos,nombrecurso',
        ]);

        
        /* Si la validación falla, mostramos mensaje de error: */
        if($validator->fails()) {
            $failedRules = $validator->failed();

            return back()->withInput($request->input())->withErrors($validator);

        }

        $curso = Curso::find($id);

        $curso->nombrecurso = $request->name;
        $curso->save();
        
        return redirect()->route('cursos.index')->with('datos-actualizados', 'Registro actualizado correctamente.', 'curso', $curso);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminarCurso = Curso::find($id);

        $eliminarCurso->delete();

        return redirect()->route('cursos.index')->with('datos', 'Registro eliminado correctamente.');
    }

    public function confirm($id)
    {
        $eliminarCurso = Curso::find($id);
        $cursos = Curso::all();
        $alumnas = Alumna::All();

        if(count($cursos) != 0) {
            return view('profesor/cursos.index', array('status'=>200, 'eliminar' => 'si','curso'=>$eliminarCurso, 'cursos'=>$cursos, 'alumnas' => $alumnas));
        } else {
            return view('profesor/cursos.index', array('status'=>404, 'cursos'=>$cursos, 'alumnas' => $alumnas));
        }
    }
}
