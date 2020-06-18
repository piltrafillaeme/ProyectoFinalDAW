<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tema;
use App\Curso;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temas = Tema::orderBy('curso_id')->orderBy('numerotema')->paginate(10);
        $cursos = Curso::All();

        return view('profesor/temas.index', compact('temas', 'cursos'));
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
        $tema = new Tema();

        $tema->nombretema = $request->name;
        $tema->numerotema = $request->numerotema;
        $tema->curso_id = $request->curso;
        $tema->save();

        return redirect()->route('temas.index')->with('datos-guardados', 'Registro guardado correctamente.');
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
        $temas = Tema::orderBy('curso_id')->orderBy('numerotema')->paginate(10);
        $cursos = Curso::All();

        if(count($temas) != 0) {
            return view('profesor/temas.index', array('status'=>200, 'editar' => 'si','tema'=>$tema, 'temas'=>$temas, 'cursos' => $cursos));
        } else {
            return view('profesor/temas.index', array('status'=>404, 'temas'=>$temas));
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
        $tema = Tema::find($id);

        $tema->nombretema = $request->name;
        $tema->numerotema = $request->numerotema;
        $tema->profesor_id = 1;
        $tema->curso_id = $request->curso;

        $tema->update();

        return redirect()->route('temas.index')->with('datos-actualizados', 'Registro editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminarTema = Tema::find($id);

        $eliminarTema->delete();

        return redirect()->route('temas.index')->with('datos-eliminados', 'Registro eliminado correctamente.');
    }

    public function confirm($id)
    {
        $eliminarTema = Tema::find($id);
        
        $temas = Tema::orderBy('curso_id')->orderBy('numerotema')->paginate(10);
        $cursos = Curso::all();

        if(count($cursos) != 0) {
            return view('profesor/temas.index', array('status'=>200, 'eliminar' => 'si','tema'=>$eliminarTema, 'temas'=>$temas,'cursos' => $cursos));
        } else {
            return view('profesor/temas.index', array('status'=>404, 'temas'=>$temas));
        }
    }
}
