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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->integer('vacancy')->nullable();
            $table->text('vacancy_desc')->nullable();
            $table->text('qualifications')->nullable();
            $table->integer('minimum_age')->nullable();
            $table->string('salary');
            $table->text('exam_center')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
