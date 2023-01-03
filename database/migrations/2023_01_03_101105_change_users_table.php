<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('email');
			$table->dropColumn('email_verified_at');
			$table->dropColumn('password');
			$table->string('password')->nullable();
			$table->string('image');
			$table->string('google_id')->nullable();
		});
	}

	public function down()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->string('email')->unique();
			$table->string('email_verified_at')->nullable();
			$table->string('password');
			$table->dropColumn('password');
			$table->dropColumn('image');
			$table->dropColumn('google_id');
		});
	}
};
