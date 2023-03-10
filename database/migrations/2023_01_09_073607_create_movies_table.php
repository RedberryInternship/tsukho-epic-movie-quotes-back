<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('movies', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->cascadeOnDelete();
			$table->string('name');
			$table->string('tags');
			$table->string('director');
			$table->string('description');
			$table->string('image');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('movies');
	}
};
