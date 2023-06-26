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
        $atencion_cerrable = true;
        foreach ($pedidos as $pedido) {
            if ($pedido->estado == 'en preparación') {
                $pedido->card_class = 'success';
                $atencion_cerrable = false;
            } else if ($pedido->estado == 'disponible para entrega') {
                $pedido->card_class = 'warning';
                $atencion_cerrable = false;
            } else if ($pedido->estado == 'entregado') {
                $pedido->card_class = 'info opacity-75';
            } else {
                $pedido->card_class = 'secondary opacity-50';
            }
        }

        //dd($pedidos);

        usort($pedidos, function ($a, $b) {
            $order = [
                'disponible para entrega' => 1,
                'en preparación' => 2,
                'entregado' => 3,
                'cancelado' => 4
            ]; // Define el orden de los estados

            $aIndex = isset($order[$a->estado]) ? $order[$a->estado] : PHP_INT_MAX;
            $bIndex = isset($order[$b->estado]) ? $order[$b->estado] : PHP_INT_MAX;

            return $aIndex - $bIndex; // Compara los índices para determinar el orden relativo
        });


        foreach ($menu as $item) {
            $categoria = $item->categoria;
            if (!property_exists($categorias, $categoria)) {
                $categorias->$categoria = [];
            }
            //'pendiente', 'en preparación', 'entregado', 'cancelado', 'disponible para entrega'
            $categorias->$categoria[] = $item;
        }

        //dd($categorias);
        //dd($menu);
        //dd($menu);
        return view('mesero.atencion', compact('atencion', 'pedidos', 'categorias', 'idmesa', 'atencion_cerrable'));
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

    public function pedidoentregadomesa(Request $request)
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
                'estado' => 'entregado'
            )
        );

        return json_encode(array("respuesta_exitosa" => true));
    }

    public function cancelarpedidomesero(Request $request)
    {
        //btnmeserocancelarpedido
        Utilidades::consumir_api(
            'Compra/modificar_estado_pedido',
            array(
                'token' => Session::get('token_api'),
                'pedido_id' => $request->post('id'),
                'estado' => 'cancelado'
            )
        );
        return json_encode(array("respuesta_exitosa" => true));
    }

    public function solicitarpagomesero(Request $request, $idatencion, $idmesa)
    {
        //actualizar_estado_atencion
        Utilidades::consumir_api(
            'Compra/actualizar_estado_atencion',
            array(
                'token' => Session::get('token_api'),
                'atencion_id' => $idatencion,
                'estado' => 'pago solicitado'
            )
        );

        //dd($idatencion. "   ".$idmesa);

        return redirect()->route('veratencion', ['idmesa' => $idmesa]);
    }

    public function finalizaratencion(Request $request, $id)
    {
        /**
         *     public function finalizar_atencion() {

        //finalizar_atencion
        $response = $this->CompraModel->finalizar_atencion($this->input->post('token'), $this->input->post('atencion_id'));
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    
         * * */
        Utilidades::consumir_api('Compra/finalizar_atencion', array('token' => Session::get('token_api'), 'atencion_id' => $id));
        return redirect()->route('iniciomesas');
    }
}
