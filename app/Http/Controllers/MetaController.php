<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImagemMetaRequest;
use App\Http\Requests\MetaRequest;
use App\Http\Requests\TextoMetaRequest;
use App\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
    }

    public function edit_metas()
    {
        $user = Auth::user();
        return view('pages.painel.editar.meta_tag.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('pages.painel.cadastro.meta_tag.index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_imagem(ImagemMetaRequest $request)
    {
        //tipo_meta = 0 seria o property
        //tipo_meta = 1 seria o name
        //tipo_meta = 2 seria o link
        $meta_busca = Meta::select('id')->where('name', 'og:image')->first();

        if (!empty($meta_busca)) {
            return redirect()->back()->with('error', 'Meta Tag de imagem já está cadastrada!');
        } else {
            $meta = new Meta;
            $meta->save_image_meta($request);
            return redirect()->back()->with('message', 'Meta Tag cadastrada com sucesso!');

        }

    }

    public function store_texto(TextoMetaRequest $request)
    {
        $meta_busca = Meta::select('id')->where('name', Meta::retorna_array($request)[1])->first();

        if (!empty($meta_busca)) {
            return redirect()->back()->with('error', 'Meta Tag já está cadastrada!');
        } else {

            if ($request->tipo_meta == 8) {
                foreach (Meta::retorna_array($request)[1] as $key => $tag) {
                    $meta = Meta::create([
                        "name" => $tag,
                        "content" => $request->conteudo,
                        "tipo_meta" => $key == 0 ? 1 : 0,
                    ]);
                }

            } else {
                $meta = Meta::create([
                    "name" => Meta::retorna_array($request)[1],
                    "content" => $request->conteudo,
                    "tipo_meta" => $request->tipo_meta == 4 || $request->tipo_meta == 2 ? 1 : 0,
                ]);
            }

            return redirect()->back()->with('message', 'Meta Tag cadastrada com sucesso!');
        }
    }

    public function retornar_formulario_meta(MetaRequest $request)
    {
        return view('pages.painel.cadastro.meta_tag.componentes.' . Meta::retorna_array($request)[0])->with('tipo_meta', $request->tipo_meta);
    }

    public function retornar_formulario_meta_editar(MetaRequest $request)
    {

        $meta_query = Meta::select('id', 'content')->where('name', $request->tipo_meta == 8 ? Meta::retorna_array($request)[1][0] : Meta::retorna_array($request)[1])->first();
        
        return !empty($meta_query) ? 
            view('pages.painel.editar.meta_tag.componentes.' . Meta::retorna_array($request)[0])->with('tipo_meta', $request->tipo_meta)->with('meta_query',  $meta_query) : 
            1;

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TextoMetaRequest $request, $id)
    {
        if ($request->tipo_meta == 8) {
            foreach (Meta::retorna_array($request)[1] as $tag) {

                $meta = Meta::where('name', $tag)->firstOrFail();
                $meta->content = $request->conteudo;
                $meta->save();
            }
            return redirect()->back()->with('message', 'Meta Tag editada com sucesso!');
        }else{

            $meta = Meta::where('name', Meta::retorna_array($request)[1])->firstOrFail();

            if(!empty($meta)){
                $meta->content = $request->conteudo;
                $meta->save();
                return redirect()->back()->with('message', 'Meta Tag editada com sucesso!');
    
            }else{
                return redirect()->back()->with('error', 'Meta Tag não encontrada!');
            }
        }

    }

    public function update_img(ImagemMetaRequest $request){
        $meta = new Meta;
        $meta->update_image_meta($request);
        return redirect()->back()->with('message', 'Meta Tag editada com sucesso!');
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
