<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\Empresa\EmpresaInterface as Empresa;

class HomeController extends Controller
{

    protected $empresaI;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Empresa $empresa)
    {
        //$this->middleware('auth');

        $this->empresaI = $empresa;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $model = $this->empresaI->getAll();               
        return view('home', compact('model'));
    }
}
