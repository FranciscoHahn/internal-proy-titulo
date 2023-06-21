@extends('layout.layout')
@section('content')
    @include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Administración de salidas</h3>
                <a href="{{ route('registrarsalidainventario') }}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-people-carry-box"></i>&nbsp;Crear nueva
                    salida</a>
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
                            <th scope="col">Usuario registro</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salidas as $salida)
                            <tr>
                                <td>{{ $salida->nombres_usuario }} {{ $salida->apellidos_usuario }}</td>
                                <td>{{ $salida->fecha_salida }}</td>
                                <td>{{ $salida->nombre_producto }}</td>
                                <td>{{ $salida->cantidad }}</td>
                                <td> <a href="{{ route('eliminarsalidainventario', ['id' => $salida->id]) }}" class="btn btn-outline-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
