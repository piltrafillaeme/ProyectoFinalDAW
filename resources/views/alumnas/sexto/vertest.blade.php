@extends('plantilla.alumnaplantilla')

@section('contenido')
<div>
    <div class="text-center testsTemas">
        <h5 class="section-title h2">Examen <strong>'{{ $test->nombretest}}'</strong></h5>
    </div>
    
    <form id="formulario" method="POST" action="{{ route('primero.store') }}">
        @csrf
        <input type="hidden" value="{{$test->id}}" name="test_id">
        <input type="hidden" value="{{Auth::user()->username}}" name="alumna_id">
        <input type="hidden" value="{{$curso->id}}" name="curso_id">
        <input type="hidden" value="{{$curso->nombrecurso}}" name="curso_nombre">
        <input type="hidden" value="{{$tema->id}}" name="tema_id">
        <table class="dt-responsive tablaPreguntas">
            @if (count($coleccionPreguntas) != 0)
                @foreach ($coleccionPreguntas as $key => $item)
                {{-- Mostramos pregunta: --}}
                <tr>
                    <td colspan="3">
                        <p class="preguntas font-weight-bold">Pregunta nº {{$key+1}}: {{$item->enunciadopregunta}}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        @foreach ($coleccionRespuestas as $values)
                        @if ($item->id == $values->pregunta_id)
                            @if ($values->correcta == "S")
                                <div class="input-group m-3 respuestasTabla">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <input type="radio" name="respuesta{{$item->id}}" value="S"
                                                aria-label="Radio button for following text input">
                                        </div>
                                    </div>
                                    <span type="text" class="form-control" aria-label="Text input with checkbox">{{$values->enunciadorespuesta}}</span>
                                </div>
                            @else
                                <div class="input-group m-3 respuestasTabla">
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
                    </td>
                    <td>
                        {{-- Mostramos imagen (si la hay): --}}
                        @if ($item->imagen != null)
                        <img src="{{asset('/storage/images/'.$item->imagen)}}" alt="imagenPregunta" width="200" height="200">
                        @endif
                    </td>
                </tr>
                @endforeach
            @endif
            <tr>
                <td>
                    <button type="submit" id="corrige" class="btn btn-info m-3 p-3">Corregir</button>
                </td>
            </tr>
    
        </table>
        
    </form>

</div>

@endsection