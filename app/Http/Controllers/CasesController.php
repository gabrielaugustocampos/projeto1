<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CasesRequest;
use App\Cases;



class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $cases_ativas = Cases::where('excluido', 0)->get();
        $cases_excluidas = Cases::where('excluido', 1)->get();

        return view('pages.painel.listar.cases.index', compact('user', 'cases_ativas', 'cases_excluidas'));

    }

    public function alterar_status(Request $request){
      $case = Cases::findOrFail($request->id_case);
      if ($case->excluido == 0) {
        $case->excluido = 1;
      }else{
        $case->excluido = 0;
      }
      $case->save();

      $cases_ativas = Cases::where('excluido', 0)->get();
      $cases_excluidas = Cases::where('excluido', 1)->get();

      return view('pages.painel.listar.cases.componentes.cases_ajax', compact('cases_ativas', 'cases_excluidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();

      return view('pages.painel.cadastro.cases.index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CasesRequest $request)
    {
      $request->validated();
      $cases = new Cases;
      $cases->titulo = $request->titulo;
      $cases->descricao = $request->descricao;
      $cases->ativo = 1;
      if ($request->has('imagem')) {

        $image = $request->file('imagem');
        $name = uniqid('img_').'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/imagens_cases');
        $image->move($destinationPath, $name);
        $cases->imagem = $name;
      }else{
        $segmentos->imagem = NULL;
      }
      $cases->save();

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
        $case = Cases::findOrFail($id);
        $user = Auth::user();

        return view('pages.painel.editar.cases.index', compact('user', 'case'));
    }

    public function remover_imagem(Request $request){
      $case = Cases::findOrFail($request->id_case);
      $destinationPath = public_path('imagens_cases');
      //DIRECTORY_SEPARATOR separador de url padrão de cada plataforma
      $path = $destinationPath.DIRECTORY_SEPARATOR.$case->imagem;
      if (file_exists($path)) {
        @unlink($path);
      }

      $case->imagem = NULL;
      $case->save();
      return view("pages.painel.editar.cases.componentes.imagem_ajax");
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
      $case = Cases::findOrFail($id);
      $case->titulo = $request->titulo;
      $case->descricao = $request->descricao;
      $case->ativo = 1;
      if ($request->has('imagem')) {

        $image = $request->file('imagem');
        $name = uniqid('img_').'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/imagens_cases');
        $image->move($destinationPath, $name);
        $case->imagem = $name;
      }
      $case->save();
      return redirect()->back()->with('message', 'Segmento editado com sucesso!');

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
