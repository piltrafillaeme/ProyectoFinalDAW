<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tartessos EF</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--=====================================
	PLUGINS DE CSS
	======================================-->

    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Mis estilos -->
    <link rel="stylesheet" href="{{ url('/') }}/css/styleAlumna.css">

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

    <!-- MI CÓDIGO CORRIGE EXAMEN -->
    <script src="{{ url('/') }}/js/corrigeExamen.js"></script>

    <!-- SWEET ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>


        @include('modulos.headeralumna')

        @yield('contenido')

        @include('modulos.footeralumna')

    

</body>

</html>