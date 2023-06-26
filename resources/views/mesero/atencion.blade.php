@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                @if($atencion->estado != 'pagado')
                <h3 class="me-3">Pedidos mesa {{ $atencion->numero }}</h3>
                @else
                <h3 class="me-3 text-muted">Pedidos mesa {{ $atencion->numero }}  | Pagada</h3>
                @endif
                <div>
                    <a href="{{ route('iniciomesas') }}"class="btn btn-primary btn-rounded"><i
                            class="fas fa-table-cells"></i>&nbsp;Volver a mesas</a>
                    @if ($atencion_cerrable && $pedidos && $atencion->estado != 'pago solicitado' && $atencion->estado != 'pagado')
                        <a
                            href="{{ route('solicitarpagomesero', ['idatencion' => $atencion->id, 'idmesa' => $idmesa]) }}"class="btn btn-primary btn-rounded"><i
                                class="fas fa-coins"></i>&nbsp;Solicitar Boleta</a>
                    @endif

                    @if ($atencion->estado == 'pagado')
                        <a href="{{route('finalizaratencion', ['id' => $atencion->id])}}" class="btn btn-primary btn-rounded"><i class="fas fa-times"></i>&nbsp;Finalizar
                            atención</a>
                    @endif
                </div>

            </div>
            @if (isset($mensaje))
                <div class="rounded bg-success text-white mt-2 px-2">
                    {{ $mensaje }}
                </div>
            @endif

            <div class="row">
                <form action="{{ route('agregarpedidosatencion') }}" method="POST"
                    onkeydown="return (event.keyCode !== 13);">
                    <input type="hidden" name="idatencion" value="{{ $atencion->id }}">
                    <input type="hidden" name="idmesa" value="{{ $idmesa }}">
                    @if (!$pedidos)
                        <div class="col-12 mt-2">
                            <div class="">
                                <div class="card-body">
                                    La atención actual no tiene pedidos
                                    @if (Session::get('profile') == 'Mesero')
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12 mt-2">
                            <div class="">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="row" id="pedidostodos">
                            @foreach ($pedidos as $pedido)
                                <div class="col-4 mt-2" id="divisionpedido-{{ $pedido->id_pedido }}">
                                    <div class="card border border-{{ $pedido->card_class }}"
                                        id="pedidocardmesero-{{ $pedido->id_pedido }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <strong> Pedido # {{ $pedido->id_pedido }} </strong>
                                                @if ($pedido->estado == 'disponible para entrega')
                                                    <a class="btn btn-sm btn-outline-{{ $pedido->card_class }} btnmeseroentregar"
                                                        data-id="{{ $pedido->id_pedido }}">Entregar en mesa</a>
                                                @endif
                                                @if ($pedido->estado == 'en preparación')
                                                    <a class="btn btn-sm btn-outline-{{ $pedido->card_class }} btnmeserocancelarpedido"
                                                        data-id="{{ $pedido->id_pedido }}">Cancelar</a>
                                                @endif

                                            </div>
                                            <p class="card-text">
                                            <div>
                                                <small
                                                    class="text-muted">{{ $pedido->nombre }}&nbsp;({{ $pedido->cantidad }})
                                                    ($ {{ $pedido->precio_pedido * $pedido->cantidad }})
                                                </small><br />
                                                <span id="badgeestadoatencion-{{ $pedido->id_pedido }}"
                                                    class="badge badge-{{ $pedido->card_class }}">{{ $pedido->estado }}</span><br />
                                                <small class="text-muted"><i
                                                        class="far fa-clock"></i>&nbsp;{{ date('H:i (d-m-Y)', strtotime($pedido->fecha_hora_pedido)) }}</small>
                                            </div>

                                            </p>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if (!in_array($atencion->estado, ['pago solicitado', 'pagado']) )
                        <div class="mt-1">
                            <div class="">
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

                                                <div class="row mx-2 mt-2">
                                                    @foreach ($items as $item)
                                                        <div class="card col-md-12 col-lg-5 mx-2 mt-2">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ $item->nombre }}</h5>
                                                                <p class="card-text">{{ $item->descripcion }}</p>
                                                                <p class="card-text">Precio: ${{ $item->precio }}</p>
                                                                <div class="form-group">
                                                                    <div class="form-outline mb-4">
                                                                        <input type="number" class="form-control"
                                                                            name="cantidad[{{ $item->id }}]" />
                                                                        <label class="form-label">Cantidad</label>
                                                                    </div>
                                                                    <div class="form-outline mb-4">
                                                                        <input type="text" class="form-control"
                                                                            name="indicaciones[{{ $item->id }}]" />
                                                                        <label class="form-label">Indicaciones</label>
                                                                    </div>


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
                    @endif
            </div>
            @if (!in_array($atencion->estado, ['pago solicitado', 'pagado']))
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-block btn-primary">Agregar pedidos indicados</button>
                </div>
            @endif
            </form>
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
