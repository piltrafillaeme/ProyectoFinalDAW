@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-2">

                    {{-- <h1>Notas del examen {{$test->nombretest}}</h1> --}}

                </div>

                <div class="col-sm-10">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/tests',$curso->id)}}">Inicio</a></li>
                        
                        <li class="breadcrumb-item"><a href="{{url('/tests')}}">Cursos</a></li>

                        <li class="breadcrumb-item"><a href="{{route('tests.testscurso',$curso->id)}}">Exámenes de {{$curso->nombrecurso}}</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('tests.vernotas', $test -> id)}}">Notas examen {{$test->nombretest}}</a></li>

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

                        <div class="card-header text-white d-md-flex justify-content-center">
                            <h4>Notas del examen: <i>{{$test->nombretest}}</i></h4>
                        </div>

                        @if(session('datos'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('datos')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(session('cancelar'))

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{session('cancelar')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @endif

                        @if(session('no-validacion'))

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{session('no-validacion')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @endif

                        <div class="card-body">

                            {{-- Start creating your amazing application! --}}

                            <table class="table table-bordered table-striped dt-responsive" width="100%"
                                style="text-align:center">
                                <thead>
                                    <tr style="background-color: #e0a800; color:#FFFFFF">
                                        <td>#</td>
                                        <td>Nombre</td>
                                        <td>Apellidos</td>
                                        <td>Letra</td>
                                        <td>Tema</td>
                                        <td>Nota</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($alumnasA))
                                        @foreach ($alumnasA as $key => $alumna)
                                        <tr style="background-color: #F2F2F2">
                                            <td>{{$key+1}}</td>
                                            <td>{{$alumna->nombrealumna}}</td>
                                            <td>{{$alumna->apellidoalumna}}</td>
                                            <td>{{$alumna->letra}}</td>
                                            <td>{{$tema->nombretema}}</td>
                                            <td>{{$alumna->pivot->nota}}</td>
                                        </tr>
                                        @endforeach
                                    
                                    @endif
                                    @if (isset($alumnasB))
                                        @foreach ($alumnasB as $key => $alumna)
                                        <tr style="background-color: #FFFFFF">
                                            <td>{{$key+1}}</td>
                                            <td>{{$alumna->nombrealumna}}</td>
                                            <td>{{$alumna->apellidoalumna}}</td>
                                            <td>{{$alumna->letra}}</td>
                                            <td>{{$tema->nombretema}}</td>
                                            <td>{{$alumna->pivot->nota}}</td>
                                        </tr>
                                        @endforeach
                                    
                                    @endif
                                    @if (!isset($alumnasA) &&  !isset($alumnasB)) 
                                        <tr>
                                            <td colspan="6">
                                                No hay notas aún.
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
@endsection