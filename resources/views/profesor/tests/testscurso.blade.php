@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Listado de exámenes de {{$curso->nombrecurso}}</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/tests')}}">Cursos</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('tests.show', $curso->id)}}">Exámenes de {{$curso->nombrecurso}}</a></li>

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

                        <div class="card-header">
                            <button class="btn btn-warning btn-md text-white" data-toggle="modal" data-target="#crearTest">
                                <i class="fas fa-list-ul text-white"></i> Añadir examen</button>
                        </div>

                        <div class="card-body">

                            {{-- Tabla con todos los datos --}}

                            <table class="table table-bordered table-striped dt-responsive" width="100%"
                                style="text-align:center">
                                <thead>
                                    <tr style="background-color: #e0a800; color:#FFFFFF">
                                        <td>#</td>
                                        <td>Nombre</td>
                                        <td>Nº Tema</td>
                                        <td>Tema</td>
                                        <td>Fecha Creación</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($coleccionTests) != 0)
                                    @foreach ($coleccionTests as $key => $values)
                                    <tr>
                                        <td>{{($key+1)}}</td>
                                        <td>{{$values -> nombretest}}</td>
                                        
                                        {{-- Hago esto para que me identifique el id tel tema con su nombre, porque sino siempre me saca el último tema --}}
                                        @foreach ($coleccionTemas as $item)
                                        @if ($values -> tema_id == $item -> id)
                                        <td>{{$item -> numerotema}}</td>
                                        <td>{{$item -> nombretema}}</td>
                                        @endif
                                        @endforeach
                                        {{-- <td>{{$curso->id}}</td> --}}
                                        <td>{{$values->created_at->format('d/m/Y')}}</td>
                                        <td>
                                            <div class="btn-group">

                                                <a href="{{ route('tests.vertest', $values -> id)}}"
                                                    class="btn btn-info btn-sm mr-1 text-white btnVer">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                    Ver
                                                </a>

                                                <a href="{{ route('tests.vernotas', $values -> id)}}"
                                                    class="btn btn-primary btn-sm mr-1 text-white btnNotas">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                    Notas
                                                </a>

                                                <a href="{{ route('tests.estadisticas', $values -> id)}}"
                                                    class="btn btn-dark btn-sm mr-1 text-white btnEstadisticas">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                    Estadísticas
                                                </a>

                                                <a href="{{ route('tests.editartest', $values -> id)}}"
                                                    class="btn btn-success btn-sm mr-1 text-white btnEditar">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                    Editar
                                                </a>

                                                <a href="{{ route('preguntas.creapregunta', $values -> id)}}"
                                                    class="btn btn-warning btn-sm mr-1 text-white btnAñadir">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                    Añadir preguntas
                                                </a>

                                                <a href="{{ route('tests.confirm', $values -> id)}}"
                                                    class="btn btn-danger btn-sm text-white btnEliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Eliminar
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">
                                            No hay exámenes aún.
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->

                    </div>

                    <!-- /.card -->

                </div>

            </div>

        </div>

    </section>

    <!-- /.content -->

</div>

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
@if(Session::has('datos-actualizados'))

<script>
   notie.alert({
   
   type: 1,
   text: '¡Registro actualizado correctamente!',
   time: 7

 })

</script>

@endif


{{-- Mensaje saliente si se ha eliminado un test correctamente--}}
@if(Session::has('datos-eliminados'))

 <script>
     notie.alert({
     
     type: 1,
     text: '¡Examen eliminado correctamente!',
     time: 7
 
   })
 
 </script>

 @endif

{{-- Mensaje saliente si se ha eliminado una pregunta correctamente--}}
@if(Session::has('pregunta-eliminada'))

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

@endif 

{{-- Messaje de error si existe algún problema al validar los datos --}}
@if(Session::has('no-notas'))

    <script>
        notie.alert({
        
        type: 3,
        text: '¡Aún no hay notas!',
        time: 7
    
      })
    
    </script>

@endif
<!--------------------------------------------------------------------------*/
/*                   VENTANA MODAL PARA AGREGAR NUEVO TEST                  */
/* -------------------------------------------------------------------------->

<div class="modal" id="crearTest">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('tests.store') }}">
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Añadir examen</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    {{-- Guardamos identificador del curso --}}
                    <input type="hidden" name="curso" value="{{$curso->id}}">

                    {{-- Nombre examen --}}
                    
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="nav-icon fas fa-list-ul"></i>
                        </div>
                        <input name="nombretest" type="text" class="form-control" placeholder="Nombre del examen">
                    </div>

                    {{-- Tema al que pertenecerá el test --}}
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        
                        <select name="tema" class="form-control">
                            
                            @foreach ($coleccionTemas as $temitas)
                            <option value="{{$temitas->id}}">{{$temitas->nombretema}}</option>
                            @endforeach
                        </select>


                        @error('curso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cerrar</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>

<!-------------------------------------------------------------------------- */
/*                VENTANA MODAL PARA EDITAR UN TETS  EXISTENTE               */
/* ---------------------------------------------------------------------------->

@if (isset($status))
@if (isset($editar))
@if ($status == 200 && $editar == 'si')


<div class="modal" id="editarCurso">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('tests.update', $test->id) }}">
                @method('PUT')
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Editar examen: <i>{{$test->nombretest}}</i></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    {{-- Nombre examen --}}
                    
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="nav-icon fas fa-list-ul"></i>
                        </div>
                        <input name="nombretest" type="text" class="form-control" value="{{$test->nombretest}}">
                    </div>

                    {{-- Tema al que pertenecerá el test --}}
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        
                        <select name="tema" class="form-control">
                            
                            @foreach ($coleccionTemas as $temitas)
                            <option value="{{$temitas->id}}">{{$temitas->nombretema}}</option>
                            @endforeach
                        </select>


                        @error('curso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cerrar</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary"><i
                            class="fas fa-pencil-alt text-white"></i> Editar</button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>


<script>
    $("#editarCurso").modal();
</script>

@else

{{$status}}

@endif

@elseif (isset($eliminar))

@if ($status == 200 && $eliminar == 'si')

<div class="modal" id="eliminarTest">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('tests.destroy', $eliminarTest->id) }}">
                @method('DELETE')
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Eliminar cuestionario</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    <h3>¿Deseas eliminar el registro de <i>{{$eliminarTest->nombretest}}</i> ?</h3>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-ban"></i> Cerrar</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>

<script>
    $("#eliminarTest").modal();
</script>

@else
{{$status}}
@endif
@elseif (isset($eliminarConNotas))

@if ($status == 200 && $eliminarConNotas == 'si')

<div class="modal" id="eliminarTestConNotas">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('tests.destroy', $eliminarTest->id) }}">
                @method('DELETE')
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Eliminar cuestionario</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    <h3>El test <i>{{$eliminarTest->nombretest}}</i> tiene notas registradas, ¿deseas eliminarlo igualmente?</h3>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-ban"></i> Cerrar</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>

<script>
    $("#eliminarTestConNotas").modal();
</script>

@else
{{$status}}
@endif
@endif
@endif

@endsection