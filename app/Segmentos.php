<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmentos extends Model
{
    protected $table = 'tb_segmentos';

    protected $primaryKey = 'id';

    protected $fillable = ['titulo', 'descricao', 'imagem', 'texto', 'ativo', 'excluido', 'created_at', 'updated_at'];

    public function videos(){
      return $this->belongsToMany('App\Videos', 'tb_segmentos_videos', 'id_segmento', 'id_video')->withTimestamps();
    }

    public function cases(){
      return $this->belongsToMany('App\Cases', 'tb_segmentos_cases', 'id_segmento', 'id_case')->withTimestamps();
    }
}
