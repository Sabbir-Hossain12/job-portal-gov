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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_desc');
            $table->longText('long_desc');
            $table->text('img')->nullable();
            $table->date('deadline')->nullable();
            $table->longText('additional_text')->nullable();
            $table->date('exam_date')->nullable();
            $table->string('exam_time')->nullable();
            $table->longText('exam_instructions')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
