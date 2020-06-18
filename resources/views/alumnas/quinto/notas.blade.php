@extends('plantilla.alumnaplantilla')

@section('contenido')

{{-- <div class="card-body">
    <h4>Bienvenida/o, {{ auth()->user()->username }}</h4>
<h4>Bienvenida/o, {{ Auth::user()->name }}</h4>
<div>
    @foreach ($temasTercero as $key => $tema)
    <a href="{{ route('tercero.show', $tema->id)}}" type="button"
        class="btn btn-block bg-gradient-info btn-lg p-4">{{$tema->nombretema}}</a>
    @endforeach
</div>
</div> --}}
@if(session('no-validacion'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('no-notas')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card tablaNotas">
    <div class="card-header d-flex justify-content-center">
        <h6 class="card-title">Estas son tus notas, {{Auth::user()->name }}:</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive" width="100%" style="text-align:center">
            <thead>
                <tr>
                    <td class="temita">Tema</td>
                    <td class="testito">Examen</td>
                    <td class="notita">Nota</td>
                </tr>
            </thead>
            <tbody>
                @if (isset($tests))
                @foreach ($alumna->tests as $key => $test)
                <tr>
                    @foreach ($coleccionTemas as $tema)
                    @php
                    $nombreTemita = "";
                    if($tema->id == $test->tema_id) {
                    $nombreTemita = $tema->nombretema;
                    break;
                    }
                    @endphp
                    @endforeach
                    <td>{{$nombreTemita}}</td>
                    <td>{{$test->nombretest}}</td>
                    <td>{{$test->pivot->nota}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">No tienes notas aún.</td>
                </tr>
                @endif


            </tbody>
        </table>
    </div>
</div>

@endsection