<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('seasons', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->integer('number');
			$table->foreignId('serie_id')->constrained('series', 'id')->onDelete('cascade');
			$table->timestamps();
			$table->unique(['serie_id', 'number']); // Adiciona a restrição de índice único composto
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::disableForeignKeyConstraints();
		Schema::dropIfExists('seasons');
		Schema::enableForeignKeyConstraints();
	}
};
