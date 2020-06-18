@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    {{-- <h3>Listado de preguntas del test {{$test->nombretest}} (Tema {{$test->tema_id}})</h3> --}}

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/tests')}}">Cursos</a></li> 

                        <li class="breadcrumb-item"><a href="{{route('tests.testscurso',$curso->id)}}">Exámenes de {{$curso->nombrecurso}}</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('tests.vertest', $test -> id)}}">Test {{$test->nombretest}}</a></li>

                    </ol>


                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <!-- Contenido tarjeta -->

                    <div class="card">

                        <div class="card-header text-white verExamen">
                            <h4>Listado de preguntas del test: <i>{{$test->nombretest}}</i> (Tema {{$test->tema_id}})</h4>
                        </div>

                        <div class="card-body">

                            <table class="table dt-responsive verExamen" width="100%" >
                                <thead class="verExamen" >
                                    <tr class="verExamen" style="text-align:center; background-color: #e0a800; color:#FFFFFF">
                                        <th class="verExamen" colspan="2">Preguntas</th>
                                        <th class="verExamen" >Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($coleccionPreguntas) != 0)
                                    @foreach ($coleccionPreguntas as $key => $item)
                                    <tr>
                                        <td colspan="2">
                                            Pregunta nº {{$key+1}}: {{$item->enunciadopregunta}}
                                        </td>
                                        <td rowspan="2" style="text-align:center" class="acciones">
                                            <div class="btn-group" >

                                                <a href="{{ route('preguntas.edit', $item -> id)}}"
                                                    class="btn btn-success btn-sm mr-1 text-white">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                    Editar
                                                </a>

                                            <a href="{{ route('preguntas.confirm', $item -> id)}}" class="btn btn-danger btn-sm ml-1 text-white">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Eliminar
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="division">
                                        <td>
                                            <ol type="a">
                                                @foreach ($coleccionRespuestas as $values)
                                                @if ($item->id == $values->pregunta_id)
                                                @if ($values->correcta == "S")
                                                <li style="color:green;font-weight: bold">
                                                    {{$values->enunciadorespuesta}}</li>
                                                @else
                                                <li>{{$values->enunciadorespuesta}}</li>
                                                @endif
                                                @endif
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td class="imagenExamen">
                                            @if ($item->imagen != null)
                                            <img src="{{asset('/storage/images/'.$item->imagen)}}" alt="imagenPregunta" width="200" height="200">
                                            @endif
                                        </td>
                        
                                    </tr>
                                    
                                    @endforeach
                                    @else
                                    <tr style="text-align:center">
                                        <td colspan="3">
                                            No hay preguntas aún.
                                        </td>
                                    </tr>
                                    @endif
                                    

                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">

                            {{-- {{$collecionExamen->links()}} --}}

                        </div>

                        <!-- /.card-footer-->

                    </div>

                    <!-- /.card -->

                </div>

            </div>

        </div>

    </section>

    <!-- /.content -->

</div>


<!-------------------------------------------------------------------------- */
/*                VENTANA MODAL PARA ELIMINAR UNA PREGUNTA                   */
/* ---------------------------------------------------------------------------->

@if (isset($status))
    
    @if (isset($eliminar))

        @if ($status == 200 && $eliminar == 'si')

            <div class="modal" id="eliminarPregunta">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="{{ route('preguntas.destroy', $eliminarPregunta->id) }}">
                            @method('DELETE')
                            @csrf

                            <div class="modal-header bg-info">

                                <h4 class="modal-title">Eliminar pregunta</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">

                                <h3>¿Deseas eliminar la pregunta {{$eliminarPregunta->enunciadopregunta}}?</h3>

                            </div>

                            <div class="modal-footer d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>

        <script>
            $("#eliminarPregunta").modal();
        </script>

        @else
            {{$status}}
        @endif
    
    @elseif (isset($eliminarConNotas))
    
        @if ($status == 200 && $eliminarConNotas == 'si')

            <div class="modal" id="eliminarPreguntaConNotas">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="{{ route('preguntas.destroy', $eliminarPregunta->id) }}">
                            @method('DELETE')
                            @csrf

                            <div class="modal-header bg-info">

                                <h4 class="modal-title">Eliminar pregunta</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">

                                <h3>Esta pregunta pertenece a un examen que tiene notas asociadas, ¿Desea eliminarla igualmente?</h3>

                            </div>

                            <div class="modal-footer d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>

            <script>
                $("#eliminarPreguntaConNotas").modal();
            </script>

        @else
            {{$status}}
        @endif
    @endif
@endif


{{-- CONTROL DE ERRORES Y VALIDACIÓN --}}

 {{-- Mensaje saliente si se ha guardado un registro correctamente--}}
 @if(Session::has('datos-guardados'))

 <script>
     notie.alert({
     
     type: 1,
     text: '¡Registro guardado correctamente!',
     time: 7
 
   })
 
 </script>

 @endif

{{-- Mensaje saliente si se ha actualizado un registro correctamente--}}
@if (Session::has("datos-actualizados"))

<script>
    notie.alert({
    
    type: 1,
    text: '¡Pregunta actualizada correctamente!',
    time: 7

  })

</script>

@endif

{{-- Mensaje saliente si se ha eliminado un registro correctamente--}}
@if(Session::has('datos-eliminados'))

 <script>
     notie.alert({
     
     type: 1,
     text: '¡Pregunta eliminada correctamente!',
     time: 7
 
   })
 
 </script>

 @endif

 {{-- Messaje de error si existe algún problema al validar los datos --}}
 @if(Session::has('no-validacion'))

     <script>
         notie.alert({
         
         type: 2,
         text: '¡Problema con los datos!',
         time: 7
     
       })
     
     </script>
 </div>

 @endif
@endsection