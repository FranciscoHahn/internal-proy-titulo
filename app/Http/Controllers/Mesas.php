<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Utilidades;
use Session;

class Mesas extends Controller
{

    public function mesas(){
        Session::put('link_activo', 'mesas');
        $response_mesas = Utilidades::consumir_api('Compra/get_mesas', array('token' => Session::get('token_api')));
        $mesas = $response_mesas->data->mesas;
        return view('mesero.mesas', compact('mesas'));
    }
}
