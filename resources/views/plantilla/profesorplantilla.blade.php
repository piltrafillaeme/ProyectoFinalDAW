<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tartessos EF</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--=====================================
	PLUGINS DE CSS
	======================================-->

    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/OverlayScrollbars.min.css">

    <!-- TAGS INPUT -->
    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/tagsinput.css">

    <!-- SUMMERNOTE -->
    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/summernote.css">

    <!-- NOTIE -->
    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/notie.css">

    <!-- CSS AdminLTE -->
    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/adminlte.min.css">

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Mis estilos -->
    <link rel="stylesheet" href="{{ url('/') }}/css/styleProfesor.css">


    <!--=====================================
	PLUGINS DE JS
	======================================-->

    {{-- Fontawesome --}}
    <script src="https://kit.fontawesome.com/e632f1f723.js" crossorigin="anonymous"></script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- overlayScrollbars -->
    {{-- <script src="{{ url('/') }}/js/plugins/jquery.overlayScrollbars.min.js"></script> --}}

    <!-- TAGS INPUT -->
    {{-- https://www.jqueryscript.net/form/Bootstrap-4-Tag-Input-Plugin-jQuery.html --}}
    <script src="{{ url('/') }}/js/plugins/tagsinput.js"></script>

    <!-- SUMMERNOTE -->
    {{-- https://summernote.org/ --}}
    <script src="{{ url('/') }}/js/plugins/summernote.js"></script>

    <!-- NOTIE -->
    {{-- https://github.com/jaredreich/notie --}}
    <script src="{{ url('/') }}/js/plugins/notie.js"></script>

    <!-- JS AdminLTE -->
    <script src="{{ url('/') }}/js/plugins/adminlte.js"></script>

    <!-- CHARTS FOR LARAVEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

     <!-- MI CÓDIGO-->
     <script src="{{ url('/') }}/js/micodigo.js"></script>
     <!-- CÓDIGO PARA GRÁFICO DE DONUT -->
     {{-- <script src="{{ url('/') }}/js/estadisticaNotas.js"></script> --}}

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('modulos.header')

        @include('modulos.sidebar')

        {{-- @include('paginas.blog') --}}
        @yield('contenido')


        @include('modulos.footer')

    </div>

    {{-- para capturar la url de mi cms: --}}
    <input type="hidden" id="ruta" value="{{url('/')}}">
    
    <script src="{{ url('/') }}/js/micodigo.js"></script>
</body>

</html>