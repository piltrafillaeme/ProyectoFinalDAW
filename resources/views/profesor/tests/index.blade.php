@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">
    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Apartado exámenes</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/tests')}}">Cursos</a></li>

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

                        <div class="card-header text-white d-flex justify-content-center">
                            <h3>Cursos</h3>

                        </div>
                        <div class="card-body">

                      
                            <table class="table table-bordered text-center">
  
                                <tbody>

                                    <tr>
                                        @php
                                        $arrayColores = ['#FFE082','#FFCA28','#FFB300'];
                                        @endphp
                                        @foreach ($cursos as $key => $curso)
                                        @if ($key < 3)
                                        @php $colorBoton=$arrayColores[$key]; @endphp
                                        <td>
                                            <a href="{{ route('tests.show', $curso->id)}}" type="button"
                                                class="btn btn-block btn-lg p-4 text-white"
                                                style="background-color: {{$colorBoton}}; color:rgb(65, 71, 77) !important;">Exámenes de
                                                {{$curso->nombrecurso}}</a>
                                        </td>

                                        @endif

                                        @endforeach
                                    </tr>
                                    <tr>
                                        @php
                                        $arrayColores = ['#FF8F00','#FF6F00','#db5f00'];
                                        $indiceColor = 0;
                                        @endphp
                                        @foreach ($cursos as $key => $curso)
                                        @if ($key > 2)
                                        @php 
                                        $colorBoton=$arrayColores[$indiceColor];
                                        $indiceColor++;
                                        @endphp
                                        <td>
                                            <a href="{{ route('tests.show', $curso->id)}}" type="button"
                                                class="btn btn-block btn-lg p-4 text-white"
                                                style="background-color: {{$colorBoton}}">Exámenes de
                                                {{$curso->nombrecurso}}</a>
                                        </td>
                                        @endif
                                        @endforeach
                                    </tr>

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
</div>

@endsection