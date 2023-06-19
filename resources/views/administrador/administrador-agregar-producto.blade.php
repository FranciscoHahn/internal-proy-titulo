@extends('layout.layout')
@section('content')
@include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between mt-1">
                <h3 class="me-3">Creación de producto</h3>
                <a href="{{ route('productos') }}" class="btn btn-primary btn-rounded"><i
                        class="fas fa-carrot"></i>&nbsp;Volver a
                    productos</a>
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
                <form method="POST" action="{{route('registroproducto')}}">
                    <div class="row mb-4">
                        <!-- Categorías (Alineación izquierda) -->
                        <div class="col-3">
                            <div class="form-outline">
                                <label class="form-label" for="">Seleccione una categoría</label>
                                @foreach ($categorias as $categoria)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="id_categoria"
                                            id="flexRadioDefault1" value="{{ $categoria->id }}" />
                                        <label class="form-check-label" for="flexRadioDefault1"> {{ $categoria->nombre }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Resto de los campos (Alineación derecha) -->
                        <div class="col">
                            <label class="form-label" for="">Datos del producto</label>
                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example1" class="form-control" name="nombre" />
                                <label class="form-label" for="form6Example1">Nombre</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example2" class="form-control" name="marca" />
                                <label class="form-label" for="form6Example2">Marca</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example4" class="form-control" name="link_imagen" />
                                <label class="form-label" for="form6Example4">Link imagen</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="number" id="form6Example5" class="form-control" name="stock_inicial" />
                                <label class="form-label" for="form6Example5">Stock inicial</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="number" id="form6Example6" class="form-control" name="stock_critico" />
                                <label class="form-label" for="form6Example6">Stock crítico</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example7" class="form-control" name="unidad_medida" />
                                <label class="form-label" for="form6Example7">Unidad de medida</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form6Example8" class="form-control" name="descripcion_unidad" />
                                <label class="form-label" for="form6Example8">Descripción unidad</label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Crear producto</button>
                </form>


            </div>



        </div>
    </main>
@endsection
