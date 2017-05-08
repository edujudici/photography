<?php

namespace App\Http\Api\Company;

interface CompanyInterface {
    public function getAll();
    public function save($data);
    public function delete($id);
    // public function getByID($id);
    // public function update($id,array $data);
}