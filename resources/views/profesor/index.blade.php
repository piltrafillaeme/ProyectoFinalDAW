@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Listado de alumnas/os</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Listado alumn@s</a></li>

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

                    <div class="card tablaAlumnas">

                        <div class="card-header">

                            <a href="{{ route('profesor.create')}}" class="btn btn-primary btn-md"><i
                                    class="fas fa-user-plus"></i>
                                Añadir alumna/o</a>

                        </div>

                        <div class="card-body" width="100%">

                            {{-- Start creating your amazing application! --}}

                            <table class="table table-bordered  dt-responsive" width="90%"
                                style="text-align:center">
                                <thead>
                                    <tr style="background-color: #e0a800; color:#FFFFFF">
                                        <td>#</td>
                                        {{-- <td>Identificador</td> --}}
                                        <td>Nombre</td>
                                        <td>Apellidos</td>
                                        <td>Nickname</td>
                                        <td>Contraseña</td>
                                        <td>Clase</td>
                                        <td>Letra</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listadoalumnas as $key => $values)
                         
                                    @if ($values->letra == 'A')
                                        <tr style="background-color: #F2F2F2">
                                    @else
                                        <tr style="background-color: #FFFFFF">
                                    @endif
                                  
                                        <td>{{($key+1)}}</td>
                                        {{-- <td>{{$values -> id}}</td> --}}
                                        {{-- <td>{{$values["id"]}}</td> --}}
                                        <td>{{$values -> nombrealumna}}</td>
                                        {{-- <td>{{$values["name"]}}</td> --}}
                                        <td>{{$values -> apellidoalumna}}</td>
                                        <td>{{$values -> usuario}}</td>
                                        <td>{{$values -> passwordalumna}}</td>
                                        {{-- <td>{{$values["username"]}}</td> --}}
                                        <td >{{$values -> curso_id}}</td>
                                        <td>{{$values -> letra}}</td>
                                        {{-- <td>{{$values["clase"]}}</td> --}}
                                        <td>
                                            <div class="btn-group">

                                                <a href="{{ route('profesor.vernotasalumna', $values -> id)}}"
                                                    class="btn btn-sm mr-1 text-white btnEditar">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                    Ver notas
                                                </a>

                                                <a href="{{ route('profesor.edit', $values -> id)}}"
                                                    class="btn btn-sm mr-1 text-white btnAñadir">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                    Editar
                                                </a>

                                                <a href="{{ route('profesor.confirm', $values -> id)}}"
                                                    class="btn btn-sm text-white btnEliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Eliminar
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">

                            {{$listadoalumnas->links()}}

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

 {{-- Messaje de error si la alumna no tiene notas registradas --}}
 @if (Session::has("no-notas"))

 <script>
     notie.alert({
     
     type: 2,
     text: '¡La alumna no ha hecho ningún examen!',
     time: 7

 })

 </script>

 @endif
 {{-- Mensaje de error cuando se añade un alumno con un nombre de usuario que ya existe en la base de datos --}}
 @error('usuario')
 <script>
     notie.alert({
     
     type: 3,
     text: '¡El nombre de usuario que ha usado ya existe!',
     time: 7
 
   })
 
 </script>
 @enderror

{{-- VENTANA MODAL PARA ELIMINAR UNA ALUMNA EXISTENTE --}}

@if (isset($status))

@if ($status == 200 && $eliminar == 'si')

<div class="modal" id="eliminarAlumna">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ route('profesor.destroy', $eliminarAlumna->id) }}">
                @method('DELETE')
                @csrf

                <div class="modal-header bg-info">

                    <h4 class="modal-title">Eliminar alumna/o</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    <h3>¿Deseas eliminar el registro de <i>{{$eliminarAlumna->apellidoalumna}}, {{$eliminarAlumna->nombrealumna}}</i>?</h3>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-primary btn-md " data-dismiss="modal"><i
                                class="fas fa-ban"></i> Cerrar</button>
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
    $("#eliminarAlumna").modal();
</script>

@else
{{$status}}
@endif

@endif
@endsection