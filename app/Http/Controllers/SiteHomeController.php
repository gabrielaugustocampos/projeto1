<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Paginas;
use App\Fotos;
use App\Localizacao_Galeria;
use App\Localizacao;
use App\Icone;
use App\Categorias;
use App\Videos;
use App\Cases;
use App\Meta;
use App\Arquivo;



class SiteHomeController extends Controller
{
  public function index(){
    
    $banners_desk = Banner::select('titulo', 'descricao', 'imagem', 'nome_botao', 'url_botao', 'is_mobile')
    ->where('excluido', 0)
    ->where('is_mobile', 0)
    ->get();
    
    $home = Paginas::where('localizacao', 3)->where('excluido', 0)->with('categorias')->get();

    $sobre = Paginas::where('localizacao', 4)->where('excluido', 0)->with('categorias')->get();

    $cursos = Paginas::where('localizacao', 5)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $depoimentos = Paginas::where('localizacao', 9)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $blog = Paginas::where('localizacao', 6)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $galeria = Paginas::where('localizacao', 7)->where('excluido', 0)->with('gallery')->get();

    $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

    $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

    $metas = Meta::where('ativo', 1)->get();
    
    return view('pages.site.home.index', compact(
      'banners_desk', 
      'home',
      'sobre',
      'cursos',
      'depoimentos',
      'blog',
      'galeria',
      'contato',
      'rodape',
      'menu',
      'metas'
    ));
  }

  public function sobre(){

    $sobre = Paginas::where('localizacao', 4)->where('excluido', 0)->with('categorias')->get();

    $depoimentos = Paginas::where('localizacao', 9)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

    $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

    $metas = Meta::where('ativo', 1)->get();

    return view('pages.site.sobre.index', compact( 
      'sobre',
      'depoimentos',
      'contato',
      'rodape',
      'menu',
      'metas'
    ));
  }

  public function cursos(){

    $cursos = Paginas::where('localizacao', 5)->where('excluido', 0)->with('categorias')->get();

    $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

    $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

    $metas = Meta::where('ativo', 1)->get();

    return view('pages.site.cursos.index', compact( 
      'cursos',
      'contato',
      'rodape',
      'menu',
      'metas'
    ));
  }

  public function curso_detalhe($id){

    $cursos = Paginas::where('localizacao', 5)->where('excluido', 0)->with('categorias')->get();

    $curso = Paginas::where('id_texto', $id)->where('excluido', 0)->with('categorias')->first();

    $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

    $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

    $metas = Meta::where('ativo', 1)->get();

    return view('pages.site.curso_detalhe.index', compact( 
      'curso',
      'cursos',
      'contato',
      'rodape',
      'menu',
      'metas'
    ));
  }

  public function galeria(){

    $galeria = Paginas::where('localizacao', 7)->where('excluido', 0)->with('gallery')->get();

    $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

    $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

    $metas = Meta::where('ativo', 1)->get();

    return view('pages.site.galeria.index', compact( 
      'galeria',
      'contato',
      'rodape',
      'menu',
      'metas'
    ));
  }

  public function blog(){

    $blogs = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
    ->where('tb_texto.localizacao', 6)
    ->where('tb_texto.excluido', 0)
    ->where('tb_categorias_tb_texto.id_categoria', 6)
    ->with('categorias')
    ->with('icones')
    ->paginate(6);
    

    $blog = Paginas::where('localizacao', 6)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $blog_recente = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
    ->where('tb_texto.localizacao', 6)  
    ->where('tb_texto.excluido', 0)
    ->where('tb_categorias_tb_texto.id_categoria', 6)
    ->orderBy('tb_texto.id_texto', 'desc')
    ->take(4)
    ->get();

    $meses = Paginas::selectRaw('year(created_at) year, monthname(created_at) month, created_at')->
    where('localizacao', 6)->where('excluido', 0)
    ->groupBy('year', 'month')
    ->orderBy('year', 'desc')
    ->get();

    // dd($meses);

    $categorias = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
    ->join('tb_categorias', 'tb_categorias_tb_texto.id_categoria', '=', 'tb_categorias.id')
    ->where('tb_texto.localizacao', 6)
    ->where('tb_texto.excluido', 0)
    ->whereNotIn('tb_categorias_tb_texto.id_categoria', [1,6,7])
    ->groupBy('tb_categorias_tb_texto.id_categoria')
    ->get();

    $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

    $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

    $metas = Meta::where('ativo', 1)->get();

    return view('pages.site.blog.index', compact( 
      'blog',
      'blogs',
      'blog_recente',
      'meses',
      'categorias',
      'contato',
      'rodape',
      'menu',
      'metas'
    ));
  }

