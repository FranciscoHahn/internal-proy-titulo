@extends('layout.layout')
@section('content')
    @include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Administración de preparaciones</h3>
                <a href="{{ route('agregarpreparacion') }}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-drumstick-bite"></i>&nbsp;Agregar
                    nueva preparación</a>
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
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Activo</th>
                            <th>Categoría</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preparaciones as $preparacion)
                            <tr>
                                <td>{{ $preparacion->nombre }}<br/>
                                    <small class="text-muted">{{ $preparacion->descripcion }}</small>
                                </td>
                                <td>{{ '$' . number_format($preparacion->precio, 0, ',', '.') }}</td>
                                <td>
                                    @if ($preparacion->activo == 1)
                                        <span class="badge badge-success rounded-pill d-inline">Activo</span>
                                    @else
                                        <span class="badge badge-danger rounded-pill d-inline">Inactivo</span>
                                    @endif
                                </td>
                                <td>{{ $preparacion->categoria }}</td>

                                <td>
                                    <img src="{{ $preparacion->link_image_auxiliar }}" alt="{{ $preparacion->nombre }}"
                                        width="100">
                                </td>
                                <td>
                                    <a href="{{ route('editarpreparacion', ['id' => $preparacion->id]) }}" type="button" class="btn btn-link btn-sm btn-rounded">
                                        Editar
                                    </a>
                                    <!-- Verificar el estado del producto para mostrar el botón adecuado -->
                                    @if ($preparacion->activo == 1)
                                        <a href="{{ route('desactivarpreparacion', ['id' => $preparacion->id]) }}" type="button" class="btn btn-link btn-sm btn-rounded">
                                            Desactivar
                                        </a>
                                    @else
                                        <a href="{{ route('activarpreparacion', ['id' => $preparacion->id]) }}" type="button" class="btn btn-link btn-sm btn-rounded">
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
