@extends('plantilla.profesorplantilla')

@section('contenido')

<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Listado de temas</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/temas')}}">Listado temas</a></li>

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
                            
                            <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#crearTema"><i
                                    class="fas fa-plus-circle"></i> Crear
                                nuevo tema</button>
                            @if(session('datos'))
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('datos')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <br>
                            @endif
                        </div>

                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive" width="100%"
                                style="text-align:center">
                                <thead>
                                    <tr style="background-color: #e0a800; color:#FFFFFF">
                                        <td>Nombre</td>
                                        <td>Número Tema</td>
                                        <td>Curso</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($temas as $key => $value)
                                    @if ($value->curso_id == 1 || $value->curso_id == 3 || $value->curso_id == 5)
                                        <tr style="background-color: #F2F2F2">
                                    @else
                                        <tr style="background-color: #FFFFFF">
                                    @endif
                                        <td>{{$value->nombretema}}</td>
                                        <td>{{$value->numerotema}}</td>
                                        <td>{{$value->curso_id}}</td>
                                        <td>
                                            <div class="btn-group">

                                                <a href="{{ route('temas.show', $value->id) }}"
                                                    class="btn btn-warning btn-sm mr-1 text-white btnAñadir"><i
                                                        class="fas fa-pencil-alt text-white"></i>
                                                    Editar</a>

                                                <a href="{{ route('temas.confirm', $value->id) }}"
                                                    class="btn btn-danger btn-sm ml-1 text-white btnEliminar">
                                                    <i class="fas fa-trash-alt text-white"></i>
                                                    Eliminar
                                                </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">

                            {{$temas->links()}}

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

<!--------------------------------------------------------------------------*/
/*                   VENTANA MODAL PARA AGREGAR NUEVO TEMA                  */
/* -------------------------------------------------------------------------->

<div class="modal" id="crearTema">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('temas.store') }}">
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Añadir tema</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    {{-- Nombre --}}
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Nombre">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- Número de tema --}}
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <input id="numerotema" type="number" class="form-control @error('numerotema') is-invalid @enderror"
                            name="numerotema" value="{{ old('numerotema') }}" required autocomplete="numerotema" autofocus
                            placeholder="Número tema">

                        @error('numerotema')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- Curso --}}
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>

                        <select name="curso" class="form-control @error('curso') is-invalid @enderror">
                            <option class="hidden" disabled>Curso</option>
                            @foreach ($cursos as $item)
                            <option value="{{$item->id}}">{{$item->nombrecurso}}</option>
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
@if(Session::has('datos-actualizados'))

<script>
    notie.alert({
    
    type: 1,
    text: '¡Registro actualizado correctamente!',
    time: 7

  })

</script>

@endif

{{-- Mensaje saliente si se ha eliminado un registro correctamente--}}
@if(Session::has('datos-eliminados'))

 <script>
     notie.alert({
     
     type: 1,
     text: '¡Registro eliminado correctamente!',
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



<!-------------------------------------------------------------------------- */
/*                VENTANA MODAL PARA EDITAR UN CURSO EXISTENTE               */
/* ---------------------------------------------------------------------------->

@if (isset($status))
@if (isset($editar))
@if ($status == 200 && $editar == 'si')

@foreach ($temas as $key=>$value)
<div class="modal" id="editarTema">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('temas.update', $tema->id) }}">
                @method('PUT')
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Editar tema</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    {{-- Nombre --}}
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{$tema->nombretema}}" required autocomplete="name" autofocus
                            placeholder="{{$tema->nombretema}}">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                     {{-- Número de tema --}}
                     <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <input id="numerotema" type="number" class="form-control @error('numerotema') is-invalid @enderror"
                            name="numerotema" value="{{$tema->numerotema}}" required autocomplete="numerotema" autofocus
                            placeholder="{{$tema->numerotema}}">

                        @error('numerotema')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- Curso --}}
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        @php
                        $nombreCursos = array();
                        foreach ($cursos as $cursito) {
                        array_push($nombreCursos,$cursito->id);
                        }
                        @endphp
                        <select name="curso" class="form-control @error('curso') is-invalid @enderror">
                            <option class="hidden" disabled>Curso</option>
                            @foreach ($nombreCursos as $item)
                            <option @if ($tema->curso_id == $item)
                                selected
                                value="{{$item}}"
                                @endif
                                >{{$item}}</option>
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
                        <button type="submit" class="btn btnAñadir text-white"><i
                            class="fas fa-pencil-alt text-white"></i> Editar</button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>
@endforeach

<script>
    $("#editarTema").modal();
</script>

@else

{{$status}}

@endif

@elseif (isset($eliminar))

@if ($status == 200 && $eliminar == 'si')

@foreach ($temas as $key=>$value)
<div class="modal" id="eliminarTema">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('temas.destroy', $tema->id) }}">
                @method('DELETE')
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Eliminar tema</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    <h3>¿Deseas eliminar el tema de <i>{{$tema->nombretema}}</i>?</h3>

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
@endforeach

<script>
    $("#eliminarTema").modal();
</script>

@else
{{$status}}
@endif
@endif
@endif
@endsection