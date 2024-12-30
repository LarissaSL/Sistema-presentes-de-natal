<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        echo 'Retornei o Formulário para registro';
    }

    public function registerSubmit()
    {
        echo 'Retornei a Submissão do Registro';
    }
}
