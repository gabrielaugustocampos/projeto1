<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailModel extends Model
{
    protected $nome = '';
    protected $email = '';
    protected $telefone = '';
    protected $mensagem = '';
}
