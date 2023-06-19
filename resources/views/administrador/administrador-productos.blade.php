@extends('layout.layout')
@section('content')
@include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Administración de productos</h3>
                <a href="{{ route('agregarproducto') }}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-carrot"></i>&nbsp;Agregar
                    nuevo producto</a>
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Stock Bodega</th>
                            <th scope="col">Stock Crítico</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th> <!-- Nueva columna de acciones -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->nombre }}
                                </td>
                                <td>{{ $producto->marca }}</td>
                                <td><img src="{{ $producto->link_imagen }}" alt="{{ $producto->nombre }}" width="100">
                                </td>
                                <td>{{ $producto->nombre_categoria }}</td>
                                <td>{{ $producto->stock_bodega }} </td>
                                <td>{{ $producto->stock_critico }}</td>
                                <td>{{ $producto->descripcion_unidad }}</td>
                                <td>
                                    @if ($producto->activo == 1)
                                        <span class="badge badge-success rounded-pill d-inline">Activo</span>
                                    @else
                                        <span class="badge badge-danger rounded-pill d-inline">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('editarproducto', ['id' => $producto->id]) }}" type="button"
                                        class="btn btn-link btn-sm btn-rounded">
                                        Editar
                                    </a>
                                    <!-- Verificar el estado del producto para mostrar el botón adecuado -->
                                    @if ($producto->activo == 1)
                                        <a href="{{ route('desactivarproducto', ['id' => $producto->id]) }}" type="button"
                                            class="btn btn-link btn-sm btn-rounded">
                                            Desactivar
                                        </a>
                                    @else
                                        <a href="{{ route('activarproducto', ['id' => $producto->id]) }}" type="button"
                                            class="btn btn-link btn-sm btn-rounded">
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
