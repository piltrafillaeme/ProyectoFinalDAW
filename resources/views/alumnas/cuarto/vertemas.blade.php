@extends('plantilla.alumnaplantilla')

@section('contenido')

<div id="contenidoAlumna">


    @if(session('datos'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('datos')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="zonaBotonesTema">
        @php
        $numeroTemas = 1;
        @endphp
        @foreach ($temasCuarto as $key => $tema)
        <div class="card tarjeta test">
            <div class="card-header d-flex justify-content-center">
                <h6 class="card-title">Tema nº{{$numeroTemas}}</h6>
            </div>
            <div class="card-body botonTests">
                <p>Pulsa en el botón para ver los exámenes.</p>
                <a href="{{ route('cuarto.show', $tema->id)}}" type="button"
                    class="btn btn-block bg-gradient btn-lg p-4">{{$tema->nombretema}}</a>
            </div>
        </div>
        @php
        $numeroTemas++;
    @endphp
        @endforeach
        
    </div>

</div>

@endsection