<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $imgController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ImagemController $imgController)
    {
        //$this->middleware('auth');

        $this->imgController = $imgController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->imgController->listar();        
        return view('home', compact('model'));
    }
}
