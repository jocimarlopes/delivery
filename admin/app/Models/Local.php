<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locais'; 

    public $timestamps = false;  

    protected $fillable = ['id', 'nome', 'valor'];

}
