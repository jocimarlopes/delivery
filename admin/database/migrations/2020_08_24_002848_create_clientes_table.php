<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 50);
			$table->string('cpf', 20);
			$table->string('telefone', 20);
			$table->string('email', 50);
			$table->string('rua', 100);
			$table->string('numero', 20);
			$table->string('bairro', 50);
			$table->string('cidade', 50);
			$table->string('estado', 5);
			$table->string('cep', 20);
			$table->integer('cartao');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clientes');
	}

}
