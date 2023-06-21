@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="row mx-3">
            @foreach ($mesas as $mesa)
                <div class="col-3 mt-2">
                    <div class="card border border-{{ $mesa->estado == 'disponible' ? 'success' : 'primary' }}">
                        <div class="card-body">
                            <h5 class="card-title">Mesa # {{ $mesa->numero }}</h5>
                            <p class="card-text">
                                Capacidad: {{ $mesa->capacidad }}
                                <br />
                                @if ($mesa->estado == 'disponible')
                                    <span class="badge badge-success">{{ $mesa->estado }}</span>
                                @endif

                                @if ($mesa->estado == 'deshabilitada')
                                    <span class="badge badge-danger">{{ $mesa->estado }}</span>
                                @endif

                                @if ($mesa->estado == 'ocupada')
                                    <span class="badge badge-info">{{ $mesa->estado }}</span>
                                @endif

                            </p>
                            @if ($mesa->estado == 'disponible' && Session::get('profile') == 'Mesero')
                                <a href="#" class="btn btn-outline-success">Iniciar atención</a>
                            @endif

                            @if ($mesa->estado == 'deshabilitada')
                                @if (Session::get('profile') == 'Administrador')
                                    <a href="#" class="btn btn-outline-warning">Habilitar</a>
                                @else
                                    <span class="badge badge-danger">Solo un administrador puede habilitar la mesa</span>
                                @endif
                            @endif

                            @if ($mesa->estado == 'ocupada')
                                <a href="#" class="btn btn-outline-success">Ver atención</a>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>
@endsection
