<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContatoRequest;
use App\Http\Requests\NewsletterRequest;
use App\Http\Requests\PagContatoRequest;
use Illuminate\Support\Facades\Auth;
use App\Contato;
use App\Meta;
use App\Paginas;
use App\Segmentos;
use App\Localizacao;
use Mail;
use App\Mail\SendMail;
use App\Mail\PagContatoMail;
use App\MailModel;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $contatos = Contato::all();
        
        return view('pages.painel.listar.contatos.index', compact('user', 'contatos'));
    }

    public function contato(){
 
        $contato = Paginas::where('localizacao', 8)->where('excluido', 0)->with('categorias')->with('icones')->get();

        $rodape = Paginas::where('localizacao', 2)->where('excluido', 0)->with('categorias')->get();

        $menu = Paginas::where('localizacao', 1)->where('excluido', 0)->with('categorias')->get();

        $metas = Meta::where('ativo', 1)->get();

        return view('pages.site.contato.index', compact(
        'contato',
        'rodape',
        'menu',
        'metas'
        ));
    }

    public function enviar_formulario_contato(Request $request)
    {
        $token = $request->input('g-recaptcha-response');

        if(isset($token)){

            $data = new MailModel;

            $data->nome = $request->nome;
            $data->email = $request->email;
            $data->telefone = $request->telefone;
            $data->texto = $request->texto;
            $data->subject = 'Página Contato';

            Mail::to('gabriel.campos@soitic.com')->send(new SendMail($data));

            $contato = new Contato;

            $contato->nome = $request->nome;
            $contato->email = $request->email;
            $contato->telefone = $request->telefone;
            $contato->texto = $request->texto;
            $contato->texto = 'Página Contato';

            $contato->save();

            return redirect()->to(url()->previous() . '#contato')->with('status_contato', 'E-mail enviado com sucesso!');

        }else{

            setcookie("nome", $request->nome, time() + 360, "/");
            setcookie("email", $request->email, time() + 360, "/");
            setcookie("telefone", $request->telefone, time() + 360, "/");
            setcookie("texto", $request->texto, time() + 360, "/");

            return redirect()->to(url()->previous() . '#contato')->with('error_contato', 'Erro, Verifique o reCAPTCHA!');

        }

    }

    public function newsletter_enviar(Request $request){

        $token = $request->input('g-recaptcha-response');

        if(isset($token)){

            $contato = new Contato;

            $contato->nome = "";
            $contato->telefone = "";
            $contato->email = $request->input('email');
            $contato->texto = 'Estou interessado na sua newsletter!';
            $contato->localizacao = 'Newsletter Rodapé';
            $contato->save();

            return redirect()->to(url()->previous() . '#newsletter')->with('status', 'E-mail enviado com sucesso!');

        }else{

            return redirect()->to(url()->previous() . '#newsletter')->with('error', 'Erro, Verifique o reCAPTCHA!');

        }
    
    }

    public function get_info(Request $request){
        $contato = Contato::findOrFail($request->id_contato);
        return view('pages.painel.listar.contatos.componentes.modal_ajax', compact('contato'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
