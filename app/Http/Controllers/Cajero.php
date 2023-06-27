<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Cajero extends Controller
{


    public function pedidospagar()
    {
        Session::put('linkactivo', 'atencionescajero');
        $response_atenciones = Utilidades::consumir_api('Compra/todas_atenciones_con_info', array('token' => Session::get('token_api')));
        $atenciones = $response_atenciones->data->atenciones;
        $atenciones_send = array();
        foreach ($atenciones as $atencion) {
            $total = 0;
            foreach ($atencion->pedidos as $pedido) {
                if ($pedido->estado == 'entregado') {
                    $total = $total + $pedido->precio_pedido * $pedido->cantidad;
                }
            }
            $atencion->preciototal = $total;
            if ($atencion->estado == 'pago solicitado') {
                $atenciones_send[] = $atencion;
            }
        }



        return view('cajero.atenciones', compact('atenciones_send'));
    }

    public function print_voucher(Request $request, $id)
    {
        $response = Utilidades::consumir_api('Compra/get_datos_atencion', array('token' => Session::get('token_api'), 'id_atencion' => $id));
        $atencion_actual = $response->data->atencion_actual;
        $pedidos = $response->data->pedidos;

        $pedidos_entregados = array_filter($pedidos, function ($pedido) {
            return $pedido->estado == 'entregado';
        });

        $total = 0;
        foreach ($pedidos_entregados as $pedido) {
            $total += $pedido->precio_pedido * $pedido->cantidad;
        }

        // Calcular la propina sugerida (por ejemplo, el 10% del total)
        $propina_sugerida = $total * 0.1;

        return view('cajero.printvoucher', compact('atencion_actual', 'pedidos_entregados', 'total', 'propina_sugerida'));
    }

    public function registrar_pago(Request $request)
    {
        $response = Utilidades::consumir_api('Compra/get_datos_atencion', array('token' => Session::get('token_api'), 'id_atencion' => $request->post('id_atencion')));
        $atencion_actual = $response->data->atencion_actual;
        $pedidos = $response->data->pedidos;

        $pedidos_entregados = array_filter($pedidos, function ($pedido) {
            return $pedido->estado == 'entregado';
        });

        $total = 0;
        foreach ($pedidos_entregados as $pedido) {
            $total += $pedido->precio_pedido * $pedido->cantidad;
        }

        $data_send_pago = array(
            'token' => Session::get('token_api'),
            'atencion_id' => $request->id_atencion,
            'total_cuenta' => $request->precio_cuenta,
            'total_cancelado' => $request->total_pagado,
            'forma_pago' => $request->forma_pago

        );

        Utilidades::consumir_api('Compra/pagar_atencion', $data_send_pago);
        return redirect()->route('pedidospagar');
    }

    public function ventas()
    {
        Session::put('linkactivo', 'ventas');
        //Compra/ventas_todas
        $response = Utilidades::consumir_api('Compra/ventas_todas', array());
        $ventas = $response->data->ventas;

        return view('cajero.ventas', compact('ventas'));
    }
}
