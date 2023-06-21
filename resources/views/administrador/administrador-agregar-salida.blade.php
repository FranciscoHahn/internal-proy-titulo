@extends('layout.layout')
@section('content')
    @include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between mt-1">
                <h3 class="me-3">Registro de salida de inventario</h3>
                <a href="{{ route('salidasinventario') }}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-people-carry-box"></i>&nbsp;Volver a
                    salidas</a>
            </div>
            @if (isset($mensaje))
                @if ($mensaje != 'Registro Finalizado')
                    <div class="rounded bg-warning text-white mt-2 px-2">
                        {{ $mensaje }}
                        <ul>
                            @foreach ($errores as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="rounded bg-success text-white mt-2 px-2">
                        {{ $mensaje }}
                    </div>
                @endif

            @endif

            <div class="mt-4">
                <form method="POST" action="{{route('creandosalidasdeinventario')}}" onkeydown="return (event.keyCode !== 13);">
                    <label class="form-label" for="">Agregar detalle de salida</label>
                    <table class="table align-middle mb-0 bg-white table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Stock</th>
                                <th>Solicitud</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->nombre }}
                                        <small class="text-muted">{{ $producto->marca }}</small>
                                    </td>
                                    <td>{{ $producto->nombre_categoria }}</td>
                                    <td>Bodega: {{ $producto->stock_bodega }}<br />
                                        Crítico: {{ $producto->stock_critico }}</td>
                                    <td>

                                        <input type="number" value="{{ 0 }}" name="cantidad"
                                            data-producto="{{ $producto->id }}"
                                            onchange="actualizarSeleccionado({{ $producto->id }}, {{ $producto->stock_bodega }}, {{ $producto->stock_critico }})" /><br/>
                                        <small><label class="badge badge-info" for="cantidad" data-producto="{{ $producto->id }}"></label></small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <input type="hidden" id="productos_cantidad_precio" name="productos_cantidad_precio" value="">

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Crear salidas de inventario</button>
                </form>


            </div>



        </div>
        <script>
            var productosSeleccionados = {};

            function actualizarSeleccionado(id, stockBodega, stockCritico) {
                var cantidadInput = document.querySelector('input[name="cantidad"][data-producto="' + id + '"]');
                var cantidad = parseInt(cantidadInput.value);
                var mensajeLabel = document.querySelector('label[data-producto="' + id + '"]');

                if (cantidad > stockBodega) {
                    cantidadInput.value = stockBodega;
                    mensajeLabel.textContent = 'No hay suficiente stock';
                } else if (stockBodega - cantidad < stockCritico) {
                    mensajeLabel.textContent = 'Advertencia: se alcanzará stock crítico';
                } else {
                    mensajeLabel.textContent = 'Stock disponible';
                }

                // Actualizar el valor del campo oculto productos_cantidad_precio
                var productosCantidadPrecioInput = document.getElementById('productos_cantidad_precio');
                productosSeleccionados[id] = {
                    cantidad: cantidadInput.value
                };
                productosCantidadPrecioInput.value = JSON.stringify(productosSeleccionados);
                console.log(JSON.stringify(productosSeleccionados));
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Restablecer los valores de los campos de cantidad y precio_unitario a 0
                var cantidadInputs = document.querySelectorAll('input[name="cantidad"]');

                cantidadInputs.forEach(function(input) {
                    input.value = 0;
                });

                // Restablecer el valor del campo oculto productos_cantidad_precio a vacío
                var productosCantidadPrecioInput = document.getElementById('productos_cantidad_precio');
                productosCantidadPrecioInput.value = '';
            });
        </script>
    </main>
@endsection
