@extends('layout.layout')
@section('content')
    @include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Registros de compras</h3>
                <a href="{{ route('agregarcompra') }}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-truck-moving"></i>&nbsp;Crear nueva
                    compra</a>
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
                            <th scope="col">Compra</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Total</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras as $compra)
                            <tr>
                                <td>
                                    {{ $compra->nro_doc_compra }}<br />
                                    <small><strong>Proveedor:</strong> {{ $compra->proveedor }}<br />
                                        <strong>Fecha registro:</strong> {{ $compra->fecha_registro }}<small>
                                </td>
                                <td>{{ $compra->fecha_compra }}</td>
                                <td>{{ $compra->total_compra }}</td>
                                <td>
                                    @if ($compra->detalle)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Sin detalles de compra registrados</span>
                                    @endif


                                </td>
                                <td>
                                    @if ($compra->detalle)
                                        <button class="btn btn-link btn-sm" type="button" data-mdb-toggle="collapse"
                                            data-mdb-target="#detalleCompra{{ $compra->id }}" aria-expanded="false"
                                            aria-controls="detalleCompra{{ $compra->id }}"><i class="fas fa-eye"></i>
                                            Detalle</button>

                                        <div class="collapse mt-2" id="detalleCompra{{ $compra->id }}">

                                            <ul class="list-group mb-0 pb-0">
                                                @foreach ($compra->detalle as $detalle)
                                                    <li class="list-group-item">
                                                        <div class="d-flex">
                                                            <div>
                                                                <small>
                                                                    <strong>Nombre:</strong>
                                                                    {{ $detalle->nombre_producto }}<br>
                                                                    <strong>Cantidad:</strong> {{ $detalle->cantidad }}<br>
                                                                    <strong>Precio Unitario:</strong>
                                                                    {{ $detalle->precio_unitario }}<br>
                                                                    <strong>Total:</strong>
                                                                    {{ $detalle->precio_unitario * $detalle->cantidad }}

                                                                </small>
                                                            </div>

                                                        </div>
                                                    </li>

                                                    @if (Session::get('profile') == 'Administrador')
                                                        <li class="list-group-item">
                                                            <a href="{{ route('eliminardetallecompra', ['id' => $detalle->id]) }}"
                                                                class="btn btn-outline-danger">Eliminar</a>
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </ul>

                                        </div>
                                    @endif
                                    @if (!$compra->detalle)
                                        <span class="badge badge-info">Sin acciones disponibles</span>
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
