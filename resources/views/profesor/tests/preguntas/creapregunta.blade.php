@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">
  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-2">

        {{-- <h3>Añadir preguntas al test {{$test->nombretest}}</h3> --}}

        </div>

        <div class="col-sm-10">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('/tests',$curso->id)}}">Inicio</a></li>

            <li class="breadcrumb-item"><a href="{{url('/tests')}}">Cursos</a></li>

            <li class="breadcrumb-item"><a href="{{route('tests.testscurso',$curso->id)}}">Exámenes de {{$curso->nombrecurso}}</a></li>

            <li class="breadcrumb-item"><a href="{{ route('preguntas.creapregunta', $test -> id)}}">Añadir preguntas</a></li>

          </ol>


        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>
  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-12">

          <!-- Contenido tarjeta -->

          <div class="card">

            <div class="card-header text-white">

              <h3>Añadiendo pregunta al test: <i>{{$test->nombretest}}</i></h3>

            </div>
           
            <div class="card-body">

              {{-- Start creating your amazing application! --}}
              <form method="POST" action="{{ route('preguntas.store') }}" id="creaPregunta" enctype="multipart/form-data">
                @csrf
                 {{-- Guardamos identificador del test --}}
                 <input type="hidden" name="test" value="{{$test->id}}">
                 <input type="hidden" name="curso" value="{{$curso->id}}">
                 

                 {{-- Pregunta del test --}}
                 <div class="form-group">
                    <label>Escriba la pregunta:</label>
                    <textarea name="pregunta" class="form-control" rows="3" value="{{ Request::old('pregunta') }}"></textarea>
                  </div>

                  {{-- Adjuntar imagen --}}
                  <div class="form-group">
                    <label>Adjuntar imagen (opcional):</label>
                    <input type="file" name="imagenPregunta" id="imagenPregunta">
                  </div>
                  
                  {{-- Respuesta 1 de la pregunta --}}
                  <div class="form-group">
                    <label>Escriba una respuesta 1:</label>
                    <textarea name="solucionPregunta1" class="form-control" rows="3"></textarea>
                  </div>

                  {{-- Marca si esa respuesta es correcta o no: --}}
                  <fieldset class="form-group">
                    <div class="row">
                      <div class="col-sm-10">
                        <div class="form-check">

                          <input class="form-check-input" type="radio" name="respuestaCorrecta1" value="S" checked>
                          <label class="form-check-label">
                            Respuesta correcta
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="respuestaCorrecta1" value="N">
                          <label class="form-check-label">
                            Respuesta incorrecta
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                  {{-- Respuesta 2 de la pregunta --}}
                  <div class="form-group">
                    <label>Escriba una respuesta 2:</label>
                    <textarea name="solucionPregunta2" class="form-control" rows="3"></textarea>
                  </div>

                  {{-- Marca si esa respuesta es correcta o no: --}}
                  <fieldset class="form-group">
                    <div class="row">
                      <div class="col-sm-10">
                        <div class="form-check">

                          <input class="form-check-input" type="radio" name="respuestaCorrecta2" value="S">
                          <label class="form-check-label">
                            Respuesta correcta
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="respuestaCorrecta2" value="N" checked>
                          <label class="form-check-label">
                            Respuesta incorrecta
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                  {{-- Respuesta 3 de la pregunta --}}
                  <div class="form-group">
                    <label>Escriba una respuesta 3:</label>
                    <textarea name="solucionPregunta3" class="form-control" rows="3"></textarea>
                  </div>


                  {{-- Marca si esa respuesta es correcta o no: --}}
                  <fieldset class="form-group">
                    <div class="row">
                      <div class="col-sm-10">
                        <div class="form-check">

                          <input class="form-check-input" type="radio" name="respuestaCorrecta3" value="S" >
                          <label class="form-check-label">
                            Respuesta correcta
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="respuestaCorrecta3" value="N" checked>
                          <label class="form-check-label">
                            Respuesta incorrecta
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                  <button type="submit" id="guardarPregunta" class="btn btn-md mr-0 guardaPregunta text-white"><i class="far fa-save"></i> Guardar pregunta</button>
              
            </form>
            <!-- /.card-footer-->

          </div>

          <!-- /.card -->

        </div>

      </div>

    </div>

  </section>
</div>
{{-- Mensaje saliente si se ha elegido más de una pregunta correcta --}}
@if(Session::has('una-correcta'))

 <script>
     notie.alert({
     
     type: 3,
     text: '¡Solo puede tener una respuesta correcta!',
     time: 7
 
   })
 
 </script>

 @endif
 
{{-- Mensaje saliente si se ha eliminado un registro correctamente--}}
@if(Session::has('todas-incorrectas'))

 <script>
     notie.alert({
     
     type: 3,
     text: '¡Debe elegir alguna respuesta correcta!',
     time: 7
 
   })
 
 </script>

 @endif

 {{-- Messaje de error si existe algún problema al validar los datos --}}
 @if(Session::has('no-validacion'))

     <script>
         notie.alert({
         
         type: 2,
         text: '¡Debe rellenar todos los campos!',
         time: 7
     
       })
     
     </script>

 @endif

@endsection