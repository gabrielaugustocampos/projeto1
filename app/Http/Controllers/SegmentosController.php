<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Segmentos;
use App\Videos;
use App\Cases;
use App\Meta;
use App\Banner;
use App\Paginas;
use App\Localizacao;
use App\Http\Requests\SegmentosRequest;


class SegmentosController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $user = Auth::user();
    $segmentos = Segmentos::select('id', 'titulo', 'descricao', 'imagem', 'excluido', 'texto')
    ->where('ativo', 1)
    ->get();

    return view('pages.painel.listar.segmentos.index', compact('segmentos', 'user'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(){

    $user = Auth::user();
    $videos = Videos::where('excluido', 0)->get();
    $cases = Cases::where('excluido', 0)->get();

    return view('pages.painel.cadastro.segmentos.index', compact('user', 'videos', 'cases'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(SegmentosRequest $request)
  {
    $request->validated();
    $segmentos = new Segmentos;
    $segmentos->titulo = $request->titulo;
    $segmentos->descricao = $request->descricao;
    $segmentos->ativo = 1;
    $segmentos->texto = $request->editor1;
    if ($request->has('imagem')) {

      $image = $request->file('imagem');
      $name = uniqid('img_').'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/imagens_segmentos');
      $image->move($destinationPath, $name);
      $segmentos->imagem = $name;
    }else{
      $segmentos->imagem = NULL;
    }
    $segmentos->save();

    $segmentos->videos()->sync($request->videos);
    $segmentos->cases()->sync($request->cases);

    return redirect()->back()->with('message', 'Cadastro efetuado com sucesso!');

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $metas = Meta::where('ativo', 1)->get();
    $segmento = Segmentos::where('id', $id)->with(['videos', 'cases'])->firstOrFail();
    $banner = Banner::where('excluido', 0)->firstOrFail();
    // dd($banner);
    $fale_conosco = Paginas::where('localizacao', 4)->where('excluido', 0)->firstOrFail();
    $segmentos = Segmentos::select('id', 'titulo', 'descricao', 'imagem')->where('excluido', 0)->get();
    $redes_sociais_navbar = Paginas::where('localizacao', 25)->where('excluido', 0)->first();
    $modal = Paginas::where('excluido', 0)->where('localizacao', 20)->first();
    $produtos = Localizacao::select('nome', 'id_localizacao_texto')->where('is_product', 1)->where('excluido', 0)->get();
    $array_produtos_merge = [];
    foreach ($produtos as $key => $produto) {
      $produtos_join = Localizacao::
              join('tb_texto', 'tb_localizacao_texto.id_localizacao_texto', '=', 'tb_texto.localizacao')
              ->select('tb_texto.id_texto', 'tb_texto.titulo')
              ->where('tb_texto.localizacao', $produto->id_localizacao_texto)
              ->get();
      
      $array_produtos_merge[$produto->nome] =  $produtos_join->toArray();
      
    }
    // dd($array_produtos_merge);
    $rodape = Paginas::where('excluido', 0)->where('localizacao', 26)->with('icones')->first();
    // dd($rodape);
    return view('pages.site.segmentos.index', compact('rodape', 'array_produtos_merge', 'modal', 'segmento', 'metas', 'banner','fale_conosco', 'segmentos', 'redes_sociais_navbar'));
  }

  public function filtro_busca(Request $request){

    if ($request->valor_filtro == 0) {
      # busca segmentos não excluidos
      $segmentos = Segmentos::select('id', 'titulo', 'descricao', 'imagem', 'excluido', 'texto')
      ->where('ativo', 1)
      ->where('excluido', 0)
      ->get();

    }elseif ($request->valor_filtro == 1) {
      # busca segmentos excluidos
      $segmentos = Segmentos::select('id', 'titulo', 'descricao', 'imagem', 'excluido', 'texto')
      ->where('ativo', 1)
      ->where('excluido', 1)
      ->get();

    }else{
      # retorna erro caso valor da request não seja 0 ou 1
      return 1;
    }

    return view('pages.painel.listar.segmentos.componentes.listar_segmentos_ajax', compact('segmentos'));
  }

  public function alterar_status(Request $request){
    $segmento = Segmentos::findOrFail($request->id_segmento);
    if ($segmento->excluido == 0) {
      # se segmento não estiver excluido altere o status dele para excluido (ecluido -> 1)
      $segmento->excluido = 1;
    }else{
      # se segmento estiver excluido altere o status dele para ativo (ecluido -> 0)
      $segmento->excluido = 0;
    }
    $segmento->save();

    $segmentos = Segmentos::select('id', 'titulo', 'descricao', 'imagem', 'excluido', 'texto')
    ->where('ativo', 1)
    ->get();

    return view('pages.painel.listar.segmentos.componentes.listar_segmentos_ajax', compact('segmentos'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $user = Auth::user();

    $segmento = Segmentos::where('id', $id)
    ->with(['videos' => function($query){
      $query->where('tb_videos.excluido', 0);
    }, 
    'cases' => function($query){
      $query->where('tb_cases.excluido', 0);
    }])->firstOrFail();
    $videos_sem_selecionar = Videos::whereNotIn('id', $segmento->videos->pluck('id'))->where('excluido', 0)->get();
    $cases_sem_selecionar = Cases::whereNotIn('id', $segmento->cases->pluck('id'))->where('excluido', 0)->get();


    return view('pages.painel.editar.segmentos.index', compact('user', 'segmento', 'videos_sem_selecionar', 'cases_sem_selecionar'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $segmento = Segmentos::findOrFail($id);
    $segmento->titulo = $request->titulo;
    $segmento->descricao = $request->descricao;
    $segmento->ativo = 1;
    $segmento->texto = $request->editor1;
    if ($request->has('imagem')){
      $image = $request->file('imagem');
      $name = uniqid('img_').'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/imagens_segmentos');
      $image->move($destinationPath, $name);
      $segmento->imagem = $name;
    }
    $segmento->save();
    $segmento->videos()->sync($request->videos);
    $segmento->cases()->sync($request->cases);

    return redirect()->back()->with('message', 'Segmento editado com sucesso!');

  }

  public function remover_imagem(Request $request){
    $segmento = Segmentos::findOrFail($request->id_segmento);
    $destinationPath = public_path('imagens_segmentos');
    //DIRECTORY_SEPARATOR separador de url padrão de cada plataforma
    $path = $destinationPath.DIRECTORY_SEPARATOR.$segmento->imagem;
    if (file_exists($path)) {
      @unlink($path);
    }

    $segmento->imagem = NULL;
    $segmento->save();
    return view("pages.painel.editar.segmentos.componentes.imagem_ajax");
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
