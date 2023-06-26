@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Atenciones</h3>
            </div>

            @if (!$atenciones)
                <div class="col-12 mt-2">
                    <div class="">
                        <div class="card-body">
                            Sin atenciones pendientes
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach ($atenciones as $atencion)
                        @if ($atencion->estado != 'pagado')
                            <div class="col-md-4 col-sm-6 mt-2" id="">
                                <div class="card border border-primary">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <strong> Atención #{{ $atencion->id }} &nbsp;&nbsp;Mesa
                                                #{{ $atencion->numero }}</strong>
                                            <div class="btn-group-vertical">
                                                @if ($atencion->estado == 'pago solicitado')
                                                    <a href="#"
                                                        onclick="openPrintWindow('{{ route('print_voucher', ['id' => $atencion->id]) }}')"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-print"></i>&nbsp;Imprimir Voucher
                                                    </a>
                                                    <a class="btn btn-outline-primary btn-sm" data-mdb-toggle="collapse"
                                                        href="#paymentForm{{ $atencion->id }}" role="button"
                                                        aria-expanded="false"
                                                        aria-controls="paymentForm{{ $atencion->id }}">
                                                        <i class="fas fa-coins"></i>&nbsp;Registrar Pago
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="card-text">
                                            @if ($atencion->estado == 'pago solicitado')
                                                <span class="badge badge-primary">{{ $atencion->estado }}</span><br />
                                            @else
                                                <span class="badge badge-secondary">{{ $atencion->estado }}</span><br />
                                            @endif
                                            <strong style="word-wrap: nowrap;">
                                                $ {{ intval($atencion->preciototal) }}
                                            </strong>
                                        </p>
                                        <div class="collapse mt-3" id="paymentForm{{ $atencion->id }}">
                                            <form method="POST" action="{{ route('registrar_pago') }}">
                                                <div class="form-outline mb-4">
                                                    <input type="number" id="total_pagado{{ $atencion->id }}"
                                                        class="form-control" name="total_pagado"
                                                        value="{{ intval($atencion->preciototal) }}" />
                                                    <label class="form-label" for="total_pagado{{ $atencion->id }}">Total
                                                        pagado</label>
                                                </div>
                                                <input type="hidden" name="id_atencion" value="{{ $atencion->id }}">
                                                <input type="hidden" name="precio_cuenta"
                                                    value="{{ intval($atencion->preciototal) }}">
                                                <div class="form-outline">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="forma_pago"
                                                            id="debito" value="debito" />
                                                        <label class="form-check-label" for="debito">Débito</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="forma_pago"
                                                            id="credito" value="credito" />
                                                        <label class="form-check-label" for="credito">Crédito</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="forma_pago"
                                                            id="efectivo" value="efectivo" />
                                                        <label class="form-check-label" for="efectivo">Efectivo</label>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-block btn-sm btn-outline-primary">
                                                    Registrar pago</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </main>
    <script>
        function openPrintWindow(url) {
            var voucherWindow = window.open(url, '_blank', 'width=800,height=900');
            voucherWindow.focus();
        }
    </script>

@endsection
