<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDateRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('date_ranges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->integer('positive_offset');
			$table->integer('negative_offset');
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
		Schema::drop('date_ranges');
	}

}
