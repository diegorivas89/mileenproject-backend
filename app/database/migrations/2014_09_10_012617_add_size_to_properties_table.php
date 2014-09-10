<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSizeToPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('properties', function(Blueprint $table)
		{
			$table->integer('size')->after('environment_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('properties', function(Blueprint $table)
		{
			$table->dropColumn('size');
		});
	}

}
