<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('profesor', 'ProfesorController');
Route::resource('tests', 'TestController');
Route::resource('preguntas', 'PreguntaController');
Route::resource('cursos', 'CursoController');
Route::resource('temas', 'TemaController');
Route::resource('habitos', 'HabitoController');
Route::resource('alumnas', 'AlumnaController');
Route::resource('primero', 'PrimeroController');
Route::resource('segundo', 'SegundoController');
Route::resource('tercero', 'TerceroController');
Route::resource('cuarto', 'CuartoController');
Route::resource('quinto', 'QuintoController');
Route::resource('sexto', 'SextoController');
Route::resource('notas', 'NotaController');

/* -------------------------------------------------------------------------- */
/*                                  PROFESOR                                  */
/* -------------------------------------------------------------------------- */

Route::get('/cancelar', function() {

    return redirect()->route('profesor.index')->with('cancelar', 'Acción cancelada.');

})->name('cancelar');

/* Confirmación para eliminar a unx alumnx */
Route::get('/profesor/{id}/confirm', 'ProfesorController@confirm')->name('profesor.confirm');

/* Ver notas de una alumna en concreto */
Route::get('/profesor/{id}/vernotasalumna', 'ProfesorController@vernotasalumna')->name('profesor.vernotasalumna');

/* Para mostrar los cuestionarios relativos a un curso en concreto */
Route::get('/tests/{id}/testscurso', 'TestController@show')->name('tests.testscurso');

/* Para mostrar los cuestionarios relativos a un curso en concreto */
/* Route::get('/tests/{id}', 'TestController@store')->name('tests.store'); */

/* Para ver un examen en concreto */
Route::get('/tests/{id}/vertest', 'TestController@vertest')->name('tests.vertest');

/* Estadística notas de un examen en concreto: */
Route::get('/tests/{id}/estadisticas', 'NotaController@estadisticas')->name('tests.estadisticas');

/* Para ver las notas de las alumnas de un examen en concreto */
Route::get('/tests/{id}/vernotas', 'TestController@vernotas')->name('tests.vernotas');

/* Para crear un nuevo test:*/
Route::get('/tests/{id}/createst', 'TestController@createst')->name('tests.createst');

/* Para editar un test en concreto:*/
Route::get('/tests/{id}/editartest', 'TestController@editartest')->name('tests.editartest')
;
/* Confirmación para eliminar un test completo: */
Route::get('/tests/{id}/confirm', 'TestController@confirm')->name('tests.confirm');

/* Para añadir preguntas a un test:*/
Route::get('/preguntas/{id}/creapregunta', 'PreguntaController@creapregunta')->name('preguntas.creapregunta');

/* Confirmación para eliminar un curso: */
Route::get('/cursos/{id}/confirm', 'CursoController@confirm')->name('cursos.confirm');

/* Confirmación para eliminar un tema: */
Route::get('/temas/{id}/confirm', 'TemaController@confirm')->name('temas.confirm');

/* Confirmación para eliminar un hábito: */
Route::get('/habitos/{id}/confirm', 'HabitoController@confirm')->name('habitos.confirm');

/* Confirmación para eliminar una pregunta con sus respectivas respuestas: */
Route::get('/preguntas/{id}/confirm', 'PreguntaController@confirm')->name('preguntas.confirm');

/* -------------------------------------------------------------------------- */
/*                                   ALUMNAS                                  */
/* -------------------------------------------------------------------------- */

/* PRIMERO: */

/* Para ver los temas del curso de primero */
Route::get('/primero/{id}/vertemas', 'PrimeroController@vertemas')->name('primero.vertemas');

/* Para ver los exámenes de un tema en concreto del curso de primero */
Route::get('/primero/{id}/vertest', 'PrimeroController@vertest')->name('primero.vertest');

/* Para ver los exámenes de un tema en concreto del curso de primero */
Route::get('/primero/{usuario}/notas', 'PrimeroController@vernotas')->name('primero.notas');

/* SEGUNDO: */

/* Para ver los temas del curso de segundo */
Route::get('/segundo/{id}/vertemas', 'SegundoController@vertemas')->name('segundo.vertemas');

/* Para ver los exámenes de un tema en concreto del curso de segundo*/
Route::get('/segundo/{id}/vertest', 'SegundoController@vertest')->name('segundo.vertest');

/* Para ver los exámenes de un tema en concreto del curso de segundo */
Route::get('/segundo/{usuario}/notas', 'SegundoController@vernotas')->name('segundo.notas');

/* TERCERO: */

/* Para ver los temas del curso de tercero */
Route::get('/tercero/{id}/vertemas', 'TerceroController@vertemas')->name('tercero.vertemas');

/* Para ver los exámenes de un tema en concreto del curso de tercero*/
Route::get('/tercero/{id}/vertest', 'TerceroController@vertest')->name('tercero.vertest');

/* Para ver los exámenes de un tema en concreto del curso de tercero */
Route::get('/tercero/{usuario}/notas', 'TerceroController@vernotas')->name('tercero.notas');

/* CUARTO: */

/* Para ver los temas del curso de cuarto */
Route::get('/cuarto/{id}/vertemas', 'CuartoController@vertemas')->name('cuarto.vertemas');

/* Para ver los exámenes de un tema en concreto del curso de cuarto*/
Route::get('/cuarto/{id}/vertest', 'CuartoController@vertest')->name('cuarto.vertest');

/* Para ver los exámenes de un tema en concreto del curso de cuarto */
Route::get('/cuarto/{usuario}/notas', 'CuartoController@vernotas')->name('cuarto.notas');

/* QUINTO: */

/* Para ver los temas del curso de quinto */
Route::get('/quinto/{id}/vertemas', 'QuintoController@vertemas')->name('quinto.vertemas');

/* Para ver los exámenes de un tema en concreto del curso de quinto */
Route::get('/quinto/{id}/vertest', 'QuintoController@vertest')->name('quinto.vertest');

/* Para ver los exámenes de un tema en concreto del curso de quinto */
Route::get('/quinto/{usuario}/notas', 'QuintoController@vernotas')->name('quinto.notas');

/* SEXTO: */

/* Para ver los temas del curso de sexto */
Route::get('/sexto/{id}/vertemas', 'SextoController@vertemas')->name('sexto.vertemas');

/* Para ver los exámenes de un tema en concreto del curso de sexto*/
Route::get('/sexto/{id}/vertest', 'SextoController@vertest')->name('sexto.vertest');

/* Para ver los exámenes de un tema en concreto del curso de sexto */
Route::get('/sexto/{usuario}/notas', 'SextoController@vernotas')->name('sexto.notas');


