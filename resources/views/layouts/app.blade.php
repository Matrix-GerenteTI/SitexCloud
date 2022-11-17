<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- icon navegator -->
    <link rel="shortcat icon" href="/matrix/public/images/favicon.png"> 

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>

<body class="hold-transition sidebar layout-fixed">
    @auth
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/matrix/public/dashboard" class="nav-link">INICIO</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="/matrix/public/logout" method="POST">
                        @csrf
                        <a class="nav-link text-danger" data-slide="true" href="#" onclick="this.closest('form').submit()">Salir
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/matrix/public/dashboard" class="brand-link">
                <img src="../../matrix/public/images/logo.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">MATRIX</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar" >
                <!-- Sidebar user panel (optional) -->
                <div class="mt-3 pb-3 mb-3">
                    <div class="row">
                        <div class="image col-md-5 col-sm-5 col-xs-5" style="text-align:center">
                            <img src="../../intranet/Empresa/foto_empleado/{{ Auth::user()->idempleado }}.jpg" class="img-circle" id="imageEmpleado">
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-7" style="text-align:center">
                            <div class="row">
                                <div class="col">
                                    <h5>
                                    <a href="#" class="d-block">{{ Auth::user()->nombre }}</a>
                                    </h5>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/matrix/public/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-th"></i>
                                <p>
                                    Inicio
                                </p>
                            </a>
                        </li>
                        @if( Auth::user()->tipo == 1 || Auth::user()->idempleado == 1 || Auth::user()->idempleado == 988 )
                        <li class="nav-item has-treeview {{ request()->is('ti_permisos', 'ti_excepciones', 'cartaporte', 'ti_usuarioSucursal', 'ti_usuarioincidencia', 'ti_cartaporte') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('ti_permisos', 'ti_excepciones', 'cartaporte', 'ti_usuarioSucursal', 'ti_usuarioincidencia', 'ti_cartaporte') ? 'active' : '' }}">
                                <i class="fas fa-laptop nav-icon"></i>
                                <p>
                                    T. I.
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <!--<ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/ti_usuarioincidencia" class="nav-link {{ request()->is('ti_usuarioincidencia') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Usuario Incidencia</p>
                                    </a>
                                </li>
                            </ul>-->
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/ti_excepciones" class="nav-link {{ request()->is('ti_excepciones') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Excepciones</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/ti_usuarioSucursal" class="nav-link {{ request()->is('ti_usuarioSucursal') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Usuario Sucursal</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-tasks nav-icon"></i>
                                <p>
                                    SGC
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/SGC_recursos" class="nav-link">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Recursos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ request()->is('nomina_empleados', 'nomina_parametros') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('nomina_empleados', 'nomina_parametros') ? 'active' : '' }}">
                                <i class="fas fa-money-check-alt nav-icon"></i>
                                <p>
                                    Nómina
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/nomina_empleados" class="nav-link {{ request()->is('nomina_empleados') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Empleados</p>
                                    </a>
                                </li>
                            </ul>
                            <!--<ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/nomina_parametros" class="nav-link {{ request()->is('nomina_parametros') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Parametros</p>
                                    </a>
                                </li>
                            </ul>-->
                        </li>
                        
                        <li class="nav-item has-treeview {{ request()->is('contabilidad_activosfijos') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('contabilidad_activosfijos') ? 'active' : '' }}">
                                <i class="fas fa-balance-scale nav-icon"></i>
                                <p>
                                    Contabilidad
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/contabilidad_activosfijos" class="nav-link {{ request()->is('contabilidad_activosfijos') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Activos Fijos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ request()->is('RH_quizz', 'RH_incidencias', 'RH_resguardos') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('RH_quizz', 'RH_incidencias', 'RH_resguardos') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-industry"></i>
                                <p>Recursos Humanos
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/RH_resguardos" class="nav-link {{ request()->is('RH_resguardos') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Resguardos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/matrix/public/RH_quizz" class="nav-link {{ request()->is('RH_quizz') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Quizz</p>
                                    </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a href="/matrix/public/RH_incidencias" class="nav-link {{ request()->is('RH_incidencias') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Incidencias</p>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ request()->is('compras_proveedor') ? 'menu-open' : '' }}"">
                            <a href="#" class="nav-link {{ request()->is('compras_proveedor') ? 'active' : '' }}">
                                <i class="nav-icon fab fa-shopify"></i>
                                <p>Compras
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/compras_proveedor" class="nav-link {{ request()->is('compras_proveedor') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Compras Proveedor</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ request()->is('almacen_politicaPrecios') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('almacen_politicaPrecios') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-table"></i>
                                <p>Almacén
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/almacen_politicaPrecios" class="nav-link {{ request()->is('almacen_politicaPrecios') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Politica de Precios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ request()->is('ventas_facturacion', 'ventas_pedido') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('ventas_facturacion', 'ventas_pedido') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-shopping-cart"></i>
                                <p>
                                    Ventas
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/ventas_pedido" class="nav-link {{ request()->is('ventas_pedido') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Pedidos</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/ventas_facturacion" class="nav-link {{ request()->is('ventas_facturacion') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Facturación</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if( Auth::user()->tipo == 1 || Auth::user()->idempleado == 988)
                        <li class="nav-item has-treeview {{ request()->is('cavim_registroVehiculos', 'nuevo_vehiculo', 'bono_choferes') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('cavim_registroVehiculos', 'nuevo_vehiculo', 'bono_choferes') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-video"></i>
                                <p>CAVIM
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/cavim_registroVehiculos" class="nav-link {{ request()->is('cavim_registroVehiculos') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Registro de Vehículos</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/nuevo_vehiculo" class="nav-link {{ request()->is('nuevo_vehiculo') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Nuevo Vehículo</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-treeview">
                                <li class="nav-item">
                                    <a href="/matrix/public/bono_choferes" class="nav-link {{ request()->is('bono_choferes') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Bono Choferes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div id="app">
            @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->

    </div>
    @endauth
    <div id="app" class="container">
        @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>

    <script>
        
        console.log("Aqui")
        let prueba = 4;
    </script>
    

    <style>
        #imageEmpleado{
            width: 100px;
            height: 100px;
        }
    </style>
</body>
</html>
