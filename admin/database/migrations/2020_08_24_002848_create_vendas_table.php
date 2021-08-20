<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('cliente', 20);
			$table->decimal('total');
			$table->decimal('total_pago');
			$table->decimal('troco');
			$table->string('tipo_pgto', 30);
			$table->date('data');
			$table->time('hora');
			$table->string('status', 25);
			$table->string('pago', 5);
			$table->string('obs', 350)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vendas');
	}

}
