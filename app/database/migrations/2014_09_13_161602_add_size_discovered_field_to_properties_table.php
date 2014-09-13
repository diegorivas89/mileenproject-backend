<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSizeDiscoveredFieldToPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('properties', function(Blueprint $table)
		{
			$table->integer('size_discovered')->after('size');
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