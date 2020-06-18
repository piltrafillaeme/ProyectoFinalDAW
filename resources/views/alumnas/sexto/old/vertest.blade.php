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
<div>
    <div>
        <h2>PREGUNTAS</h2>
    </div>
    <form id="formulario" method="POST" action="{{ route('sexto.store') }}">
        @csrf
        <input type="hidden" value="{{$test->id}}" name="test_id">
        <input type="hidden" value="{{Auth::user()->username}}" name="alumna_id">
        <input type="hidden" value="{{$curso->id}}" name="curso_id">
        <input type="hidden" value="{{$curso->nombrecurso}}" name="curso_nombre">
        <input type="hidden" value="{{$tema->id}}" name="tema_id">
        @if (count($coleccionPreguntas) != 0)
        @foreach ($coleccionPreguntas as $key => $item)
        Pregunta nº {{$key+1}}: {{$item->enunciadopregunta}}
            @foreach ($coleccionRespuestas as $values)
                @if ($item->id == $values->pregunta_id)
                    @if ($values->correcta == "S")
                        <div class="input-group m-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="radio" name="respuesta{{$item->id}}" value="S"
                                        aria-label="Radio button for following text input">
                                </div>
                            </div>
                            <span type="text" class="form-control" aria-label="Text input with checkbox">{{$values->enunciadorespuesta}}</span>
                        </div>
                    @else
                        <div class="input-group m-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="respuesta{{$item->id}}" value="N">
                                </div>
                            </div>
                            <span type="text" class="form-control" aria-label="Text input with checkbox">{{$values->enunciadorespuesta}}</span>
                        </div>
                    @endif
                @endif
            @endforeach
        @endforeach
    @endif
    <button type="submit" id="corrige" class="btn btn-info">Corregir</button>
    </form>

</div>

@endsection