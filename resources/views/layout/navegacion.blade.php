<style>
    body {
        background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
        main {
            padding-left: 240px;
        }
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        padding: 58px 0 0;
        /* Height of navbar */
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        width: 240px;
        z-index: 600;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            width: 100%;
        }
    }

    .sidebar .active {
        border-radius: 5px;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: 0.5rem;
        overflow-x: hidden;
        overflow-y: auto;
        /* Scrollable contents if viewport is shorter than content. */
    }
</style>

<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <a href="{{ route('inicio') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'inicio' ? 'active' : '' }}"
                    aria-current="true">
                    <i class="fas fa-home fa-fw me-3"></i><span>Inicio</span>
                </a>
                @if (Session::get('profile') == 'Administrador')
                    <a href="{{ route('usuarios') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'usuarios' ? 'active' : '' }}">
                        <i class="fas fa-users fa-fw me-3"></i><span>Usuarios</span>
                    </a>
                @endif
                @if (Session::get('profile') == 'Administrador')
                    <a href="{{ route('clientes') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'clientes' ? 'active' : '' }}"><i
                            class="fas fa-users fa-fw me-3"></i><span>Clientes</span></a>
                @endif
                @if (Session::get('profile') == 'Administrador' || Session::get('profile') == 'Bodega')
                    <a href="{{ route('productos') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'productos' ? 'active' : '' }}"><i
                            class="fas fa-carrot fa-fw me-3"></i><span>Productos</span></a>
                @endif
                @if (Session::get('profile') == 'Administrador' || Session::get('profile') == 'Bodega')
                    <a href="{{ route('compras') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'compras' ? 'active' : '' }}">
                        <i class="fas fas fa-truck-moving fa-fw me-3"></i><span>Compras</span>
                    </a>
                @endif
                @if (in_array(Session::get('profile'), ['Administrador', 'Cocina', 'Bodega']))
                    <a href="{{ route('salidasinventario') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'salidas' ? 'active' : '' }}">
                        <i class="fas fa-people-carry-box fa-fw me-3"></i><span>Salidas</span>
                    </a>
                @endif
                @if (in_array(Session::get('profile'), ['Administrador', 'Cocina']))
                    <a href="{{ route('preparaciones') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'preparaciones' ? 'active' : '' }}">
                        <i class="fas fa-drumstick-bite fa-fw me-3"></i><span>Preparaciones</span>
                    </a>
                @endif
                @if (in_array(Session::get('profile'), ['Administrador', 'Mesero']))
                    <a href="{{ route('iniciomesas') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'mesas' ? 'active' : '' }}">
                        <i class="fas fa-table-cells fa-fw me-3"></i><span>Mesas</span>
                    </a>
                @endif
                @if (in_array(Session::get('profile'), ['Administrador', 'Cajero']))
                    <a href="{{ route('pedidospagar') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'atencionescajero' ? 'active' : '' }}">
                        <i class="fas fa-list-check fa-fw me-3"></i><span>Atenciones</span>
                    </a>
                @endif
                @if (Session::get('profile') == 'Cocina')
                    <a href="{{ route('pedidoscocina') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'pedidos' ? 'active' : '' }}"><i
                            class="fas fa-list-check fa-fw me-3"></i><span>Pedidos</span></a>
                @endif
                @if (in_array(Session::get('profile'), ['Administrador', 'Cajero']))
                    <a href="{{ route('ventas') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'ventas' ? 'active' : '' }}"><i
                            class="fas fa-file-invoice-dollar fa-fw me-3"></i><span>Ventas</span></a>
                @endif
                @if (in_array(Session::get('profile'), ['Administrador']))
                    <a href="{{ route('reporteria') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Session::get('linkactivo') == 'reportes' ? 'active' : '' }}">
                        <i class="fas fa-chart-line fa-fw me-3"></i><span>Reportes</span></a>
                @endif
                <a href="{{ route('salir') }}"
                    class="list-group-item list-group-item-action py-2 ripple text-danger"><i
                        class="fas fa-arrow-right-to-bracket fa-fw me-3"></i><span>Salir</span></a>
            </div>

        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('logo.png') }}" height="25" alt="Siglo 21" loading="lazy" />
            </a>
            <span>{{ Session::get('profile') }}</span>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <!-- Notification dropdown -->
                @if (false)
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Some news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
<!--Main Navigation-->
