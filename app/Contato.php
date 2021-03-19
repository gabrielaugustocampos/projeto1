<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
           /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tb_contatos';
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var array
     */
    protected $fillable = ['id', 'nome', 'email', 'telefone', 'texto', 'localizacao', 'created_at', 'updated_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
}
