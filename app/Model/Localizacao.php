<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    protected $table = 'tb_localizacao_texto';
    protected $primaryKey = 'id_localizacao_texto';

    protected $fillable = ['nome', 'excluido', 'created_at', 'updated_at'];


    public function paginas(){
        return $this->hasMany('App\Paginas', 'localizacao');
    }
}
