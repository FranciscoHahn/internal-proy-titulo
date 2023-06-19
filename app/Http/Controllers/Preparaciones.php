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

 


}
