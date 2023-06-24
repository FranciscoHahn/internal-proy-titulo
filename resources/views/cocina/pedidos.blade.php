@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Pedidos pendientes</h3>
            </div>
    
            @if (!$pedidos)
                <div class="col-12 mt-2">
                    <div class="">
                        <div class="card-body">
                            Sin pedidos pendientes
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach ($pedidos as $pedido)
                    @if($pedido->estado == 'en preparación')
                        <div class="col-md-4 col-sm-6 mt-2" id="cuerpocarta-{{$pedido->id}}">
                            <div class="card border border-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <strong> Pedido #{{ $pedido->id }} &nbsp;&nbsp;Mesa #{{$pedido->numero_mesa}}</strong>
                                        <a class="btn btn-sm btn-outline-primary entregarpedidococina" data-id ="{{$pedido->id}}"><i class="fas fa-bell"></i>&nbsp;Está listo!</a>
                                    </div>
                                    <p class="card-text">
                                        <div>
                                            <strong class="text-dark">{{ $pedido->nombre_preparacion }}&nbsp;({{ $pedido->cantidad }})</strong><br>
                                            <p class="text-muted"><i class="far fa-clock"></i>&nbsp;{{ date('H:i (d-m-Y)', strtotime($pedido->fecha_hora_pedido)) }}</p>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </main>
    
@endsection
