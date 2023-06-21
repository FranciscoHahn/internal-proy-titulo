<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Inventario extends Controller
{
    public function admincompras()
    {
        Session::put('linkactivo', 'compras');
        $response_compras = Utilidades::consumir_api('Inventario/inv_getallcompras', array('token' => Session::get('token_api')));
        foreach ($response_compras->data->registrosCompra as $registro_compra) {
            $response_detalle = Utilidades::consumir_api('Inventario/inv_getdetallecompra', array('token' => Session::get('token_api'), 'registro_compra_id' => $registro_compra->id));
            $registro_compra->detalle = $response_detalle->data->data;
        }

        $compras = $response_compras->data->registrosCompra;
        return view('administrador.administrador-compras', compact('compras'));
    }

    public function agregarcompra()
    {
        Session::put('linkactivo', 'compras');
        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;

        return view('administrador.administrador-agregar-compra', compact('productos'));
    }

    public function agregandocompra(Request $request)
    {
        Session::put('linkactivo', 'compras');

        $data_compra = array(
            'token' => Session::get('token_api'),
            'proveedor' => $request->post('proveedor'),
            'nro_doc_compra' => $request->post('nro_doc_compra'),
            'fecha_compra' => $request->post('fecha_compra')
        );

        $response_crear_compra = Utilidades::consumir_api('Inventario/inv_crearcompra', $data_compra);
        $data_compra_id = $response_crear_compra->data->registro_compra_id;


        $data_detalle_compra = json_decode($request->post('productos_cantidad_precio'));

        foreach ($data_detalle_compra as $key => $value) {
            //
            if ($value->cantidad && $value->precioUnitario) {
                $detalle_compra = array(
                    'token' => Session::get('token_api'),
                    'registro_compra_id' =>  $data_compra_id,
                    'producto_id' => $key,
                    'cantidad' => $value->cantidad,
                    'precio_unitario' => $value->precioUnitario

                );
                Utilidades::consumir_api('Inventario/inv_addcompradetail', $detalle_compra);
            }
        }


        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        $mensaje = 'Registro de compra finalizado';
        $errores = [];
        return view('administrador.administrador-agregar-compra', compact('productos', 'mensaje', 'errores'));
    }


    public function eliminardetallecompra(Request $request, $id)
    {
        Session::put('linkactivo', 'compras');
        $data_delete = array(
            'token' => Session::get('token_api'),
            'detalle_compra_id' => $id
        );
        $response_borrar = Utilidades::consumir_api('Inventario/del_compradetail', $data_delete);
        $errores = [];
        $mensaje = $response_borrar->message;

        Session::put('linkactivo', 'compras');
        $response_compras = Utilidades::consumir_api('Inventario/inv_getallcompras', array('token' => Session::get('token_api')));
        foreach ($response_compras->data->registrosCompra as $registro_compra) {
            $response_detalle = Utilidades::consumir_api('Inventario/inv_getdetallecompra', array('token' => Session::get('token_api'), 'registro_compra_id' => $registro_compra->id));
            $registro_compra->detalle = $response_detalle->data->data;
        }

        $compras = $response_compras->data->registrosCompra;
        return view('administrador.administrador-compras', compact('compras', 'errores', 'mensaje'));
    }

    public function salidasinventario()
    {
        Session::put('linkactivo', 'salidas');
        $data_send = array(
            'token' => Session::get('token_api')
        );
        $response = Utilidades::consumir_api('Inventario/inv_getsalidas', $data_send);
        $salidas = $response->data->salidas;
        return view('administrador.administrador-salidas', compact('salidas'));
    }

    public function registrarsalidainventario()
    {
        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        return view('administrador.administrador-agregar-salida', compact('productos'));
    }

    public function creandosalidasdeinventario(Request $request)
    {
        $data_detalle_compra = json_decode($request->post('productos_cantidad_precio'));

        foreach ($data_detalle_compra as $key => $value) {
            //
            if ($value->cantidad && $value->cantidad > 0) {
                $detalle_compra = array(
                    'token' => Session::get('token_api'),
                    'producto_id' => $key,
                    'cantidad' => $value->cantidad
                );
                ///Inventario/inv_createsalida
                Utilidades::consumir_api('Inventario/inv_createsalida', $detalle_compra);
            }
        }
        $mensaje = "Salidas de inventario registradas";
        $errores = [];

        Session::put('linkactivo', 'salidas');
        $data_send = array(
            'token' => Session::get('token_api')
        );
        $response = Utilidades::consumir_api('Inventario/inv_getsalidas', $data_send);
        $salidas = $response->data->salidas;
        return view('administrador.administrador-salidas', compact('salidas', 'mensaje', 'errores'));
    }

    public function eliminarsalidainventario(Request $request, $id)
    {
        //Inventario/inv_deletesalida
        Utilidades::consumir_api('Inventario/inv_deletesalida', array('token' => Session::get('token_api'), 'id_salida' => $id));
        Session::put('linkactivo', 'salidas');
        $data_send = array(
            'token' => Session::get('token_api')
        );
        $response = Utilidades::consumir_api('Inventario/inv_getsalidas', $data_send);
        $salidas = $response->data->salidas;
        $mensaje = "Registro eliminado";
        return view('administrador.administrador-salidas', compact('salidas', 'mensaje'));

    }
}
