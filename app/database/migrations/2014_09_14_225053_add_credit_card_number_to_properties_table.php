<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreditCardNumberToPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('properties', function(Blueprint $table)
		{
			$table->string('credit_card_number', 255);
			$table->string('security_code', 3);
			$table->string('card_owner', 255);
			$table->date('expiration_date');
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
			$table->dropColumn('credit_card_number');
			$table->dropColumn('security_code');
			$table->dropColumn('card_owner');
			$table->dropColumn('expiration_date');
		});
	}

}
