<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoCategoria extends Model
{
    use SoftDeletes;
    protected $table = 'produto_categorias';
    protected $fillable = ['name', 'image'];
    public function produtos() {
        return $this->hasMany('App\Models\Produto');
    }
}