<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
  protected $table = 'tb_videos';

  protected $primaryKey = 'id';

  protected $fillable = ['titulo', 'url', 'descricao', 'ativo', 'excluido', 'created_at', 'updated_at'];

  public function segmentos(){
    return $this->belongsToMany('App\Segmentos', 'tb_segmentos_videos', 'id_video', 'id_segmento')->withTimestamps();
  }

}
