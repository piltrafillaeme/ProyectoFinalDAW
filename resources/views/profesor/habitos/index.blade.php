@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Listado de hábitos</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/habito')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="#">Listado hábitos</a></li>

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
                            

                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearHabito"><i class="fas fa-user-plus"></i>  Crear
                                nuevo hábito</button>
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

                            {{-- Start creating your amazing application! --}}

                            <table class="table table-bordered table-striped dt-responsive" width="100%"
                                style="text-align:center">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Identificador</td>
                                        <td>Nombre</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($habitos as $key => $value)
                                        <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->nombrehabito}}</td>
                                        <td>
                                            <div class="btn-group">

                                            <a href="{{ route('habitos.update', $value->id) }}" class="btn btn-warning btn-sm mr-1 text-white"><i class="fas fa-pencil-alt text-white"></i>
                                                    Editar</a>

                                                <a href="{{ route('habitos.confirm', $value->id) }}" class="btn btn-danger btn-sm ml-1 text-white">
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

                            Footer

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
/*                   VENTANA MODAL PARA AGREGAR NUEVO HÁBITO                */
/* -------------------------------------------------------------------------->

<div class="modal" id="crearHabito">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('habitos.store') }}">
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Añadir hábito</h4>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>

<!-------------------------------------------------------------------------- */
/*                VENTANA MODAL PARA EDITAR UN HÁBITO EXISTENTE              */
/* --------------------------------------------------------------------------->


@if (isset($status))
@if (isset($editar))
@if ($status == 200 && $editar == 'si')


<div class="modal" id="editarTema">

    <div class="modal" id="editarHabito">

        <div class="modal-dialog">
    
            <div class="modal-content">
    
                <form method="POST" action="{{ route('habitos.update', $habito->id) }}">
                    @method('PUT')
                    @csrf
    
                    <div class="modal-header bg-info">
    
                        <h4 class="modal-title">Editar habito</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
    
                    </div>
                    <div class="modal-body">
    
                        {{-- Nombre --}}
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $habito->nombrehabito }}" required autocomplete="name" autofocus>
    
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
    
                    </div>
    
                    <div class="modal-footer d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
    
                    </div>
                </form>
    
            </div>
    
        </div>
    </div>
</div>


<script>
    $("#editarHabito").modal();
    </script>

@else

{{$status}}

@endif

@elseif (isset($eliminar))

@if ($status == 200 && $eliminar == 'si')

<div class="modal" id="eliminarHabito">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('habitos.destroy', $habito->id) }}">
                @method('DELETE')
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Eliminar tema</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    <h3>¿Deseas eliminar el registro de {{$habito->nombrehabito}}?</h3>

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
    $("#eliminarHabito").modal();
</script>

@else
{{$status}}
@endif
@endif
@endif
@endsection