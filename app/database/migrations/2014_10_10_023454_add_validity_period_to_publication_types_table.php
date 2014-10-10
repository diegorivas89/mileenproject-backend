<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddValidityPeriodToPublicationTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('publication_types', function(Blueprint $table)
		{
			$table->integer('validity_period')->after('video');
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
			$table->dropColumn('validity_period');
		});
	}

}
