<?php

namespace App\Http\Api\Empresa;

use App\Http\Api\Empresa\EmpresaInterface;
use App\Empresa;

class EmpresaServiceImpl implements EmpresaInterface {

    protected $emp;

    function __construct(Empresa $emp) {
        $this->emp = $emp;
    }

    public function getAll(){
        return $this->emp->all();
    }
}