@extends('plantilla.profesorplantilla')

@section('contenido')
<div class="content-wrapper" style="min-height: 640px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    {{-- <h1>Estadísticas de notas</h1> --}}

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Inicio</a></li>

                        <li class="breadcrumb-item"><a href="{{url('/profesor')}}">Listado alumn@s</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('profesor.vernotasalumna', $alumna->id)}}">Estadísticas notas</a></li>

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

                        <div class="card-header text-white d-flex justify-content-center">
                            <h3>Estadística de notas</h3>
                        </div>

                        <div class="card-body">

                            <canvas id="line-chart"></canvas>
                           

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


<script>
    var notas = [0,1,2,3,4,5,6,7,8,9,10];

    var data_labels = <?php echo $labels; ?>;
    
    console.log(data_labels);
    data_labels.unshift('');
    var data_notas = <?php echo $notas; ?>;
    console.log(data_notas);
    data_notas.unshift(0);
    data_notas.push(10);
    console.log(data_notas);
    var lineChartData = {
        labels: data_labels,
        datasets: [{
            label: 'Exámenes realizados',
            backgroundColor: "rgba(220,220,220,0.5)",
            data: data_notas
        }]
    };

    var chartOptions = {
        legend: {
            display: true,
            responsive: true,
            position: 'bottom',
            labels: {
                boxWidth: 80,
                fontColor: 'black'
            }
        }
    };
    var ctx = document.getElementById("line-chart").getContext("2d");
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: lineChartData,
        options: chartOptions,
});

</script>

@endsection