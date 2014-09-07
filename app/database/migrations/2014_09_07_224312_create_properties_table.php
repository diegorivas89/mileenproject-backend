<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('property_type_id');
			$table->integer('environment_id');
			$table->string('title', 128);
			$table->longText('description');
			$table->string('address', 256);
			$table->float('latitude');
			$table->float('longitude');
			$table->string('currency', 5);
			$table->integer('price');
			$table->integer('expenses');
			$table->integer('age');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('properties');
	}

}
