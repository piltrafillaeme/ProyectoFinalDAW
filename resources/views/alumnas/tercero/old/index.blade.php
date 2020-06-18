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
    @foreach ($temasTercero as $key => $tema)
    <a href="{{ route('tercero.show', $tema->id)}}" type="button"
        class="btn btn-block bg-gradient-info btn-lg p-4">{{$tema->nombretema}}</a>
      @endforeach
</div>

{{-- <section id="team" class="pb-5">
    <div class="container">
        <h5 class="section-title h1">Bienvenida/o, {{ Auth::user()->name }}</h5>
        <div class="row">
            @foreach ($temasTercero as $key => $tema)
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_01.png" alt="card image"></p>
                                    <h4 class="card-title">Tema {{$key + 1}}</h4>
                                    <p class="card-text">{{$tema->nombretema}}</p>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h4 class="card-title">¡Aprendamos!</h4>
                                    <a href="{{ route('tercero.show', $tema->id)}}" type="button"
                                        class="btn btn-block bg-gradient-info btn-sm p-4 card-text temita">{{$tema->nombretema}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            @endforeach
        </div>
    </div>
</section> --}}
@endsection