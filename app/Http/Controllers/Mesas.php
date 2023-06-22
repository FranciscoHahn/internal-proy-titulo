<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Mesas extends Controller
{

    public function mesas()
    {
        Session::put('linkactivo', 'mesas');
        $response_mesas = Utilidades::consumir_api('Compra/get_mesas', array('token' => Session::get('token_api')));
        $mesas = $response_mesas->data->mesas;
        return view('mesero.mesas', compact('mesas'));
    }

    public function iniciaratencion(Request $request, $idmesa)
    {
        Session::put('linkactivo', 'mesas');
        $data = array(
            'token' => Session::get('token_api'),
            'mesa_id' => $idmesa,
            'mesero_id' => 0
        );
        $response_crear_atencion = Utilidades::consumir_api('Compra/crear_atencion_mesa_mesero', $data);
        $response_mesas = Utilidades::consumir_api('Compra/get_mesas', array('token' => Session::get('token_api')));
        $mesas = $response_mesas->data->mesas;
        return view('mesero.mesas', compact('mesas'));
    }

    public function veratencion(Request $request, $idmesa)
    {
        //get_ultima_atencion_mesa
        $data_send = array(
            'token' => Session::get('token_api'),
            'id_mesa' => $idmesa
        );
        //dd($data_send);
        $response_ultima_atencion = Utilidades::consumir_api('Compra/ultimo_pedido_mesa', $data_send);
        $atencion = $response_ultima_atencion->data->atencion_actual;
        $pedidos = $response_ultima_atencion->data->pedidos;
        $response_menu = Utilidades::consumir_api('obtener-menu', array('token' => Session::get('token_api')));
        $menu = $response_menu->data;
        $categorias = new \stdClass();

        foreach ($menu as $item) {
            $categoria = $item->categoria;

            if (!property_exists($categorias, $categoria)) {
                $categorias->$categoria = [];
            }

            $categorias->$categoria[] = $item;
        }

        //dd($categorias);
        //dd($menu);
        //dd($menu);
        return view('mesero.atencion', compact('atencion', 'pedidos', 'categorias'));
    }
}
