<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('nome', 50); 
			$table->string('descricao', 50);
			$table->string('descricao_longa', 600);
			$table->unsignedBigInteger('produto_categoria_id');
			$table->unsignedinteger('estoque')->default(0);
			$table->decimal('valor', 10, 2);
			$table->string('image', 100); 
			$table->string('nome_url', 50);
			$table->timestamps();
            $table->softDeletes();
			$table->foreign('produto_categoria_id')->references('id')->on('produto_categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
