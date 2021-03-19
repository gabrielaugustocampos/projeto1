<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
  public function banner(){
    $banners_ativos = Banner::select('id_banner', 'descricao', 'imagem', 'is_mobile', 'titulo')->where('excluido', 0)->get();
    $banners_excluidos = Banner::select('id_banner', 'descricao', 'imagem', 'is_mobile', 'titulo')->where('excluido', 1)->get();
    $user = Auth::user();
    return view('pages.painel.listar.banner.index', compact('banners_ativos', 'banners_excluidos', 'user'));
  }

  public function alterar_status(Request $req){
    $banner = Banner::select('id_banner', 'excluido')->find($req->id_banner);
    if ($banner->excluido == 0) {
      $banner->excluido = 1;
    }else{
      $banner->excluido = 0;
    }
    $banner->save();

    $banners_ativos = Banner::select('id_banner', 'descricao', 'imagem', 'is_mobile', 'titulo', 'is_mobile')->where('excluido', 0)->get();
    $banners_excluidos = Banner::select('id_banner', 'descricao', 'imagem', 'is_mobile', 'titulo', 'is_mobile')->where('excluido', 1)->get();
    return view('pages.painel.listar.banner.componentes.banner_ajax', compact('banners_ativos', 'banners_excluidos'));
  }

  public function cadastro_banner(Request $req){
    $banner = new Banner;
    $banner->titulo = $req->titulo_banner;
    $banner->nome_botao = $req->nome_botao;
    $banner->url_botao = $req->url_botao;
    $banner->descricao = $req->descricao_banner;
    $banner->is_mobile = $req->tipo_banner;
    $banner->save();
    return Redirect::to('/banner/'.$banner->id_banner);

  }

  public function banner_editar($id){
    $banner = Banner::select('id_banner', 'titulo', 'descricao', 'nome_botao', 'url_botao', 'imagem', 'is_mobile')->find($id);
    $user = Auth::user();
    return view('pages.painel.cadastro.banner.index', compact('banner', 'id', 'user'));
  }

  public function cadastro_banner_banco(Request $req){
    $validator = Validator::make($req->all(), [
      'imagem.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    if ($validator->passes()) {
      $banner = Banner::find($req->id_banner);

      if ($req->hasFile('imagem')) {
        $image = $req->file('imagem');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/imagens_banner');
        $image->move($destinationPath, $name);
        $banner->imagem = $name;
        $banner->titulo = $req->titulo_banner;
        $banner->descricao = $req->descricao_banner;
        // $banner->is_mobile = $req->tipo_banner;
      }else{
        $banner->titulo = $req->titulo_banner;
        $banner->descricao = $req->descricao_banner;
        // $banner->is_mobile = $req->tipo_banner;
      }
      $banner->nome_botao = $req->nome_botao;
        $banner->url_botao = $req->url_botao;
      // dd($pagina->imagem);
      $banner->save();
      // dd("salvo");
      return Redirect::to('/banner/'.$banner->id_banner)->with('success','Salvo com sucesso!');
    }else{
      return Redirect::to('/banner/'.$banner->id_banner)->with('error','Este arquivo não é uma imagem ou é muito grande!');
    }
  }

  public function excluir_banner(Request $req){
    $banner = Banner::find($req->id_banner);
    // dd($pagina);
    $banner->imagem = NULL;
    $banner->save();
    $id = $banner->id_banner;
    // dd($pagina->imagem);
    return view('pages.painel.cadastro.banner.componentes.formulario', compact('banner', 'id'));
  }
}
