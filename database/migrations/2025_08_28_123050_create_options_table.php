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
        Schema::create('options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('question_id')
                ->constrained('questions')
                ->cascadeOnDelete();

            // label como 'a', 'b', 'c', 'd' (ou 1,2,3... se preferir)
            $table->string('label', 8)->nullable();

            // Texto da alternativa (Markdown)
            $table->text('text_md');

            // Opcional: bloco de código específico da alternativa
            $table->longText('code_snippet')->nullable();

            // Marcação de corretude
            $table->boolean('is_correct')->default(false);

            // Campo para controlar ordenação explícita (quando label não for suficiente)
            $table->unsignedSmallInteger('position')->nullable();

            $table->timestamps();

            // Garantir que não existam labels duplicadas dentro da mesma questão
            $table->unique(['question_id', 'label']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
