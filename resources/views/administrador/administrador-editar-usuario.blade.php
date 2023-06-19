@extends('layout.layout')
@section('content')
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
                    <a href="{{ route('inicio') }}" class="list-group-item list-group-item-action py-2 ripple " aria-current="true">
                        <i class="fas fa-home fa-fw me-3"></i><span>Inicio</span>
                    </a>
                    <a href="{{ route('usuarios') }}" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-users fa-fw me-3"></i><span>Usuarios</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-users fa-fw me-3"></i><span>Clientes</span></a>
                    <a href="{{route('productos')}}" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-pizza-slice fa-fw me-3"></i><span>Productos</span></a>

                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-book-open fa-fw me-3"></i><span>Menu</span>
                    </a>                   
                    <a href="././salir" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-table-cells fa-fw me-3"></i><span>Mesas</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-file-invoice-dollar fa-fw me-3"></i><span>Ventas</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple text-danger" ><i
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
                    <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="25"
                        alt="Siglo 21" loading="lazy" />
                </a>
                <span>{{ Session::get('profile') }}</span>

                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Notification dropdown -->
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

                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between mt-1">
                <h3 class="me-3">Edición de usuario</h3>
                <a href="{{ route('usuarios') }}" class="btn btn-primary btn-rounded"><i class="fas fa-arrow-left"></i>&nbsp;Volver a
                    usuarios</a>
            </div>
            @if (isset($mensaje))
                @if ($mensaje != 'Modificación Finalizada')
                    <div class="rounded bg-warning text-white mt-2 px-2">
                        {{ $mensaje }}
                        <ul>
                            @foreach ($errores as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="rounded bg-success text-white mt-2 px-2">
                        {{ $mensaje }}
                    </div>
                @endif

            @endif

            <div class="mt-4">
                <form method="POST" action="{{route('edicionusuario')}}">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="form6Example1" class="form-control" name="nombres" value="{{$datausuario->nombres}}"/>
                                <label class="form-label" for="form6Example1">Nombres</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="form6Example2" class="form-control" name="apellidos" value="{{$datausuario->apellidos}}"/>
                                <label class="form-label" for="form6Example2">Apellidos</label>
                            </div>
                        </div>
                    </div>

                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form6Example4" class="form-control" name="username" value="{{$datausuario->username}}"/>
                        <label class="form-label" for="form6Example4">Nombre de usuario</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form6Example5" class="form-control" name="email" value="{{$datausuario->email}}"/>
                        <label class="form-label" for="form6Example5">Email</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" id="form6Example6" class="form-control" name="rut" value="{{$datausuario->run}}"/>
                        <label class="form-label" for="form6Example6">Rut</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="number" id="form6Example6" class="form-control" name="telefono" value="{{$datausuario->telefono}}"/>
                        <label class="form-label" for="form6Example6">Teléfono</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form6Example6" class="form-control" name="password" value="{{$datausuario->password}}"/>
                        <label class="form-label" for="form6Example6">Contraseña</label>
                    </div>
                    <div class="form-outline mb-4">
                        <!-- Default radio -->
                        <label class="form-label" for="">Seleccione Perfil</label>
                        @foreach ($perfiles as $perfil)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="id_perfil" id="flexRadioDefault1"
                                    value="{{ $perfil->id }}" @if ($perfil->id == $datausuario->id_perfil)
                                        checked
                                    @endif/>
                                <label class="form-check-label" for="flexRadioDefault1"> {{ $perfil->nombre }} </label>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="id" value="{{$datausuario->id}}" />


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Modificar usuario</button>
                </form>

            </div>



        </div>
    </main>
@endsection
