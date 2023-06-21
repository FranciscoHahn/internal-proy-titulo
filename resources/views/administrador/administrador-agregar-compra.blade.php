@extends('layout.layout')
@section('content')
    @include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between mt-1">
                <h3 class="me-3">Registro de compra</h3>
                <a href="{{ route('compras') }}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-truck-moving"></i>&nbsp;Volver a
                    compras</a>
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
                <form method="POST" action="{{route('agregandocompra')}}" onkeydown="return (event.keyCode !== 13);">
                    <div class="row">

                        <div class="col-7">
                            <label class="form-label" for="">Agregar detalle de compra</label>
                            <table class="table align-middle mb-0 bg-white table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->nombre }}
                                                <small class="text-muted">{{ $producto->marca }}</small>
                                            </td>
                                            <td>{{ $producto->nombre_categoria }}</td>
                                            <td>
                                                <input type="number" value="{{ 0 }}" name="cantidad"
                                                    data-producto="{{ $producto->id }}"
                                                    onchange="actualizarSeleccionado({{ $producto->id }})" />
                                            </td>
                                            <td>
                                                <input type="number" value="{{ 0 }}" name="precio_unitario"
                                                    data-producto="{{ $producto->id }}"
                                                    onchange="actualizarSeleccionado({{ $producto->id }})" />
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-4 col-5">
                            <label class="form-label" for="">Datos de compra</label>
                            <div class="form-outline mb-4">
                                <input type="text" id="proveedor" class="form-control" name="proveedor" value="" />
                                <label class="form-label" for="proveedor">Proveedor</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="date" id="fecha_compra" class="form-control" name="fecha_compra"
                                    value="" />
                                <label class="form-label" for="fecha_compra">Fecha de compra</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="nro_doc_compra" class="form-control" name="nro_doc_compra"
                                    value="" />
                                <label class="form-label" for="nro_doc_compra">Número de documento de compra</label>
                            </div>


                            <div class="form-outline mb-4">
                                <span id="total_compra">Total: $ 0 </span>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" id="productos_cantidad_precio" name="productos_cantidad_precio" value="">

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Crear compra</button>
                </form>


            </div>



        </div>
        <script>
            var productosSeleccionados = {};

            function actualizarSeleccionado(id) {
                var cantidadInput = document.querySelector('input[name="cantidad"][data-producto="' + id + '"]');
                var precioUnitarioInput = document.querySelector('input[name="precio_unitario"][data-producto="' + id + '"]');


                // Actualizar el valor del campo oculto productos_cantidad_precio
                var productosCantidadPrecioInput = document.getElementById('productos_cantidad_precio');
                productosSeleccionados[id] = {
                    cantidad: cantidadInput.value,
                    precioUnitario: precioUnitarioInput.value
                };
                productosCantidadPrecioInput.value = JSON.stringify(productosSeleccionados);
                console.log(JSON.stringify(productosSeleccionados));
                // Calcular el total de la compra y actualizar el elemento visual
                var totalCompra = calcularTotalCompra(productosSeleccionados);
                var totalCompraElement = document.getElementById('total_compra');
                totalCompraElement.textContent = 'Total: $' + totalCompra;
            }

            function calcularTotalCompra(productosSeleccionados) {
                var total = 0;

                for (var id in productosSeleccionados) {
                    if (productosSeleccionados.hasOwnProperty(id)) {
                        var producto = productosSeleccionados[id];
                        var cantidad = parseInt(producto.cantidad);
                        var precioUnitario = parseInt(producto.precioUnitario);
                        total += cantidad * precioUnitario;
                    }
                }

                return total;
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Restablecer los valores de los campos de cantidad y precio_unitario a 0
                var cantidadInputs = document.querySelectorAll('input[name="cantidad"]');
                var precioUnitarioInputs = document.querySelectorAll('input[name="precio_unitario"]');

                cantidadInputs.forEach(function(input) {
                    input.value = 0;
                });

                precioUnitarioInputs.forEach(function(input) {
                    input.value = 0;
                });

                // Restablecer el valor del campo oculto productos_cantidad_precio a vacío
                var productosCantidadPrecioInput = document.getElementById('productos_cantidad_precio');
                productosCantidadPrecioInput.value = '';

                // Restablecer el valor del elemento visual total_compra a $0
                var totalCompraElement = document.getElementById('total_compra');
                totalCompraElement.textContent = 'Total: $0';
            });
        </script>
    </main>
@endsection
