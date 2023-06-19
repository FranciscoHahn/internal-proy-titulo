<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Clientes extends Controller
{

    public function adminclientes()
    {
        Session::put('linkactivo', 'clientes');
        $response = Utilidades::consumir_api('obtener-clientes', array('token' => Session::get('token_api')));
        $clientes = $response->data;
        
        return view('administrador.administrador-clientes', compact('clientes'));
    }

 
    public function activarcliente(Request $request, $id)
    {
        Session::put('linkactivo', 'clientes');
        Utilidades::consumir_api('activar-cliente', array('token' => Session::get('token_api'), 'id' => $id));
        $mensaje = "Registro activado";
        $response = Utilidades::consumir_api('obtener-clientes', array('token' => Session::get('token_api')));
        $clientes = $response->data;
        return view('administrador.administrador-clientes', compact('clientes', 'mensaje'));

    }

    public function desactivarcliente(Request $request, $id)
    {
        Session::put('linkactivo', 'clientes');
        Utilidades::consumir_api('desactivar-cliente', array('token' => Session::get('token_api'), 'id' => $id));
        $mensaje = "Registro desactivado";
        $response = Utilidades::consumir_api('obtener-clientes', array('token' => Session::get('token_api')));
        $clientes = $response->data;
        return view('administrador.administrador-clientes', compact('clientes', 'mensaje'));

    }

}
