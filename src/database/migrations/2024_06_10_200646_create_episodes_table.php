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
		Schema::create('episodes', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->integer('number');
			$table->foreignId('season_id')->constrained('seasons', 'id')->onDelete('cascade');
			$table->boolean('watched')->default(false);
			$table->timestamps();
			$table->unique(['season_id', 'number']); // Adiciona a restrição de índice único composto
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('episodes');
	}
};
