<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fotos;
use Validator;
use App\Localizacao_Galeria;
use Illuminate\Support\Facades\Auth;

class FotosController extends Controller
{
    public function index($id){
      // dd($id);
      $galeria = Localizacao_Galeria::find($id);
      $fotos_ativas = Fotos::select('id_galeria', 'titulo', 'descricao', 'imagem')->where('excluido', 0)->where('localizacao', $id)->get();
      // dd($fotos_ativas);
      // $fotos_excluidas = Fotos::select('titulo', 'descricao', 'imagem')->where('excluido', 1)->get();
      $user = Auth::user();

      return view('pages.painel.cadastro.fotos.index', compact('fotos_ativas', 'id', 'galeria', 'user'));
    }

    public function cadastro_fotos(Request $req){
      // dd(bin2hex(random_bytes(16)));

     $validator = Validator::make($req->all(), [
       'imagem.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

     if ($validator->passes()) {
       for ($i=0; $i < count($req->file('imagem')); $i++) {
         $name = bin2hex(random_bytes(16)).'.'.$req->file('imagem')[$i]->getClientOriginalExtension();
         // dd($name);
         $destinationPath = public_path('/imagens_galerias');
         $req->file('imagem')[$i]->move($destinationPath, $name);
         $foto = new Fotos;
         $foto->imagem = $name;
         $foto->titulo = "Sem titulo";
         $foto->localizacao = $req->id_localizacao_galeria;
         $foto->save();
       }
       return back()->with('success','Imagens cadastradas com sucesso!');
     }else{
       return back()->with('error','Este arquivo não é uma imagem ou o tamhano dela é muito grande!');
     }

    }

    public function editar_titulo(Request $req){
      $imagem = Fotos::find($req->id_imagem);
      $imagem->titulo = $req->titulo;
      $imagem->save();
      return back()->with('success', 'Titulo da foto alterado com sucesso!');
    }

    public function excluir_foto(Request $req){
      $imagem = Fotos::find($req->id_foto);
      $imagem->excluido = 1;
      $imagem->save();
      $fotos_ativas = Fotos::select('id_galeria', 'titulo', 'descricao', 'imagem')->where('excluido', 0)->where('localizacao', $imagem->localizacao)->get();
      return view('pages.painel.cadastro.fotos.componentes.imagens_ajax', compact('fotos_ativas'));

    }
}
