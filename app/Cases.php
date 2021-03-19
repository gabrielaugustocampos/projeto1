<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{

  protected $table = 'tb_cases';

  protected $primaryKey = 'id';

  protected $fillable = ['titulo', 'descricao', 'imagem', 'ativo', 'excluido', 'created_at', 'updated_at'];

  public function segmentos(){
    return $this->belongsToMany('App\Segmentos', 'tb_segmentos_cases', 'id_case', 'id_segmento')->withTimestamps();
  }

}
