@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Pedidos mesa {{ $atencion->numero }}</h3>
                <a href="{{route('iniciomesas')}}"class="btn btn-primary btn-rounded"><i class="fas fa-table-cells"></i>&nbsp;Volver a mesas</a>
            </div>
            @if (isset($mensaje))
                <div class="rounded bg-success text-white mt-2 px-2">
                    {{ $mensaje }}
                </div>
            @endif
            <div class="row">
                @if (!$pedidos)
                    <div class="col-3 mt-2">
                        <div class="">
                            <div class="card-body">
                                La atención actual no tiene pedidos
                                @if (Session::get('profile') == 'Mesero')
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($pedidos as $pedido)
                        <div class="col-3 mt-2">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        head
                                    </div>
                                    <p class="card-text">
                                        body
                                    </p>


                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="mt-4">
                    <div class="mt-4">
                        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                            @foreach ($categorias as $categoria => $items)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link{{ $loop->first ? ' active' : '' }}"
                                        id="ex1-tab-{{ $loop->iteration }}" data-mdb-toggle="tab"
                                        href="#ex1-tabs-{{ $loop->iteration }}" role="tab"
                                        aria-controls="ex1-tabs-{{ $loop->iteration }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $categoria }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- Tabs navs -->

                        <!-- Tabs content -->
                        <div class="tab-content" id="ex1-content">
                            @foreach ($categorias as $categoria => $items)
                                <div class="tab-pane fade{{ $loop->first ? ' show active' : '' }}"
                                    id="ex1-tabs-{{ $loop->iteration }}" role="tabpanel"
                                    aria-labelledby="ex1-tab-{{ $loop->iteration }}">
                                    <div class="card-columns">
                                        <div class="row">
                                            @foreach ($items as $item)
                                                <div class="card col-2 mx-2 mt-2">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $item->nombre }}</h5>
                                                        <p class="card-text">{{ $item->descripcion }}</p>
                                                        <p class="card-text">Precio: ${{ $item->precio }}</p>
                                                        <div class="form-group">
                                                            <label for="cantidad-{{ $item->id }}">Cantidad:</label>
                                                            <input type="number" class="form-control cantidad-input"
                                                                id="cantidad-{{ $item->id }}"
                                                                name="cantidad[{{ $item->id }}]" value="0"
                                                                min="0">
                                                        </div>
                                                        <!-- Agrega aquí el código HTML adicional para mostrar la información de la carta -->
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>


            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener todos los campos de cantidad
                var cantidadInputs = document.querySelectorAll('.cantidad-input');

                // Establecer el valor de todos los campos de cantidad a 0
                cantidadInputs.forEach(function(input) {
                    input.value = 0;
                });
            });
        </script>
    </main>
@endsection
