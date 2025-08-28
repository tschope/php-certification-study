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
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('quiz_session_id');
            $table->unsignedBigInteger('question_id');
            $table->json('selected_labels');
            $table->boolean('is_correct');
            $table->timestamp('answered_at');
            $table->timestamps();

            $table->foreign('quiz_session_id')->references('id')->on('quiz_sessions')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->unique(['quiz_session_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
    }
};
