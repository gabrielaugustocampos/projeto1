<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Localizacao_Galeria;
use App\Paginas;
use Illuminate\Support\Facades\Auth;

class GaleriaController extends Controller
{
    public function galeria(){

      $galerias_ativo = Localizacao_Galeria::select('id_localizacao_galeria', 'nome', 'excluido', 'descricao')->where('excluido', 0)->get();
      $galerias_excluido = Localizacao_Galeria::select('id_localizacao_galeria', 'nome', 'excluido', 'descricao')->where('excluido', 1)->get();
      // dd($galerias);
      $user = Auth::user();

      return view('pages.painel.listar.galeria.index', compact('galerias_ativo', 'galerias_excluido', 'user'));

    }

    public function alterar_status_galeria(Request $req){
      $galeria = Localizacao_Galeria::find($req->id_galeria);
      if ($galeria->excluido == 0) {
        $paginas_galeria_dependencia = Paginas::select('id_texto')->where('galeria', $req->id_galeria)->where('excluido', 0)->get();
        if(empty($paginas_galeria_dependencia[0])){
            $galeria->excluido = 1;
            $galeria->save();
        }else{
          return 1;
        }

      }else{
        $galeria->excluido = 0;
        $galeria->save();
      }
      $galerias_ativo = Localizacao_Galeria::select('id_localizacao_galeria', 'nome', 'excluido', 'descricao')->where('excluido', 0)->get();
      $galerias_excluido = Localizacao_Galeria::select('id_localizacao_galeria', 'nome', 'excluido', 'descricao')->where('excluido', 1)->get();
      return view('pages.painel.listar.galeria.componentes.galeria_ajax', compact('galerias_ativo', 'galerias_excluido'));
    }

    public function cadastro_localizacao_galeria(Request $req){
      $galeria = new Localizacao_Galeria;
      $galeria->nome = $req->titulo_galeria;
      $galeria->descricao = $req->descricao_galeria;
      $galeria->save();

      $galerias_ativo = Localizacao_Galeria::select('id_localizacao_galeria', 'nome', 'excluido', 'descricao')->where('excluido', 0)->get();
      $galerias_excluido = Localizacao_Galeria::select('id_localizacao_galeria', 'nome', 'excluido', 'descricao')->where('excluido', 1)->get();
      return view('pages.painel.listar.galeria.componentes.galeria_ajax', compact('galerias_ativo', 'galerias_excluido'));
    }

    public function galeria_editar_titulo(Request $req){
      $galeria = Localizacao_Galeria::find($req->id_galeria);
      $galeria->nome = $req->titulo_pagina;
      $galeria->save();
      return back()->with('success', 'Titulo da galeria alterado com sucesso!');
    }
}
