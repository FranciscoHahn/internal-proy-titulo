@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Administración de clientes</h3>
            </div>
            @if (isset($mensaje))
                <div class="rounded bg-success text-white mt-2 px-2">
                    {{ $mensaje }}
                </div>
            @endif

            <div class="mt-2">
                <table class="table align-middle mb-0 bg-white table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Vía de registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>
                                    {{ $cliente->nombre }} {{ $cliente->apellido }}
                                </td>
                                <td>
                                    @if (strpos($cliente->sub, 'facebook') !== false)
                                        <span class="badge badge-primary"><i class="fab fa-facebook"></i></span> Registro vía
                                        facebook
                                    @else
                                        {{ $cliente->email }}
                                    @endif
                                </td>
                                <td>
                                    @if (strpos($cliente->sub, 'facebook') !== false)
                                        <span class="badge badge-primary"><i class="fab fa-facebook"></i></span> Registro
                                        vía Facebook
                                    @elseif (strpos($cliente->sub, 'google-oauth2') !== false)
                                        <span class="badge badge-danger"><i class="fab fa-google"></i></span> Registro vía
                                        Google
                                    @else
                                        {{ $cliente->telefono }}
                                    @endif

                                </td>

                                <td>
                                    @if (strpos($cliente->sub, 'facebook') !== false)
                                        <span class="badge badge-primary"><i class="fab fa-facebook"></i> Facebook</span>
                                    @elseif (strpos($cliente->sub, 'google-oauth2') !== false)
                                        <span class="badge badge-danger"><i class="fab fa-google"></i> Google</span>
                                    @else
                                        <span class="badge badge-secondary">Legacy</span>
                                    @endif

                                </td>
                                <td>
                                    @if ($cliente->activo == 1)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Inactivo</span>
                                    @endif

                                </td>



                                <td>
                                    @if ($cliente->activo == 1)
                                        <a href="{{ route('desactivarcliente', ['id' => $cliente->id]) }}" type="button" class="btn btn-link btn-sm btn-rounded">
                                            Desactivar
                                        </a>
                                    @else
                                        <a href="{{ route('activarcliente', ['id' => $cliente->id]) }}" type="button" class="btn btn-link btn-sm btn-rounded">
                                            Activar
                                        </a>
                                    @endif


                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>



        </div>
    </main>
@endsection
