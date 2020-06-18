@extends('plantilla.alumnaplantilla')

@section('contenido')


<div id="contenidoAlumna">
    {{-- Saludo alumna --}}
    <div class="text-center bienvenida">
        <h5 class="section-title h1">Bienvenida/o, {{ Auth::user()->name }}</h5>
    </div>

<div class="text-center zonaBotones">

    <div class="card tarjeta">
        <div class="card-header d-flex justify-content-center">
            <h6 class="card-title">Ver Notas</h6>
        </div>
        <div class="card-body botonNotas">
            <p>Pulsa en el botón para ver tus notas.</p>
            <a href="{{ route('tercero.notas', Auth::user()->username )}}" type="button"
                class="btn bg-gradient-danger btn-lg p-4 ">Mis notas</a>
        </div>

        <!-- /.card-body -->

    </div>
    <div class="card tarjeta">
        <div class="card-header d-flex justify-content-center">
            <h6 class="card-title text-center">Ver Temas</h6>
        </div>
        <div class="card-body botonTemas">
            <p>Pulsa en el botón para ver los temas.</p>
            <a href="{{ route('tercero.vertemas', $curso->id)}}" type="button"
                class="btn bg-gradient-warning btn-lg p-4">Temas</a>

        </div>

        <!-- /.card-body -->

    </div>
</div>

</div>

@endsection