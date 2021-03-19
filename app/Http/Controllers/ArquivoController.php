<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArquivosRequest;
use App\Arquivo;

class ArquivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $arquivos = Arquivo::where('excluido', 0)->get();
        return view('pages.painel.listar.arquivos.index', compact('user', 'arquivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('pages.painel.cadastro.arquivos.index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArquivosRequest $request)
    {
        $arquivo = new Arquivo;
        
        if ($arquivo->salvar_banco($request)) {
            return redirect()->back()->with('message', 'Arquivo cadastrado com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Erro ao adicionar o arquivo');
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
        $arquivo = Arquivo::findOrFail($id);
        $user = Auth::user();
        return view('pages.painel.editar.arquivos.index', compact('user', 'arquivo'));
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
        $arquivo_model = new Arquivo;

        if($arquivo_model->editar_banco($request, $id)){
            return redirect()->back()->with('message', 'Arquivo editado com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Erro ao editar o arquivo');
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

    public function alt_status($id) {
        $arquivo = Arquivo::find($id);
        if($arquivo->excluido == 0){
            $arquivo->excluido = 1;
        }
        else{
            $arquivo->excluido = 0;
        }
        $arquivo->save();
        return back();
    }
}
