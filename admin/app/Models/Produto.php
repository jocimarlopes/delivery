<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    public $timestamps = false;

    protected $fillable = ['id', 'nome', 'valor', 'descricao','descricao_longa', 'produto_categoria_id', 'estoque', 'image'];

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if ($filter) {
                $query->where('nome', 'LIKE', "%{$filter}%");
            }
        })//->toSql();
        ->paginate();

        return $results;
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\ProdutoCategoria', 'produto_categoria_id')->withTrashed();
    }

    public function pedidos()
    {
        return $this->belongsToMany(Car::class);
    }

    public function car() {
        return $this->belongsToMany(Car::class);
    }


}
