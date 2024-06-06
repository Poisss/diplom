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
            $table->text('question');
            $table->string('image')->nullable();
            $table->string('comment')->nullable();
            $table->enum('required',['1','0'])->default('0');
            $table->enum('type', ['title','text','text_short','text_long','checkbox',
            'radio','email','data','select','agreement']);
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
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
