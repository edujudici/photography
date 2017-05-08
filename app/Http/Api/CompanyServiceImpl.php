<?php

namespace App\Http\Api\Company;

use App\Http\Api\Company\CompanyInterface;
use App\Company;
use App\Image;

class CompanyServiceImpl implements CompanyInterface {

    protected $company;

    function __construct(Company $company) {
        $this->company = $company;
    }

    public function getAll() {

    	$companies = $this->company->all();

    	foreach ($companies as $key => $value) {
    		$value->photos = Image::where('com_id',$value->company_id)->count();	
    	}

        return $companies;
    }

    public function save($data) {

    	//TODO: validate fields

    	$company = $data->id == null ? new Company : Company::find($data->id);
    	$company->description = $data->description;
    	$company->token = 'kjhgnvhtdr123478';
    	$company->save();

    	return ['status'=>true, 'company'=>$company, 'message'=>'Empresa cadastrada com sucesso.'];
    }

    public function delete($id) {

    	$company = Company::delete($id);
    	return ['status'=>true, 'company'=>$company, 'message'=>'Empresa deletada com sucesso.'];
    }
}