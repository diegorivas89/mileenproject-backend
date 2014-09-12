<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVideoFieldToPublicationTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('publication_types', function(Blueprint $table)
		{
			$table->boolean('video')->after('images');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('publication_types', function(Blueprint $table)
		{
			$table->dropColumn('video');
		});
	}

}
