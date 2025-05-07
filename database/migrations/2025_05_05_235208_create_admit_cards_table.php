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
        Schema::create('admit_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->nullable()->constrained();
            $table->foreignId('position_id')->nullable()->constrained();
            
            $table->foreignId('job_application_id')->constrained()->onDelete('cascade');
            $table->string('role_number');
            $table->string('candidateID)')->nullable();
            $table->string('systemID')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admit_cards');
    }
};
