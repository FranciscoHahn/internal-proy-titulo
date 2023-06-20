<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Preparaciones extends Controller
{

    public function adminpreparaciones()
    {
        Session::put('linkactivo', 'preparaciones');
        $response = Utilidades::consumir_api('obtener-preparaciones', array('token' => Session::get('token_api')));
        $preparaciones = $response->data->preparaciones;

        return view('administrador.administrador-preparaciones', compact('preparaciones'));
    }

    public function agregarpreparacion()
    {
        Session::put('linkactivo', 'preparaciones');
        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        //dd($productos);
        return view('administrador.administrador-agregar-preparacion', compact('productos'));
    }

    public function agregandopreparacion(Request $request)
    {
        Session::put('linkactivo', 'preparaciones');
        //dd($request->post());
        $mensaje = null;
        $errores = [];
        $data_preparacion = array(
            'token' => Session::get('token_api'),
            'nombre' => $request->post('nombre'),
            'precio' => $request->post('precio'),
            'descripcion' => $request->post('descripcion'),
            'categoria' => $request->post('categoria'),
            'link_image_auxiliar' => $request->post('link_image_auxiliar')
        );
        $response_preparacion = Utilidades::consumir_api('insertar-preparacion', $data_preparacion);
        $productos_prep_str = $request->post('productos_componentes');
        $productos_prep = explode(',', $request->post('productos_componentes'));
        //$mensaje = "undertest";
        if ($response_preparacion->http_status_code <> 200) {
            $mensaje = $response_preparacion->message;
        } else {
            //set-producto-preparacion
            $insert_id_prep = $response_preparacion->data->insertId;

            foreach (explode(',', $request->post('productos_componentes')) as $id_producto) {
                $data_producto_prep = array(
                    'token' => Session::get('token_api'),
                    'id_producto' => $id_producto,
                    'id_preparacion' => $insert_id_prep
                );
                Utilidades::consumir_api('set-producto-preparacion', $data_producto_prep);
            }
            $mensaje = "Registro Finalizado";
        }
        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        return view('administrador.administrador-agregar-preparacion', compact('productos', 'mensaje', 'errores', 'data_preparacion', 'productos_prep', 'productos_prep_str'));
    }

    public function editarpreparacion(Request $request, $id)
    {
        Session::put('linkactivo', 'preparaciones');
        $mensaje = null;
        $errores = [];
        $response_preparacion = Utilidades::consumir_api('obtener-preparaciones', array('token' => Session::get('token_api'), 'id' => $id));
        $data_preparacion = get_object_vars($response_preparacion->data->preparaciones[0]);
        //obtener-productos-preparacion
        $response_prods_prep = Utilidades::consumir_api('obtener-productos-preparacion', array('token' => Session::get('token_api'), 'id_preparacion' => $id, 'activos' => 1));
        $productos_prep = [];
        $productos_prep_str = "";
        
        if ($response_prods_prep->data->productos) {
            $productos_prep = array_column($response_prods_prep->data->productos, 'id');
            $productos_prep_str = implode(',', $productos_prep);
        }


        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        return view('administrador.administrador-editar-preparacion', compact('productos', 'mensaje', 'errores', 'data_preparacion', 'productos_prep', 'productos_prep_str'));
    }


    public function editandopreparacion(Request $request)
    {
        Session::put('linkactivo', 'preparaciones');
        $mensaje = null;
        $errores = [];
        $response_prods_prep = Utilidades::consumir_api('obtener-productos-preparacion', array('token' => Session::get('token_api'), 'id_preparacion' => $request->post('id_preparacion')));
        $productos_prep = $response_prods_prep->data->productos;
        $productos_prep_new = [];
        $data_preparacion_edit = array(
            'token' => Session::get('token_api'),
            'nombre' => $request->post('nombre'),
            'precio' => $request->post('precio'),
            'descripcion' => $request->post('descripcion'),
            'categoria' => $request->post('categoria'),
            'link_image_auxiliar' => $request->post('link_image_auxiliar'),
            'id' => $request->post('id_preparacion')
        );

        $response_update_prep = Utilidades::consumir_api('actualizar-preparacion', $data_preparacion_edit);
        if ($response_update_prep->http_status_code <> 200) {
            $mensaje = $response_update_prep->message;
        } else {
            $mensaje = "Edición Finalizada";
            foreach ($productos_prep as $producto) {
                $id = $producto->id;
                $id_preparacion_prod = $producto->id_preparacion_prod;
                $productos_prep_new[] = compact('id', 'id_preparacion_prod');
            }

            $productos_componentes = [];
            if($request->post('productos_componentes')){
                $productos_componentes = explode(',', $request->post('productos_componentes'));
            }
            
            
            foreach ($productos_componentes as $producto_id) {
                //set-producto-preparacion
                $data_set_preparacion = array(
                    'token' => Session::get('token_api'),
                    'id_producto' => $producto_id,
                    'id_preparacion' => $request->post('id_preparacion')
                );
                $response_set_producto = Utilidades::consumir_api('set-producto-preparacion', $data_set_preparacion);
                $resultados[] = $response_set_producto->message;
            }

            foreach ($productos_prep_new as $producto_rel) {
                if (!in_array($producto_rel["id"], $productos_componentes)) {
                    //desactivar-producto-preparacion
                    $data_set_del = array(
                        'token' => Session::get('token_api'),
                        'id' => $producto_rel["id_preparacion_prod"],
                    );
                    $response_del_producto = Utilidades::consumir_api('desactivar-producto-preparacion', $data_set_del);
                    $resultados[] = $response_del_producto->message . $data_set_del["id"];
                }
            }
        }

        $id = $request->post('id_preparacion');
        $response_preparacion = Utilidades::consumir_api('obtener-preparaciones', array('token' => Session::get('token_api'), 'id' => $id));
        $data_preparacion = get_object_vars($response_preparacion->data->preparaciones[0]);
        //obtener-productos-preparacion
        $response_prods_prep = Utilidades::consumir_api('obtener-productos-preparacion', array('token' => Session::get('token_api'), 'id_preparacion' => $id, 'activos' => 1));
        $productos_prep = [];
        $productos_prep_str = "";
        if ($response_prods_prep->data->productos) {
            $productos_prep = array_column($response_prods_prep->data->productos, 'id');
            $productos_prep_str = implode(',', $productos_prep);
        }
        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        return view('administrador.administrador-editar-preparacion', compact('productos', 'mensaje', 'errores', 'data_preparacion', 'productos_prep', 'productos_prep_str'));
    }
}
