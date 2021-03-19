<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paginas extends Model
{
  protected $table = 'tb_texto';
  protected $primaryKey = 'id_texto';

  public function gallery() {

    return $this->hasMany('App\Fotos', 'localizacao', 'galeria');

  }


  public function icones()
  {
      return $this->hasMany('App\Icone', 'id_texto');
  }

  public function saveIcons($icons = array()){

    foreach ($icons as $icon) {

      isset($icon['id']) ?
       $this->icones()->where('id', $icon['id'])->update($icon):
       $this->icones()->create($icon);

    }
  }

  public function categorias() {
    return $this->belongsToMany('App\Categoria', 'tb_categorias_tb_texto', 'id_texto_cat', 'id_categoria')->withTimestamps();
  }
}
