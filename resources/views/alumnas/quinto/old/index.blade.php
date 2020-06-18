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

<div class="text-center">
    <h5 class="section-title h1">Bienvenida/o, {{ Auth::user()->name }}</h5>
</div>
<div class="d-flex flex-wrap">
    @foreach ($temasQuinto as $key => $tema)
    <a href="{{ route('quinto.show', $tema->id)}}" type="button"
        class="btn btn-block bg-gradient-info btn-lg p-4">{{$tema->nombretema}}</a>
      @endforeach
</div>

@endsection