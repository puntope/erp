<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">

        <div id="user-profile-nav" class="pull-right">

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="/img/profiles/{{Auth::user()->avatar}}" alt="{{Auth::user()->alias}} avatar " class="img-circle" width="25" height="25" /></a>
                        <ul class="dropdown-menu">
                            <li><strong class="dropdown-header">{{Auth::user()->name}} {{Auth::user()->apellidos}}</strong></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/user/{{Auth::user()->id}}">Mi perfil</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/auth/logout">Cerrar sesión</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

        </div><!-- /.user-profile-nav-->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" alt="ERP rIL"><img src="/img/ril-logo-blanco_menu.png" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/tareas">Tareas</a></li>
                <li><a href="/analisis">Análisis</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Proyectos</a>
                    <ul class="dropdown-menu">
                        <li><a href="/desarrollos">Proyectos en curso</a></li>
                        <li><a href="/desarrollos/finalizados">Proyectos finalizados</a></li>
                        <li><a href="/proyectos">Tipos de Proyecto</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientes</a>
                    <ul class="dropdown-menu">
                        <li><a href="/clientes">Clientes</a></li>
                        <li><a href="/clientes/todos">Todos los clientes</a></li>
                        <li><a href="/clientes/tipos">Tipos de clientes</a></li>
                    </ul>
                </li>

                @if (Auth::user()->hasRole(2))
                    <li><a href="/comerciales">Acciones comerciales</a></li>
                    <li><a href="/user">Empleados</a></li>
                @endif
            </ul>

        </div><!-- /.navbar-collapse -->




    </div><!-- /.container-fluid -->
</nav>

