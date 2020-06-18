@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">
  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Apartado cuestionarios (Curso: {{-- {{$curso->nombrecurso}} --}})</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('/curso')}}">Inicio</a></li>

            <li class="breadcrumb-item"><a href="#">Cuestionarios</a></li>

            <li class="breadcrumb-item"><a href="#">Añadir cuestionario</a></li>

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

              <h3>Nuevo test</h3>

            </div>

            <div class="card-body">

              {{-- Start creating your amazing application! --}}
              <form method="POST" action="{{-- {{ route('tests.store') }} --}}">
                @csrf
              
            </form>
            <!-- /.card-footer-->

          </div>

          <!-- /.card -->

        </div>

      </div>

    </div>

  </section>
</div>
@endsection