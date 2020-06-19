@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Listado de cursos</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/cursos')}}">Listado cursos</a></li>

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

                            <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#crearCurso"><i
                                    class="fas fa-plus-circle"></i> Crear
                                nuevo curso</button>
                            
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive" width="100%"
                                style="text-align:center">
                                <thead>
                                    <tr style="background-color: #e0a800; color:#FFFFFF">
                                        <td>#</td>
                                        <td>Nombre</td>
                                        <td>Número de alumn@s</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cursos as $key => $value)
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{$value->nombrecurso}}</td>
                                        @php
                                            $numeroAlumnas = 0;
                                        @endphp
                                        @foreach ($alumnas as $alumnita)
                                        
                                            @if ($alumnita->curso_id == $value->id)
                                                @php
                                                    $numeroAlumnas++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <td>{{$numeroAlumnas}}</td>
                                        <td>
                                            <div class="btn-group">

                                                <a href="{{ route('cursos.show', $value->id) }}"
                                                    class="btn btn-warning btn-sm mr-1 text-white btnAñadir"><i
                                                        class="fas fa-pencil-alt text-white"></i>
                                                    Editar</a>

                                                <a href="{{ route('cursos.confirm', $value->id) }}"
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

                    </div>

                    <!-- /.card -->

                </div>

            </div>

        </div>

    </section>

    <!-- /.content -->

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
@if(Session::has('datos-no-guardados'))

<script>
    notie.alert({
    
    type: 3,
    text: '¡Ya existe ese curso!',
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
 {{-- Mensaje de error cuando se añade un alumno con un nombre de usuario que ya existe en la base de datos --}}
 @error('nombrecurso')
 <script>
     notie.alert({
     
     type: 3,
     text: '¡Ese curso ya existe!',
     time: 7
 
   })
 
 </script>
 @enderror
{{--  VENTANA MODAL PARA AGREGAR NUEVO CURSO  --}}

<div class="modal" id="crearCurso">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('cursos.store') }}">
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Añadir curso</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    {{-- Nombre --}}
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <i class="fas fa-user"></i>
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

{{-- VENTANA MODAL PARA EDITAR UN CURSO EXISTENTE --}}


@if (isset($status))
    @if (isset($editar))
        @if ($status == 200 && $editar == 'si')

            @foreach ($cursos as $key=>$value)
            <div class="modal" id="editarCurso">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="{{ route('cursos.update', $curso->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="modal-header bg-info">

                                <h4 class="modal-title">Editar curso</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">

                                {{-- Nombre --}}
                                <div class="input-group mb-3">
                                    <div class="input-group-append input-group-text">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="{{$curso->nombrecurso}}">

                                    @error('name')
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
            @endforeach

            <script>
                $("#editarCurso").modal();
            </script>

        @else

        {{$status}}
        
        @endif

    @elseif (isset($eliminar))

        @if ($status == 200 && $eliminar == 'si')

        @foreach ($cursos as $key=>$value)
        <div class="modal" id="eliminarCurso">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form method="POST" action="{{ route('cursos.destroy', $curso->id) }}">
                        @method('DELETE')
                        @csrf

                        <div class="modal-header bg-info">

                            <h4 class="modal-title">Eliminar curso</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">

                            <h3>¿Deseas eliminar el curso de <i>{{$curso->nombrecurso}}</i>?</h3>

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
            $("#eliminarCurso").modal();
        </script>

        @else
            {{$status}}
        @endif
    @endif
@endif

@endsection
