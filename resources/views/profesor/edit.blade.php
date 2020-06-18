@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Editar alumna/o</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Listado alumn@s</a></li>

                    </ol>


                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                    <div class="card-header text-white h3">{{ __('Editando alumna/o: ') }} <i>{{$listadoalumnas->apellidoalumna}}, {{$listadoalumnas->nombrealumna}}</i></div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('profesor.update',$listadoalumnas->id) }}">
                                @method('PUT')
                                @csrf
        
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ $listadoalumnas->nombrealumna }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="apellidos"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="apellidos" type="text"
                                            class="form-control @error('apellidos') is-invalid @enderror" name="apellidos"
                                            value="{{ $listadoalumnas->apellidoalumna }}" required autocomplete="apellidos" autofocus>
        
                                        @error('apellidos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="usuario"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Usuaria/o') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="usuario" type="text"
                                            class="form-control @error('usuario') is-invalid @enderror" name="usuario"
                                            value="{{ $listadoalumnas->usuario }}" required autocomplete="usuario">
        
                                        @error('usuario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="clase" class="col-md-4 col-form-label text-md-right">{{ __('Clase') }}</label>
        
                                    <div class="col-md-6">
                                        <select class="form-control" name="clase" id="clase">
                                            @foreach ($cursos as $curso)
                                                @if ($listadoalumnas->curso_id == $curso->id)
                                                    <option value="{{$curso->id}}" selected>{{$curso->nombrecurso}}</option>
                                                @else
                                                <option value="{{$curso->id}}">{{$curso->nombrecurso}}</option>
                                                @endif
                                                
                                            @endforeach
                                        </select>
                                        @error('clase')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="letra" class="col-md-4 col-form-label text-md-right">{{ __('Letra') }}</label>
        
                                    <div class="col-md-6">

                                        <select class="form-control" name="letra" id="letra">
                                            
                                                @if ($listadoalumnas->letra == 'A')
                                                    <option value="A" selected>A</option>
                                                    <option value="B">B</option>
                                                @else
                                                <option value="A">A</option>
                                                    <option value="B" selected>B</option>
                                                @endif
                                                
                                        </select>
                                        @error('letra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            value="{{ $listadoalumnas->passwordalumna }}" required autocomplete="new-password">
        
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-md text-white guardaAlumna"><i class="far fa-save"></i>
                                            {{ __('Editar') }}
                                        </button>
                                        <a href="{{ route('cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>{{ __('Cancelar') }}</a>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </section>

    <!-- /.content -->

</div>


@endsection