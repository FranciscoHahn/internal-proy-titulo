@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <h3>Bienvenido al panel de {{ Session::get('profile') }} {{ Session::get('fullName') }}</h3>
            <p>
                Este panel permite un acceso rápido a las funciones correspondientes a su perfil podrá:
            <ul>
                <li>Revisar atenciones, imprimir vouchers y registar pagos</li>
                <li>Reportería de ventas</li>
            </ul>
            </p>



        </div>
    </main>
@endsection
