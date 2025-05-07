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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained();
            
           
            $table->string('candidate_name');
            $table->string('candidate_email');
            $table->string('candidate_phone');
            
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('temporary_password')->nullable();
            $table->text('img')->nullable();
            $table->text('signature')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->string('payment_status')->default('pending')->comment('pending,success,failed');
            $table->string('applicant_status')->default('pending')->comment('pending,approved,rejected');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
