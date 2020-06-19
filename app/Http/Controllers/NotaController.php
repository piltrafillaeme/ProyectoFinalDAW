<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\NotasChart;
use App\Nota;
use App\Test;
use App\Tema;
use App\Curso;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $todasNotas = Nota::All(); */
        $todasNotas = Nota::pluck('nota', 'created_at');
        
        /* return $todasNotas; */

        /* Accedo a los índices (q serán los created_at): */
        /* return $todasNotas->keys(); */
        /* Accedo solo a las notas: */
        /* return $todasNotas->values(); */
        $chart = new NotasChart;
        $chart->labels($todasNotas->keys());
        $chart->dataset('My dataset', 'doughnut', $todasNotas->values());

        return view('profesor/notas.index', compact('chart'));
    }

    public function estadisticas($idTest)
    {
        /* $todasNotas = Nota::All(); */
        $notasTest = Nota::where('test_id', $idTest)->get();
        $test = Test::find($idTest);
        $tema = Tema::find($test->tema_id);
        $curso = Curso::find($tema->curso_id);
        
        
        if (count($notasTest) != 0) {
            $aprobados = 0;
            $suspensos = 0;
        
            foreach ($notasTest as $nota) {
                if ($nota->nota >= 5) {
                    $aprobados++;
                } else {
                    $suspensos++;
                }
            }

            /* return $aprobados; */
            $todasNotas = Nota::pluck('nota', 'created_at');
            /* return $todasNotas; */

            /* Accedo a los índices (q serán los created_at): */
            /* return $todasNotas->keys(); */
            /* Accedo solo a las notas: */
            /* return $todasNotas->values(); */
            $chart = new NotasChart;
            $chart->labels(['Aprobados', 'Suspensos']);
            $chart->dataset('My dataset', 'doughnut', [$aprobados,$suspensos]);

            return view('profesor/notas.index', compact('chart', 'test','curso'));
        } else {
            
            $test = Test::findOrFail($idTest);
            /* dd($test); */
            $idtema = $test->tema_id;
            /* dd($idtema); */

            $temaCorrespondiente = Tema::find($idtema);
            /* dd($temaCorrespondiente); */

            $idcurso = $temaCorrespondiente->curso_id;

            return redirect()->route('tests.testscurso', $idcurso)->with('no-notas', 'Aún no hay notas.', 'curso', $idcurso);
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
        //
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
}