  public function blog_detalhado($id){

    $blogs = Paginas::where('id_texto', $id)->with('categorias')->with('icones')->first();
    
    $blog = Paginas::where('localizacao', 6)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $blog_recente = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
    ->where('tb_texto.localizacao', 6)  
    ->where('tb_texto.excluido', 0)
    ->where('tb_categorias_tb_texto.id_categoria', 6)
    ->orderBy('tb_texto.id_texto', 'desc')
    ->take(4)
    ->get();

    $meses = Paginas::selectRaw('year(created_at) year, monthname(created_at) month, created_at')->
    where('localizacao', 6)->where('excluido', 0)
    ->groupBy('year', 'month')
    ->orderBy('year', 'desc')
    ->get();

    // dd($meses);

    $categorias = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
    ->join('tb_categorias', 'tb_categorias_tb_texto.id_categoria', '=', 'tb_categorias.id')
    ->where('tb_texto.localizacao', 6)
    ->where('tb_texto.excluido', 0)
    ->whereNotIn('tb_categorias_tb_texto.id_categoria', [1,6,7])
    ->groupBy('tb_categorias_tb_texto.id_categoria')
    ->get();

    $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

    $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

    $metas = Meta::where('ativo', 1)->get();

    return view('pages.site.blog_detalhe.index', compact( 
      'blog',
      'blogs',
      'blog_recente',
      'meses',
      'categorias',
      'contato',
      'rodape',
      'menu',
      'metas'
    ));
  }

  public function blog_filtro($filtro, $tipo, Request $request){

    // Tipos de Filtro 
    // 1 - Meses 
    // 2 - Categoria
    // 3 - Tags
    // 4 - Pesquisa

    if($tipo == 1){

      $data = explode("-", $filtro);

      $blogs = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
      ->where('tb_texto.localizacao', 6)
      ->whereMonth('tb_texto.created_at', $data[1])
      ->whereYear('tb_texto.created_at', $data[0])
      ->where('tb_texto.excluido', 0)
      ->where('tb_categorias_tb_texto.id_categoria', 6)
      ->with('categorias')
      ->with('icones')
      ->paginate(6);

    }elseif($tipo == 2){

      $blogs = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
      ->where('tb_texto.localizacao', 6)
      ->where('tb_texto.excluido', 0)
      ->where('tb_categorias_tb_texto.id_categoria', $filtro)
      ->with('categorias')
      ->with('icones')
      ->paginate(6);

    }elseif($tipo == 3){

      $blogs = Paginas::join('tb_icones', 'tb_texto.id_texto', '=', 'tb_icones.id_texto')
      ->where('tb_texto.localizacao', 6)
      ->where('tb_texto.excluido', 0)
      ->where('tb_icones.titulo', $filtro)
      ->with('categorias')
      ->with('icones')
      ->paginate(6);

    }elseif($tipo == 4){

      $blogs = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
      ->where('tb_texto.localizacao', 6)
      ->where('tb_texto.excluido', 0)
      ->where('tb_categorias_tb_texto.id_categoria', 6)
      ->where('tb_texto.titulo', 'LIKE', '%'. $request->palavra . '%')
      ->with('categorias')
      ->with('icones')
      ->paginate(6);

    }  

    $blog = Paginas::where('localizacao', 6)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $blog_recente = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
    ->where('tb_texto.localizacao', 6)  
    ->where('tb_texto.excluido', 0)
    ->where('tb_categorias_tb_texto.id_categoria', 6)
    ->orderBy('tb_texto.id_texto', 'desc')
    ->take(4)
    ->get();

    $meses = Paginas::selectRaw('year(created_at) year, monthname(created_at) month, created_at')
    ->where('localizacao', 6)->where('excluido', 0)
    ->groupBy('year', 'month')
    ->orderBy('year', 'desc')
    ->get();

    $categorias = Paginas::join('tb_categorias_tb_texto', 'tb_texto.id_texto', '=', 'tb_categorias_tb_texto.id_texto_cat')
    ->join('tb_categorias', 'tb_categorias_tb_texto.id_categoria', '=', 'tb_categorias.id')
    ->where('tb_texto.localizacao', 6)
    ->where('tb_texto.excluido', 0)
    ->whereNotIn('tb_categorias_tb_texto.id_categoria', [1,6,7])
    ->groupBy('tb_categorias_tb_texto.id_categoria')
    ->get();

    $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

    $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

    $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

    $metas = Meta::where('ativo', 1)->get();

    return view('pages.site.blog.index', compact( 
      'blog',
      'blogs',
      'blog_recente',
      'meses',
      'categorias',
      'contato',
      'rodape',
      'menu',
      'metas'
    ));
  }

}
