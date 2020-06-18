<nav class="navbar navbar-expand-lg navbar-light bg-light header-alumna">
    
    {{-- logo --}}
    <a class="brand-link">
        <img src="{{url('/')}}/img/logo-jss.jpg" alt="Tartessos EF JSS Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Tartessos EF</span>
      </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link font-weight-normal" href="{{ route('primero.index')}}">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-normal" href="{{ route('primero.notas', Auth::user()->username )}}">Notas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-normal" href="{{ route('primero.vertemas',  Auth::user()->clase)}}">Temas</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{Auth::user()->apellidos}}, {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        {{ __('Cerrar sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </div>
</nav>