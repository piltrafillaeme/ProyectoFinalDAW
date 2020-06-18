@extends('plantilla.alumnaplantilla')

@section('contenido')

@if(session('datos'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('datos')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="text-center testsTemas">
        <h5 class="section-title h2">Exámenes del tema <strong>'{{ $tema->nombretema}}'</strong></h5>
    </div>

    <div class="zonaBotonesTema">
        @php
        $numeroTemas = 1;
    @endphp
        @if (count($testsTema) != 0)
           @if (count($testsHechos) != 0)
                @foreach ($testsHechos as $hecho) 
                    @foreach ($notasTestsHechos as $nota)
                        @if ($hecho->id == $nota->test_id)
                        <div class="card tarjeta test">
                            <div class="card-header d-flex justify-content-center">
                                <h6 class="card-title">Examen nº{{$numeroTemas}}</h6>
                            </div>
                            <div class="card-body botonTests">
                                <p>Ya has hecho este examen.</p>
                            <p>Tu nota es: {{$nota->nota}}</p>
                            </div>
                        </div>
                        @endif
                    
                    @endforeach
                    @php
                    $numeroTemas++;
                @endphp
                @endforeach
           @endif
           @if (count($testsSinHacer) != 0)
                @foreach ($testsSinHacer as $sinHacer) 
                    <div class="card tarjeta test">
                        <div class="card-header d-flex justify-content-center">
                            <h6 class="card-title">Examen nº{{$numeroTemas}}</h6>
                        </div>
                        <div class="card-body botonTests">
                            <p>Pulsa en el botón para hacer el examen.</p>
                            <a href="{{ route('cuarto.vertest', $sinHacer->id)}}" type="button"
                                class="btn btn-block bg-gradient btn-lg p-4">{{$sinHacer->nombretest}}</a>
                        </div>
                    </div>
                    @php
                    $numeroTemas++;
                @endphp
                @endforeach
           @endif

        @else
            <div class="card tarjeta test">
                <div class="card-body botonTests">
                    <p>Aún no hay exámenes de este tema.</p>
                    <a href="{{ route('cuarto.vertemas', Auth::user()->clase)}}" type="button"
                        class="btn btn-block bg-gradient btn-lg p-4">Volver a temas</a>
                </div>
            </div>
        @endif
       

    </div>

@endsection

