@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Pedidos mesa {{$atencion->numero}}</h3>
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
                                    <a href="{{route('agregarpedidos', ['id' => $atencion->id])}}" class="btn btn-primary btn-rounded"><i
                                            class="fas fa-table-cells"></i>&nbsp;Agregar
                                        pedido</a>
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

            </div>
        </div>
    </main>
@endsection
