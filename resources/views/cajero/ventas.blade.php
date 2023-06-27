@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <main style="margin-top: 58px;">
        <div class="mx-2 mt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Ventas</h3>
            </div>
            <div class="mt-2">
                <table class="table bg-white table-sm" id="tabla-ventas">
                    <thead class="table-dark">
                        <tr>
                            <th>Mesa</th>
                            <th>Fecha</th>
                            <th>Hora</th>

                            <th>Forma de pago</th>
                            <th>Total cuenta</th>
                            <th>Total cancelado</th>
                            <th>Propina</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            @if ($venta->total_cancelado != 0)
                                <tr>
                                    <td>{{ $venta->mesa_id }}</td>
                                    <td>{{ date('Y-m-d', strtotime($venta->fecha_atencion)) }}</td>
                                    <td>{{ date('H:i:s', strtotime($venta->fecha_atencion)) }}</td>

                                    <td>{{ $venta->forma_pago }}</td>

                                    <td>{{ number_format($venta->total_cuenta, 0, '', '') }}</td>
                                    <td><strong>{{ number_format($venta->total_cancelado, 0, '', '') }}</strong></td>
                                    <td>{{ number_format($venta->total_cancelado - $venta->total_cuenta, 0, '', '') }}
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
