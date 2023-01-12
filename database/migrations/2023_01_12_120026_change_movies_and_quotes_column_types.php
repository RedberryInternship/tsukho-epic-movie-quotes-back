<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::table('movies', function (Blueprint $table) {
			$table->text('description')->change();
		});

		Schema::table('quotes', function (Blueprint $table) {
			$table->text('quote')->change();
		});
	}

	public function down()
	{
		Schema::table('movies', function (Blueprint $table) {
			$table->string('description');
		});

		Schema::table('quotes', function (Blueprint $table) {
			$table->string('quote');
		});
	}
};
