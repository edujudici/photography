<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\Company\CompanyInterface;

class HomeController extends Controller
{

    protected $companyI;
    
    public function __construct(CompanyInterface $companyI) {
        //$this->middleware('auth');
        $this->companyI = $companyI;
    }

    public function index() {
        $model = $this->companyI->getAll();               
        return view('home', compact('model'));
    }

    public function save($data) {
        return $this->companyI->save($data);
    }

    public function delete($id) {
        return $this->companyI->save($id);
    }
}
