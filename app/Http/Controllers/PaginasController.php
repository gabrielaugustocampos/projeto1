<?php

namespace App\Http\Controllers;

use App\Icone;
use App\Localizacao;
use App\Localizacao_Galeria;
use App\Paginas;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PaginasController extends Controller
{
    public function listar()
    {
        $localizacao = Localizacao::select('id_localizacao_texto', 'nome')->where('excluido', 0)->get();
        $paginas = Paginas::select('id_texto', 'titulo', 'descricao', 'excluido')->get();
        $categorias = Categoria::where('excluido', 0)->get();
    
        $user = Auth::user();

        return view('pages.painel.listar.paginas.index', compact('localizacao', 'paginas', 'user', 'categorias'));
    }

    public function cadastrar_localizacao(Request $req)
    {

        if($req->is_produto != "0" && $req->is_produto != "1"){
            return 1;
        }else{
            $localizacao_model = new Localizacao;
            $localizacao_model->nome = $req->nome_localizacao;
            $localizacao_model->is_product = $req->is_produto;
            $localizacao_model->save();
    
            $localizacao = Localizacao::select('id_localizacao_texto', 'nome')->where('excluido', 0)->get();
            return view('pages.painel.listar.paginas.componentes.select_localizacao_ajax', compact('localizacao'));
        }
    }

    public function remove_localizacao(Request $req)
    {
        if ($req->id_localizacao == "none") {
            return 0;
        } else {
            $localizacao_unica = Localizacao::find($req->id_localizacao);
            $paginas_dependencia = Paginas::select('id_texto')->where('localizacao', $req->id_localizacao)->where('excluido', 0)->get();
            // dd($paginas_dependencia);
            if (empty($paginas_dependencia[0])) {
                // dd(":D");
                $localizacao_unica->excluido = 1;
                $localizacao_unica->save();
                $localizacao = Localizacao::select('id_localizacao_texto', 'nome')->where('excluido', 0)->get();
                return view('pages.painel.listar.paginas.componentes.select_localizacao_ajax', compact('localizacao'));

            } else {
                return 1;
            }
        }
        // dd($req);
    }

    public function listar_paginas_id(Request $req)
    {
        // dd($req);
        if ($req->valor_filtro == "none" && $req->id_localizacao == "none") {

            return 1;

        } else if ($req->valor_filtro == "none" && $req->id_localizacao != "none") {

            $paginas = Paginas::select('id_texto', 'titulo', 'descricao', 'excluido')->where('localizacao', $req->id_localizacao)->get();

        } else if ($req->valor_filtro != "none" && $req->id_localizacao == "none") {

            $paginas = Paginas::select('id_texto', 'titulo', 'descricao', 'excluido')->where('excluido', $req->valor_filtro)->get();

        } else {
            $paginas = Paginas::select('id_texto', 'titulo', 'descricao', 'excluido')->where('excluido', $req->valor_filtro)->where('localizacao', $req->id_localizacao)->get();
        }

        $localizacao = Localizacao::select('id_localizacao_texto', 'nome')->where('excluido', 0)->get();
        return view('pages.painel.listar.paginas.componentes.tabela_ajax', compact('localizacao', 'paginas'));

    }

    public function alterar_status_pagina(Request $req)
    {
        $pagina_nodal = Paginas::find($req->id_pagina);
        if ($pagina_nodal->excluido == 0) {
            $pagina_nodal->excluido = 1;
        } else {
            $pagina_nodal->excluido = 0;
        }

        $pagina_nodal->save();
        $paginas = Paginas::select('id_texto', 'titulo', 'descricao', 'excluido')->get();
        $localizacao = Localizacao::select('id_localizacao_texto', 'nome')->where('excluido', 0)->get();
        $categorias = Categoria::where('excluido', 0)->get();

        return view('pages.painel.listar.paginas.componentes.tabela_ajax', compact('localizacao', 'paginas', 'categorias'));

    }

    public function cadastro_paginas_tela()
    {
        $localizacao = Localizacao::select('id_localizacao_texto', 'nome')->where('excluido', 0)->get();
        $localizacao_galeria = Localizacao_Galeria::select('id_localizacao_galeria', 'nome')->where('excluido', 0)->get();
        $categorias = Categoria::where('excluido', 0)->get();
        $user = Auth::user();

        return view('pages.painel.cadastro.paginas.index', compact('localizacao', 'localizacao_galeria', 'user', 'categorias'));
    }

    public function cadastro_pagina_banco(Request $req)
    {
        // dd($req->files);
        //  $this->validate($req, [
        //     'imagem' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $validator = Validator::make($req->all(), [
            'imagem.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $exists = false;

        if ($validator->passes()) {
            if (!isset($req->id_edit)) {
                $pagina = new Paginas;
            } else {
                $pagina = Paginas::find($req->id_edit);
                $exists = true;
            }
            if ($req->id_localizacao_cadastro == "none") {

                return back()->with('error', 'Selecione uma localização!');

            } else {

                // dd($req->input("iconsdescription"),$pagina->id);

                if ($req->hasFile('imagem')) {
                    $image = $req->file('imagem');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/imagens_paginas');
                    // dd($destinationPath);
                    $image->move($destinationPath, $name);
                } else {
                    if (!empty($pagina->imagem)) {
                        $name = $pagina->imagem;
                    } else {
                        $name = null;
                    }
                }
                $pagina->titulo = $req->titulo_pagina;
                $pagina->descricao = $req->descricao_pagina;
                $pagina->url = $req->url_pagina;
                $pagina->localizacao = $req->id_localizacao_cadastro;
                if ($req->id_localizacao_galeria_cadastro != "none") {
                    $pagina->galeria = $req->id_localizacao_galeria_cadastro;
                }
                // dd($name);
                $pagina->texto = $req->editor1;
                $pagina->imagem = $name;

                // dd($pagina->imagem);
                $pagina->save();

                $pagina->categorias()->sync($req->categorias);

                if (!empty($req->input('icons'))) {
                    $pagina->saveIcons($req->input('icons'));
                }

                return back()->with('success', 'Cadastro Efetuado com sucesso!');

            }

        } else {
            return back()->with('error', 'Erro! Este arquivo não é uma imagem ou seu tamanho é maior que 2MB');

        }

    }

    public function upload(Request $request)
    {
        $CKEditor = $_GET['CKEditor'];
        $funcNum = $_GET['CKEditorFuncNum'];
        $message = 
        $url = '';
          
            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/ckeditor/plugins/image/images/', $filename);
                $url = url('/ckeditor/plugins/image/images/' .  $filename);
                // dd($url);
            } else {
                $message = 'An error occurred while uploading the file.';
            }
        
        return '<script>window.parent.CKEDITOR.tools.callFunction(' . $funcNum . ', "' . $url . '", "' . $message . '")</script>';
    }

    public function editar($id)
    {
        // $pagina = Paginas::with('categorias')->select('id_texto', 'titulo', 'descricao', 'url', 'imagem', 'texto', 'excluido', 'localizacao', 'galeria')->find($id);
        $pagina = Paginas::where('id_texto', $id)->with(['categorias' => function($query) {
            $query->where('tb_categorias.excluido', 0);
        }])->first();
        $localizacao = Localizacao::select('id_localizacao_texto', 'nome')->where('excluido', 0)->get();
        $localizacao_galeria = Localizacao_Galeria::select('id_localizacao_galeria', 'nome')->where('excluido', 0)->get();
        $user = Auth::user();
        $icones = Paginas::where('id_texto', $id)->with('icones')->firstOrFail()->icones;
        $cat_sem_selecionar = Categoria::whereNotIn('id', $pagina->categorias->pluck('id'))->where('excluido', 0)->get();

        return view('pages.painel.cadastro.paginas.index', compact('pagina', 'localizacao', 'localizacao_galeria', 'id', 'user', 'icones', 'cat_sem_selecionar'));
    }

    public function remove_image(Request $req)
    {
        $pagina = Paginas::select('id_texto', 'titulo', 'descricao', 'url', 'imagem', 'texto', 'excluido', 'localizacao', 'galeria')->find($req->id_pagina);
        // dd($pagina);
        $pagina->imagem = null;
        $pagina->save();
        // dd($pagina->imagem);
        $localizacao = Localizacao::select('id_localizacao_texto', 'nome')->where('excluido', 0)->get();
        $localizacao_galeria = Localizacao_Galeria::select('id_localizacao_galeria', 'nome')->where('excluido', 0)->get();
        return view('pages.painel.cadastro.paginas.componentes.formulario_ajax', compact('pagina', 'localizacao', 'localizacao_galeria', 'id'));
    }

    public function remove_icone($id)
    {
        $deletedRows = Icone::where('id', $id)->delete();

        return response('removido com sucesso');

    }
}
