@extends('layout.layout')
@section('content')
@include('layout.navegacion')
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Administración de usuarios</h3>
                <a href="{{ route('crearusuario') }}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-plus"></i>&nbsp;Agregar
                    nuevo usuario</a>
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
                            <th>Usuario</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            @if ($usuario->id != Session::get('id_usuario'))
                                <tr>
                                    <td>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{ $usuario->nombres }} {{ $usuario->apellidos }}</p>

                                            @if (strpos($usuario->run, '-') === false)
                                                {{ substr_replace($usuario->run, '-', -1, 0) }}
                                            @else
                                                {{ $usuario->run }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1">{{ $usuario->perfil_usuario }}</p>
                                    </td>
                                    <td>
                                        @if ($usuario->activo == 1)
                                            <span class="badge badge-success rounded-pill d-inline">Activo</span>
                                        @else
                                            <span class="badge badge-danger rounded-pill d-inline">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        <a href="{{ route('editarusuario', ['id' => $usuario->id]) }}" type="button" class="btn btn-link btn-sm btn-rounded">
                                            Editar
                                        </a>
                                        @if ($usuario->activo == 1)
                                            <a href="{{ route('desactivarusuario', ['id' => $usuario->id]) }}"
                                                type="button" class="btn btn-link btn-sm btn-rounded">
                                                Desactivar
                                            </a>
                                        @else
                                            <a href="{{ route('activarusuario', ['id' => $usuario->id]) }}" type="button"
                                                class="btn btn-link btn-sm btn-rounded">
                                                Activar
                                            </a>
                                        @endif


                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>



        </div>
    </main>
@endsection
