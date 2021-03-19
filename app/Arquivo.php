<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_arquivos';
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var array
     */

    protected $fillable = ['id', 'titulo', 'descricao', 'imagem', 'arquivo', 'excluido', 'created_at', 'updated_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function salvar_banco($request): bool
    {
        if ($request->has('imagem')) {
            $image = $request->file('imagem');
            $nome_img = uniqid('img_') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imagens_arquivos');
            $image->move($destinationPath, $nome_img);
        }
        if ($request->has('arquivo')) {
            $arquivo = $request->file('arquivo');
            $nome_arquivo = uniqid('arquivo_') . '.' . $arquivo->getClientOriginalExtension();
            $destinationPath = public_path('/arquivos');
            $arquivo->move($destinationPath, $nome_arquivo);
        }

        $arquivo_banco = Arquivo::create([
            "titulo" => $request->titulo,
            "descricao" => $request->descricao,
            "arquivo" => $nome_arquivo,
            "imagem" => $nome_img,
        ]);
        return true;
    }

    public function editar_banco($request, $id): bool
    {
        $arquivo_busca = Arquivo::findOrFail($id);
        
            if ($request->has('imagem')) {
                $image = $request->file('imagem');
                $nome_img = uniqid('img_') . '.' . $image->getClientOriginalExtension();
                $destinationPath_img = public_path('/imagens_arquivos');
                $path_img = $destinationPath_img . DIRECTORY_SEPARATOR . $arquivo_busca->imagem;
                if (file_exists($path_img)) {
                    @unlink($path_img);
                }
                $image->move($destinationPath_img, $nome_img);
            }else{
                $nome_img = $arquivo_busca->imagem;
            }

            if ($request->has('arquivo')) {
                $arquivo = $request->file('arquivo');
                $nome_arquivo = uniqid('arquivo_') . '.' . $arquivo->getClientOriginalExtension();
                $destinationPath_arq = public_path('/arquivos');
                $path_arquivo = $destinationPath_arq . DIRECTORY_SEPARATOR . $arquivo_busca->arquivo;
                if (file_exists($path_arquivo)) {
                    @unlink($path_arquivo);
                }
                $arquivo->move($destinationPath_arq, $nome_arquivo);
            }else{
                $nome_arquivo = $arquivo_busca->arquivo;
            }

        $arquivo_busca->titulo = $request->titulo;
        $arquivo_busca->descricao = $request->descricao;
        $arquivo_busca->imagem = $nome_img;
        $arquivo_busca->arquivo = $nome_arquivo;
        $arquivo_busca->save();
        return true;
    }
}
