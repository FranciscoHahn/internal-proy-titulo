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
                <li>Registrar compras</li>
                <li>Registrar salidas de inventario</li>

            </ul>

            </p>
            <p class="text-warning">
                En caso de errores, el administrador puede eliminar registros.
            </p>



        </div>
    </main>
@endsection
