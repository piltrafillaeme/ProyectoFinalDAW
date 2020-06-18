@extends('plantilla.profesorplantilla')


@section('contenido')

<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Eliminar alumn@</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>
                        
                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Listado alumnas</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('profesor.confirm', $alumna -> id)}}">Eliminar alumn@</a></li>

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


                        <div class="card-body">

                            <h3>¿Deseas eliminar el registro de {{$alumna->nombrealumna}} 
                                {{$alumna->apellidoalumna}}?</h3>

                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">

                            <form method="POST" action="{{ route('profesor.destroy', $alumna->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="redondo btn btn-danger"><i class="fas fa-trash-alt"></i>
                                    Eliminar</button>
                                <a href="{{route('cancelar')}}" class="redondo btn btn-secondary"><i
                                        class="fas fa-ban"></i> Cancelar</a>
                            </form>


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
@endsection