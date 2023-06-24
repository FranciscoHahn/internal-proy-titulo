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

    public function pedidoscocina()
    {
        Session::put('linkactivo', 'pedidos');
        $response_pedidos = Utilidades::consumir_api('Compra/listar_pedidos_con_informacion', array('token' => Session::get('token_api')));
        $pedidos = $response_pedidos->data->pedidos;
        return view('cocina.pedidos', compact('pedidos'));
    }

    public function pedidodisponiblecocina(Request $request)
    {

        //Compra/modificar_estado_pedido
        /****
        $pedido_id = $this->input->post('pedido_id');
        $estado = $this->input->post('estado');
        
         */
        Utilidades::consumir_api(
            'Compra/modificar_estado_pedido',
            array(
                'token' => Session::get('token_api'),
                'pedido_id' => $request->post('id'),
                'estado' => 'disponible para entrega'
            )
        );

        return json_encode(array("respuesta_exitosa" => true));
    }

    

}
