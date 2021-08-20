<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'vendas';

    public $timestamps = false;

    protected $fillable = ['nome_cliente', 'total', 'total_pago', 'troco', 'tipo_pgto', 'data', 'hora', 'status', 'pago', 'obs'];

    public function carrinho()
    {
        return $this->hasMany(Car::class, 'id_venda', 'id');
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'id_produto', 'id');
    }
}

