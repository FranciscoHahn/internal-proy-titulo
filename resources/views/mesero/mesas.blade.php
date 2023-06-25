@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Administración de mesas</h3>
                @if (Session::get('profile') == 'Administrador')
                    <a href="#" class="btn btn-primary btn-rounded"><i class="fas fa-table-cells"></i>&nbsp;Crear
                        mesa</a>
                @endif
            </div>
            @if (isset($mensaje))
                <div class="rounded bg-success text-white mt-2 px-2">
                    {{ $mensaje }}
                </div>
            @endif
            <div class="row">
                @foreach ($mesas as $mesa)
                    <div class="col-3 mt-2">
                        <div class="card border border-{{ $mesa->estado == 'disponible' ? 'success' : 'primary' }}">
                            <div class="card-body {{$mesa->estado == 'deshabilitada' ? 'opacity-50' : ''}}">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">Mesa # {{ $mesa->numero }}</h5>
                                    @if (Session::get('profile') == 'Administrador')
                                        <small><a href="#"
                                                class="btn btn-sm btn-outline-primary"><small>Modificar</small></a></small>
                                    @endif
                                </div>
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
                                    <a href="{{ route('iniciaratencion', ['idmesa' => $mesa->id]) }}"
                                        class="btn btn-outline-success">Iniciar atención</a>
                                @endif

                                @if (Session::get('profile') == 'Administrador' && $mesa->estado == 'deshabilitada')
                                    <a href="#" class="btn btn-sm btn-outline-success">Habilitar</a>
                                @elseif(Session::get('profile') == 'Administrador' && $mesa->estado == 'disponible')
                                    <a href="#" class="btn btn-sm btn-outline-warning ">Deshabilitar</a>
                                @endif

                                @if ($mesa->estado == 'ocupada')
                                    <a href="{{ route('veratencion', ['idmesa' => $mesa->id]) }}"
                                        class="btn btn-outline-primary">Ver atención</a>
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </main>
@endsection
