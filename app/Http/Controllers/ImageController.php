<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\Image\ImageInterface;
use App\Http\Requests\ImageFormRequest;

class ImageController extends Controller
{

	protected $imageI;
    
    public function __construct(ImageInterface $imageI) {
        $this->imageI = $imageI;
    }

    public function index() {
        return view('images');
    }
    
    public function save(ImageFormRequest $req) {
        return $this->imageI->save($req);
    }
}
