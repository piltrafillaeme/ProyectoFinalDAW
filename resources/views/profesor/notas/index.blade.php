@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Estadísticas de notas</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/tests',$curso->id)}}">Inicio</a></li>
                        
                        <li class="breadcrumb-item"><a href="{{url('/tests')}}">Cursos</a></li>

                        <li class="breadcrumb-item"><a href="{{route('tests.testscurso',$curso->id)}}">Exámenes de {{$curso->nombrecurso}}</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('tests.estadisticas', $test -> id)}}">Estadísticas notas</a></li>
                        
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

                        

                        <div class="card-body">

                            {{-- Start creating your amazing application! --}}
                            <canvas id="pie-chart"></canvas>
                         {{--    {!! $chart->container() !!}
                            {!! $chart->script() !!} --}}
                           

                        </div>

                        <!-- /.card-body -->


                    </div>

                    <!-- /.card -->
                    

                </div>

            </div>

        </div>

    </section>

    <!-- /.content -->

</div>

{{-- Script antiguo para donut chart --}}
<script>
    $(function() {
    //get the pie chart canvas
    
    var cData = @json($chart);
    console.log(cData);
    var ctx = $("#pie-chart");
    console.log(cData.datasets[0].values);

    //pie chart data
    var data = {
        labels: cData.labels,
        datasets: [
            {
                label: "Nota Alumna",
                data: cData.datasets,
            }
        ]
    };

    //options
    var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Notas de las alumnas/os",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
    };

    //create Pie Chart class object
    var chart1 = new Chart(ctx, {
        type: "pie",
        data: {
            labels: cData.labels,
            datasets: [{
                data: cData.datasets[0].values,
                backgroundColor: ['#2C872C', '#ad1313']
            }]
        },
        options: options
      });
})
</script>



@endsection