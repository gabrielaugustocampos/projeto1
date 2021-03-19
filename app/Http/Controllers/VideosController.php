<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VideoRequest;
use App\Videos;


class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $videos_ativos = Videos::where('excluido', 0)->get();
      $videos_excluidos = Videos::where('excluido', 1)->get();

      return view('pages.painel.listar.video.index', compact('user', 'videos_ativos', 'videos_excluidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();
      return view('pages.painel.cadastro.videos.index', compact('user'));
    }

    public function alterar_status(Request $request){
      $video = Videos::findOrFail($request->id_video);
      if ($video->excluido == 0) {
        $video->excluido = 1;
      }else{
        $video->excluido = 0;
      }
      $video->save();

      $videos_ativos = Videos::where('excluido', 0)->get();
      $videos_excluidos = Videos::where('excluido', 1)->get();

      return view('pages.painel.listar.video.componentes.videos_ajax', compact('videos_ativos', 'videos_excluidos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
      $request->validated();

      parse_str( parse_url( $request->url, PHP_URL_QUERY ), $array_param_video );
      if (empty($array_param_video)) {

        return redirect()->back()->with('error', 'URL digitada não é válida!');

      }else{
        $video = new Videos;
        $video->titulo = $request->titulo;
        $video->descricao = $request->descricao;
        $video->url = $array_param_video['v'];
        $video->save();
        return redirect()->back()->with('message', 'Cadastro efetuado com sucesso!');

      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
      $video = Videos::findOrFail($id);

      return view('pages.painel.editar.videos.index', compact('user', 'video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, $id)
    {
        $request->validated();
        parse_str( parse_url( $request->url, PHP_URL_QUERY ), $array_param_video );
        if (empty($array_param_video)) {

          return redirect()->back()->with('error', 'URL digitada não é válida!');

        }else{
          $video = Videos::findOrFail($id);
          $video->titulo = $request->titulo;
          $video->descricao = $request->descricao;
          $video->url = $array_param_video['v'];
          $video->save();
          return redirect()->back()->with('message', 'Cadastro efetuado com sucesso!');
        }
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
