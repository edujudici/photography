<?php

namespace App\Http\Api\Image;

use Intervention\Image\ImageManagerStatic as ImageIntervention;
use App\Http\Api\Image\ImageInterface;
use App\Image;

class ImageServiceImpl implements ImageInterface {

    protected $image;

    const PATH = 'images/cropped/';

    function __construct(Image $image) {
        $this->image = $image;
    }

    public function save($request) {

    	$files = $request->file('images');
        foreach ($files as $key => $value) {

            $extension = $value->getMimeType();
            $extension = explode('/', $extension);

            $name = str_random(40).'.'.$extension[1];
            
            if ($value->move(public_path(self::PATH), $name)) {
                debug('imagem salva com sucesso');
            }
        }
        
        return response()->api([]);
    }
}