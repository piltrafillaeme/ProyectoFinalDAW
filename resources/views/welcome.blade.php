<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Moodle Académica</title>
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

{{-- 	<link rel="icon" href="{{$blog[0]["icono"]}}"> --}}

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
    <script src="{{ url('/') }}/js/plugins/jquery.overlayScrollbars.min.js"></script>

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

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 50px;
            margin-bottom: -20px;
            letter-spacing: .1rem;
        }

        .subtitle {
            font-size: 60px;
            letter-spacing: .1rem;
        }

        .links > a {
            color: #FFFEFD;
            padding: 25px 25px;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 35px;
        }

        .btn {
            background-color: #0380A9;
        }

        .btn:hover {
            background-color: #636b6f;
            color: #FFFEFD;
        }


        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="flex-center position-ref">
    <div class="content">
        <img src="{{url('/')}}/img/logo-jss.jpg" alt="">
        <div class="titulo">
            <p class="title">Tartessos</p>
            <p class="subtitle">EF</p>
        </div>
        <div>
            @if (Route::has('login'))
                <div class="flex-center position-ref links">
                @auth
                <a type="button" class="btn btn-dark" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Cerrar sesión') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a type="button" class="btn mr-3" href="{{ route('login') }}">Iniciar sesión</a>
               {{--  @if (Route::has('register'))
                    <a type="button" class="btn" href="{{ route('register') }}">Registrar</a>
                @endif --}}
                @endauth
            @endif
        </div>
    </div>
</div>
</body>
</html>