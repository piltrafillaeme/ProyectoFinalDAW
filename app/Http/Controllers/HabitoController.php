<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habito;

class HabitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          /* $profesor = Profesor::all(); */
          $habitos = Habito::all();

          return view('profesor/habitos.index', compact('habitos'));
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
        $nuevoHabito = new Habito();

        $nuevoHabito->nombrehabito = $request->name;
        $nuevoHabito->save();

        return redirect()->route('habitos.index')->with('datos', 'Registro guardado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editarHabito = Habito::findOrFail($id);
        
        $habitos = Habito::all();

        if(count($habitos) != 0) {
            return view('profesor/habitos.index', array('status'=>200, 'habito'=>$editarHabito, 'habitos'=>$habitos));
        } else {
            return view('profesor/habitos.index', array('status'=>404, 'habitos'=>$habitos));
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
        $nuevoNombreHabito = array('nombrehabito' => $request->input('name'));
        $habito = Habito::where('id', $id)->update($nuevoNombreHabito);
        
        /* $nuevoNombreHabito->nombrehabito = $request->name; */


        return redirect()->route('habitos.index')->with('datos', 'Registro editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminarHabito = Habito::find($id);

        $eliminarHabito->delete();

        return redirect()->route('habitos.index')->with('datos', 'Registro eliminado correctamente.');
    }

    public function confirm($id)
    {
        $eliminarHabito = Habito::findOrFail($id);
        $habitos = Habito::all();

        if(count($habitos) != 0) {
            return view('profesor/habitos.index', array('status'=>200, 'eliminar' => 'si','habito'=>$eliminarHabito, 'habitos'=>$habitos));
        } else {
            return view('profesor/habitos.index', array('status'=>404, 'habitos'=>$habitos));
        }
    }
}
