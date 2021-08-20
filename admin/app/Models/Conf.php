<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $table = 'config';

    public $timestamps = false;

    protected $fillable = ['previsao_minutos', 'taxa_entrega', 'abertura', 'fechamento', 'status', 'contato'];
}
