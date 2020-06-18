@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-2">

                    {{-- <h1>Editar examen: {{$testPregunta->nombretest}}</h1> --}}

                </div>

                <div class="col-sm-10">

                    <ol class="breadcrumb float-sm-right">
                        

                        
                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/tests')}}">Cursos</a></li> 

                        <li class="breadcrumb-item"><a href="{{route('tests.testscurso',$cursoTest->id)}}">Exámenes de {{$cursoTest->nombrecurso}}</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('tests.vertest', $testPregunta -> id)}}">Test {{$testPregunta->nombretest}}</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('preguntas.edit', $editarPregunta -> id)}}">Editar pregunta</a></li>

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

                        <div class="card-header">

                            <h3 class="text-white">Editando examen: <i>{{$testPregunta->nombretest}}</i></h3>

                        </div>

                        <div class="card-body">

                            {{-- Formulario para editar una pregunta, su imagen (si la tiene) y sus respuestas --}}

                            <form method="POST" action="{{ route('preguntas.update', $editarPregunta->id)}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <input type="hidden" name="idtest" value="{{$testPregunta->id}}">
                                <input type="hidden" name="idpregunta" value="{{$editarPregunta->id}}">
                                <input type="hidden" name="imagenPregunta" value="{{$editarPregunta->imagen}}">

                                {{-- Pregunta del test --}}
                                <div class="form-group">
                                    <label>Escriba la pregunta:</label>
                                    <textarea name="enunciadopregunta" class="form-control"
                                        rows="3">{{$editarPregunta["enunciadopregunta"]}}</textarea>
                                </div>

                                {{-- Adjuntar imagen --}}
                                <div class="form-group" id="imagen">

                                    {{-- Si no hay una imagen guardada, muestro input para poder subir imagen: --}}
                                    @if ($editarPregunta["imagen"] == null)
                                    <div class="form-group" id="imagenPregunta">
                                        <label>Adjuntar imagen (opcional):</label>
                                        <input type="file" name="imagenPregunta" id="imagenPregunta" class="validaFormato">
                                    </div>
                                    @else
                                    {{-- Si ya hay una imagen, la muestro y doy la opción de clicar sobre ella para modificar la imagen existente: --}}
                                    <div id="borrar">
                                        <label>Actualizar imagen</label>
                                        <input type="file" name="imagenPregunta2" class="d-none" id="imagenPregunta2" class="validaFormato">
                                        <label for="imagenPregunta2">
                                        <img src="{{asset('/storage/images/'.$editarPregunta->imagen)}}" alt="imagenPregunta" width="200" height="200" class="prevImagenPregunta">
                                        </label>
                                        <div id="botonEliminar">
                                            <input type='button' class='limpiar-inputfile' value='Eliminar imagen'>
                                        </div>
                                    </div>

                                    @endif
                                    
                                </div>
                                

                                {{-- Editamos las respuestas --}}
                                @foreach ($editarPregunta["respuestas"] as $key => $respuesta)
                                {{-- Respuesta 1 de la pregunta --}}
                                <div class="form-group">
                                    <label>Editar respuestas nº {{($key+1)}}:</label>
                                    <textarea name="solucionPregunta{{($key+1)}}" class="form-control"
                                        rows="3">{{$respuesta->enunciadorespuesta}}</textarea>
                                </div>

                                {{-- Marca si esa respuesta es correcta o no: --}}
                                @if (($respuesta->correcta == "S"))
                                    @php ($correcta ='checked')
                                    @php ($incorrecta = '')
                                @else
                                    @php ($correcta ='')
                                    @php ($incorrecta = 'checked')
                                @endif
                                <fieldset class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-check">

                                                <input class="form-check-input" type="radio"
                                                    name="respuestaCorrecta{{($key+1)}}" value="S" {{$correcta}}>
                                                <label class="form-check-label">
                                                    Respuesta correcta
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="respuestaCorrecta{{($key+1)}}" value="N" {{$incorrecta}}>
                                                <label class="form-check-label">
                                                    Respuesta incorrecta
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                @endforeach
                                <button type="submit" id="actualizarPregunta" class="btn btn-primary btn-md mr-0 guardaPregunta"><i class="far fa-save"></i>  Guardar pregunta</button>

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
 {{-- Mensaje saliente si ha dejado algún campo en blanco --}}
@if(Session::has('campo-blanco'))

<script>
    notie.alert({
    
    type: 3,
    text: '¡Ha dejado algún campo en blanco!',
    time: 7

  })

</script>

@endif

 {{-- Mensaje saliente si ha dejado algún campo en blanco --}}
 @if(Session::has('formato-imagen-no-valido'))

 <script>
     notie.alert({
     
     type: 3,
     text: '¡Ha elegido un formato de imagen no válido!',
     time: 7
 
   })
 
 </script>
 
 @endif
@endsection 