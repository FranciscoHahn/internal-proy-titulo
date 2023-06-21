@extends('layout.layout')
@section('content')
    @include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between mt-1">
                <h3 class="me-3">Edición de preparación</h3>
                <a href="{{route('preparaciones')}}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-drumstick-bite"></i>&nbsp;Volver a
                    preparaciones</a>
            </div>
            @if (isset($mensaje))
                @if ($mensaje != 'Edición Finalizada')
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
                <form method="POST" action="{{ route('editandopreparacion') }}">
                    <div class="row">

                        <div class="col-7">
                            <label class="form-label" for="">Seleccione productos para preparación</label>
                            <table class="table align-middle mb-0 bg-white table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->nombre_categoria }}</td>
                                            <td>
                                                <input type="checkbox" name="" value="{{ $producto->id }}"
                                                    onchange="agregarSeleccionado({{ $producto->id }}, this.checked)"
                                                    @if (isset($productos_prep)) @if (in_array($producto->id, $productos_prep)) 
                                                            checked @endif
                                                    @endif
                                                >
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-4 col-5">
                            <label class="form-label" for="">Datos de preparación</label>
                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example1" class="form-control" name="nombre"
                                    value="{{ isset($data_preparacion) ? $data_preparacion['nombre'] : '' }}" />
                                <label class="form-label" for="form6Example1">Nombre</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="number" id="form6Example2" class="form-control" name="precio"
                                    value="{{ isset($data_preparacion) ? intval($data_preparacion['precio']) : '' }}" />
                                <label class="form-label" for="form6Example2">Precio</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example5" class="form-control" name="descripcion"
                                    value="{{ isset($data_preparacion) ? $data_preparacion['descripcion'] : '' }}" />
                                <label class="form-label" for="form6Example5">Descripción</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example6" class="form-control" name="categoria"
                                    value="{{ isset($data_preparacion) ? $data_preparacion['categoria'] : '' }}" />
                                <label class="form-label" for="form6Example6">Categoría</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example4" class="form-control" name="link_image_auxiliar"
                                    value="{{ isset($data_preparacion) ? $data_preparacion['link_image_auxiliar'] : '' }}" />
                                <label class="form-label" for="form6Example4">Link imagen</label>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="id_preparacion" value="{{ isset($data_preparacion) ? $data_preparacion['id'] : '' }}"/>
                    <input type="hidden" id="productos_componentes" name="productos_componentes"
                        value="{{ isset($productos_prep_str) ? $productos_prep_str : '' }}">

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Editar preparación</button>
                </form>


            </div>



        </div>
        <script>
            // Obtener el valor inicial de productos_componentes y asignarlo a productosSeleccionados
            var productosComponentes = document.getElementById('productos_componentes').value;
            var productosSeleccionados = productosComponentes !== '' ? productosComponentes.split(',') : [];

            function agregarSeleccionado(id, isChecked) {
                var index = productosSeleccionados.indexOf(id.toString());

                if (isChecked && index === -1) {
                    // Agregar el ID del producto al array si está marcado y no está presente
                    productosSeleccionados.push(id);
                } else if (!isChecked && index !== -1) {
                    // Eliminar el ID del producto del array si no está marcado y está presente
                    productosSeleccionados.splice(index, 1);
                }

                // Asignar los valores seleccionados al campo oculto en el formulario
                document.getElementById('productos_componentes').value = productosSeleccionados.join(',');
                console.log(productosSeleccionados.join(','));
            }
        </script>
    </main>
@endsection
