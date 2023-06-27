@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <h3>Bienvenido al panel de {{ Session::get('profile') }} </h3>
            <hr/>
            <h5 class="text-muted">
                {{ Session::get('fullName') }}
            </h5>
            <p>
                Este panel permite un acceso rápido a las funciones correspondientes a su perfil podrá:
            <ul>
                <li>Administrar usuarios</li>
                <li>Administrar productos de bodega</li>
                <li>Administrar clientes</li>
                <li>Administrar preparaciones (menu disponible)</li>
                <li>Revisar ventas</li>
                <li>Observar Atenciones y mesas</li>
                <li>Registrar compras, estas corresponden a las entradas de inventario</li>
                <li>Consultar salidas de inventario (salidas de inventario desde bodega a cocina)</li>
                <li>Acceder a reportería</li>
            </ul>

            </p>



        </div>
    </main>
@endsection
