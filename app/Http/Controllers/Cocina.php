<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Cocina extends Controller
{

    public function cocinainicio()
    {
        Session::put('linkactivo', 'inicio');
        return view('cocina.inicio');
    }

    public function pedidoscocina(){
        Session::put('linkactivo', 'pedidos');
        return view('cocina.pedidos');
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
        return view('mesero.atencion', compact('atencion', 'pedidos', 'categorias', 'idmesa'));
    }

    public function agregarpedidosatencion(Request $request)
    {
        foreach ($request->post('cantidad') as $key => $value) {
            $data_send = array(
                'token' => Session::get('token_api'),
                'atencion_id' => $request->post('idatencion'),
                'preparacion_id' => $key,
                'descripcion' => $request->post('indicaciones')[$key],
                'cantidad' => $value
            );
            if ($data_send['cantidad'] > 0) {
                Utilidades::consumir_api('Compra/crear_pedido', $data_send);
            }
        }

        return redirect()->route('veratencion', ['idmesa' => $request->post('idmesa')]);
    }
}
