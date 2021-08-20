<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrinhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carrinho', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_venda');
			$table->integer('id_produto');
			$table->string('cpf', 20);
            $table->integer('quantidade');

            $table->foreign('id_produto')->references('id')->on('produtos');
            $table->foreign('id_venda')->references('id')->on('vendas');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carrinho');
	}

}
