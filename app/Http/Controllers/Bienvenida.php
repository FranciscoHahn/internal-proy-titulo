<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Bienvenida extends Controller
{
    public function inicio()
    {
        return view('login-interno.login');
    }

    public function login(Request $request)
    {
        $arrrequest = array(
            'email' => $request->post('email'),
            'password' => $request->post('password')
        );
        $response = Utilidades::consumir_api('autorizar', $arrrequest);
        $mensaje = $response->message;
        if($response->http_status_code <> 200){
            return view('login-interno.login', compact('mensaje'));
        } else {
            echo json_encode($response);
        }
    }

    public function is_admin(){

    }

    public function is_bodeguero(){

    }

    public function is_cocina(){

    }

    public function is_mesero(){

    }

    
}

