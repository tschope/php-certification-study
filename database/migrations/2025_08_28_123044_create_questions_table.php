<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            // Texto principal da questão (Markdown)
            $table->string('title')->nullable();
            $table->longText('body_md');

            // Bloco de código opcional embutido na questão
            $table->longText('code_snippet')->nullable();

            // Marcação se a questão aceita múltiplas respostas corretas (ex.: "Choose 2")
            $table->boolean('multiple_correct')->default(false);

            // Explicação/justificativa oficial da resposta (Markdown)
            $table->longText('explanation_md')->nullable();

            // Metadados úteis
            $table->enum('difficulty', ['easy','medium','hard'])->nullable();
            $table->string('category')->nullable();
            $table->string('source')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
