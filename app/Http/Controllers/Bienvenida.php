<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Bienvenida extends Controller
{
    public function inicio($mensaje = null)
    {
        if (Session::get('token_api') !== null) {
            if (Session::get('profile') == 'Administrador') {
                return redirect('inicio-admin');
            }

            if (Session::get('profile') == 'Cocina') {
                return redirect('inicio-cocina');
            }
            if (Session::get('profile') == 'Mesero') {
                return redirect('inicio-mesero');
            }
            if (Session::get('profile') == 'Bodega') {
                return redirect('inicio-bodega');
            }
        }
        return view('login-interno.login', compact('mensaje'));
    }

    public function login(Request $request)
    {
        if (Session::get('token_api') !== null) {
            if (Session::get('profile') == 'Administrador') {
                return redirect('inicio-admin');
            }

            if (Session::get('profile') == 'Cocina') {
                return redirect('inicio-cocina');
            }
            if (Session::get('profile') == 'Mesero') {
                return redirect('inicio-mesero');
            }
            if (Session::get('profile') == 'Bodega') {
                return redirect('inicio-bodega');
            }
        }


        Session::forget('token_api');
        Session::forget('nombres');
        Session::forget('apellidos');
        Session::forget('idusuario');
        Session::forget('fullName');
        Session::forget('profile');


        $arrrequest = array(
            'email' => $request->post('email'),
            'password' => $request->post('password')
        );
        $response = Utilidades::consumir_api('autorizar', $arrrequest);
        $mensaje = $response->message;
        if ($response->http_status_code <> 200) {
            return $this->inicio($mensaje);
        } else {
            Session::put('token_api', $response->data->token);
            Session::put('nombres', $response->data->nombres);
            Session::put('apellidos', $response->data->apellidos);
            Session::put('id_usuario', $response->data->id_usuario);
            Session::put('fullName', $response->data->fullName);
            Session::put('profile', $response->data->profile);

            if ($response->data->profile == 'Administrador') {
                return redirect('inicio-admin');
            }

            if ($response->data->profile == 'Cocina') {
                return redirect('inicio-cocina');
            }
            if ($response->data->profile == 'Mesero') {
                return redirect('inicio-mesero');
            }
            if ($response->data->profile == 'Bodega') {
                return redirect('inicio-bodega');
            }
        }
    }

    public function logout()
    {
        Session::forget('token_api');
        Session::forget('nombres');
        Session::forget('apellidos');
        Session::forget('idusuario');
        Session::forget('fullName');
        Session::forget('profile');
        return $this->inicio('sesión finalizada');
    }

    public function is_admin()
    {
        return view('administrador.administrador-inicio');
    }

    public function adminusuarios()
    {
        $response = Utilidades::consumir_api('listar-usuarios', array('token' => Session::get('token_api')));
        if ($response->http_status_code <> 200) {
        }
        $usuarios = $response->data;
        return view('administrador.administrador-usuarios', compact('usuarios'));
    }

    public function crearusuario()
    {
        $response = Utilidades::consumir_api('listado-perfiles', array('token' => Session::get('token_api')));
        $perfiles = $response->data->perfiles;
        return view('administrador.administrador-crear-usuario', compact('perfiles'));
    }

    public function registrousuario(Request $request)
    {
        $response_perfiles = Utilidades::consumir_api('listado-perfiles', array('token' => Session::get('token_api')));
        $perfiles = $response_perfiles->data->perfiles;
        $data_to_send = $request->post();
        $data_to_send['token'] = Session::get('token_api');
        $response_registro = Utilidades::consumir_api('agregar-usuario', $data_to_send);
        $mensaje = null;
        $errores = null;
        //dd($response_registro);
        if ($response_registro->http_status_code <> 200) {
            $mensaje = $response_registro->message;
            foreach ($response_registro->data->errores as $error) {
                if ($error->error) {
                    $errores[] = $error->msg;
                }
            }
        } else {
            $mensaje = "Registro Finalizado";
        }

        return view('administrador.administrador-crear-usuario', compact('perfiles', 'mensaje', 'errores'));
    }


    public function activarusuario(Request $request, $id)
    {
        //dd($id);

        Utilidades::consumir_api('restaurar-usuario', array('token' => Session::get('token_api'), 'id' => $id));
        $mensaje = "Registro activado";
        $response = Utilidades::consumir_api('listar-usuarios', array('token' => Session::get('token_api')));
        $usuarios = $response->data;
        return view('administrador.administrador-usuarios', compact('usuarios', 'mensaje'));
    }

    public function desactivarusuario(Request $request, $id)
    {
        //dd($id);

        Utilidades::consumir_api('eliminar-usuario', array('token' => Session::get('token_api'), 'id' => $id));
        $mensaje = "Registro desactivado";
        $response = Utilidades::consumir_api('listar-usuarios', array('token' => Session::get('token_api')));
        $usuarios = $response->data;
        return view('administrador.administrador-usuarios', compact('usuarios', 'mensaje'));
    }

    public function editarusuario(Request $request, $id)
    {
        $response = Utilidades::consumir_api('datos-usuario', array('token' => Session::get('token_api'), 'id_usuario' => $id));
        $datausuario = $response->data[0];
        $response_perfiles = Utilidades::consumir_api('listado-perfiles', array('token' => Session::get('token_api')));
        $perfiles = $response_perfiles->data->perfiles;
        return view('administrador.administrador-editar-usuario', compact('datausuario', 'perfiles'));
        //dd($datausuario);
    }

    public function edicionusuario(Request $request)
    {
        $response_perfiles = Utilidades::consumir_api('listado-perfiles', array('token' => Session::get('token_api')));
        $perfiles = $response_perfiles->data->perfiles;
        $data_to_send = $request->post();
        $data_to_send['token'] = Session::get('token_api');
        $response_registro = Utilidades::consumir_api('modificar-usuario', $data_to_send);
        $mensaje = null;
        $errores = null;
        //dd($response_registro);
        if ($response_registro->http_status_code <> 200) {
            $mensaje = $response_registro->message;
            foreach ($response_registro->data->errores as $error) {
                if ($error->error) {
                    $errores[] = $error->msg;
                }
            }
        } else {
            $mensaje = "Modificación Finalizada";
        }
        $response_usuario_mod = Utilidades::consumir_api('datos-usuario', array('token' => Session::get('token_api'), 'id_usuario' => $request->post('id')));
        $datausuario = $response_usuario_mod->data[0];
        return view('administrador.administrador-editar-usuario', compact('perfiles', 'mensaje', 'errores', 'datausuario'));
    }

    public function productos()
    {
        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        return view('administrador.administrador-productos', compact('productos'));
    }

    public function agregarproducto()
    {
        $response_categoria = Utilidades::consumir_api('listar-categorias', array('token' => Session::get('token_api')));
        $categorias = $response_categoria->data;
        return view('administrador.administrador-agregar-producto', compact('categorias'));
    }

    public function registroproducto(Request $request)
    {
        //dd($request->post());
        $response_categoria = Utilidades::consumir_api('listar-categorias', array('token' => Session::get('token_api')));
        $categorias = $response_categoria->data;
        $data_to_send = $request->post();
        $data_to_send['token'] = Session::get('token_api');
        $response_registro = Utilidades::consumir_api('insertar-producto', $data_to_send);
        $mensaje = null;
        $errores = [];
        //dd($response_registro);
        if ($response_registro->http_status_code <> 200) {
            $mensaje = $response_registro->message;
            $errores = [];
        } else {
            $mensaje = "Registro Finalizado";
        }
        return view('administrador.administrador-agregar-producto', compact('categorias', 'mensaje', 'errores'));
    }

    public function editarproducto(Request $request, $id)
    {
        $response_categoria = Utilidades::consumir_api('listar-categorias', array('token' => Session::get('token_api')));
        $categorias = $response_categoria->data;

        $response_producto = Utilidades::consumir_api('obtener-producto-por-id', array('token' => Session::get('token_api'), 'id' => $id));
        $producto = $response_producto->data->producto[0];
        //obtener-producto-por-id
        return view('administrador.administrador-editar-producto', compact('producto', 'categorias'));
    }

    public function edicionproducto(Request $request)
    {
        //actualizar-producto
        //dd($request->post());
        $mensaje = null;
        $errores = [];
        $data_to_send = $request->post();
        $data_to_send['token'] = Session::get('token_api');
        //dd($data_to_send);
        $response_actualizar_producto = Utilidades::consumir_api('actualizar-producto', $data_to_send);
        if ($response_actualizar_producto->http_status_code <> 200) {
            $mensaje = $response_actualizar_producto->message;
            $errores = [];
        } else {
            $mensaje = "Edición Finalizada";
        }
        $response_categoria = Utilidades::consumir_api('listar-categorias', array('token' => Session::get('token_api')));
        $categorias = $response_categoria->data;

        $response_producto = Utilidades::consumir_api('obtener-producto-por-id', array('token' => Session::get('token_api'), 'id' => $request->post('id')));
        $producto = $response_producto->data->producto[0];
        //obtener-producto-por-id
        return view('administrador.administrador-editar-producto', compact('producto', 'categorias', 'mensaje', 'errores'));
    }

    public function activarproducto(Request $request, $id)
    {
        $mensaje = null;
        if ($id) {
            Utilidades::consumir_api('activar-producto', array('token' => Session::get('token_api'), 'id' => $id));
            $mensaje = "Registro activado";
        }
        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        return view('administrador.administrador-productos', compact('productos', 'mensaje'));
    }

    public function desactivarproducto(Request $request, $id)
    {
        $mensaje = null;
        if ($id) {
            Utilidades::consumir_api('desactivar-producto', array('token' => Session::get('token_api'), 'id' => $id));
            $mensaje = "Registro desactivado";
        }

        $response_productos = Utilidades::consumir_api('obtener-productos', array('token' => Session::get('token_api')));
        $productos = $response_productos->data->productos;
        return view('administrador.administrador-productos', compact('productos', 'mensaje'));
    }

    public function is_bodeguero()
    {
        echo 'es bodega';
        dd(Session::all());
    }

    public function is_cocina()
    {
        echo 'es cocina';
        dd(Session::all());
    }

    public function is_mesero()
    {
        echo 'es mesero';
        dd(Session::all());
    }
}
