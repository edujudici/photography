<?php

namespace App\Http\Controllers;

use App\Imagem;
use Illuminate\Http\Request;

class ImagemController extends Controller
{

    public function listar() {
        $model['imagens'] = Imagem::orderBy('img_posicao')
            ->get();        

        return $model;
        
        //return View::make('galeria.index')->with('model', json_encode($model));
    }
    
    public function salvar() {
        $imagens = Input::all();
        
        $regras = array(
            "imagens" => "required|array"            
        );
        
        $mensagensErro = array(
            "required" => "O campo :attribute é obrigatório.",
            "array"    => "O campo :attribute deve ser uma lista."
        );
        
        $validador = Validator::make($imagens, $regras, $mensagensErro);
        if ($validador->fails()) {
            $messages = $validador->messages();
            return ['status' => 0, 'mensagem' => $messages->all()]; 
        }
        
        $files = Input::file('imagens');
        foreach ($files as $key => $value) {
            
            $imageRealPath = $value->getRealPath();
            //$name = $value->getClientOriginalName();
            $name = str_random(40).'.'.$value->getClientOriginalExtension(); //$value->getClientOriginalName();
            
            $img = Image::make($imageRealPath);
            $img->resize(600, 600);
            
            $pathPublic = public_path();
            $pathDirectory = '/imagens/galeria/'.$name;
            $path = $pathPublic.$pathDirectory;
            $img->save($path);
            
            $imagem = new Imagem();            
            $imagem->img_imagem = $pathDirectory;
            $imagem->img_posicao = Imagem::count();
            $imagem->save();
        }
        
        return ['status' => 1, 'imagens' => Imagem::orderBy('img_posicao')->get(), 'mensagem' => 'Imagens cadastrado com sucesso.']; 
    }
    
    public function ordenar() {
        
        $dados = Input::all();
        foreach ($dados['imagens'] as $key => $value) {
            $imagem = Imagem::find($value['id']);
            $imagem->img_posicao = $value['position'];
            $imagem->save();
        }
        
        return ['status' => 1, 'mensagem' => 'Imagens ordenadas com sucesso.']; 
    }
    
    public function excluir() {
        
        $imagem = Imagem::find(Input::get('id'));
        if ($imagem) {
            $pathPublic = public_path();
            $imagem->delete();
			unlink($pathPublic.$imagem->img_imagem);            
            return ['status' => 1, 'mensagem' => 'Imagem deletado com sucesso.']; 
        }
        
        return ['status' => 0, 'mensagem' => 'Imagem não encontrado.']; 
    }
}
