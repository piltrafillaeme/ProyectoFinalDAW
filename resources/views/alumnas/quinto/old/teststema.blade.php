@extends('plantilla.alumnaplantilla')

@section('contenido')
{{-- <div>
    @foreach ($alumnasTercero as $alumna)
        <p>Nombre: {{$alumna->nombrealumna}}</p>
        <p>Apellidos: {{$alumna->apellidoalumna}}</p>
        <p>Usuaria: {{$alumna->usuario}}</p>
        <p>Contraseña: {{$alumna->passwordalumna}}</p>
        <p>Curso: {{$alumna->curso_id}}</p>
    @endforeach
</div> --}}
<div class="d-flex flex-wrap">
    @foreach ($testsTema as $test)
    {{-- <p>Nombre tema: {{$tema->nombretema}}</p> --}}
    <a href="{{ route('quinto.vertest', $test->id)}}" type="button"
    class="btn btn-block bg-gradient-info btn-lg p-4">{{$test->nombretest}}</a>
    @endforeach
</div>

@endsection
