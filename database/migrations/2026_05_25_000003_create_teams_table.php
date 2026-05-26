<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained()->cascadeOnDelete();
            $table->string('registration_code', 20)->unique();
            $table->string('team_name');
            $table->string('school_name');
            $table->string('instagram')->nullable();
            $table->string('leader_email');
            $table->string('leader_phone', 20);
            $table->string('student_card_path')->nullable();
            $table->string('twibbon_path')->nullable();
            $table->string('payment_proof_path')->nullable();
            $table->string('status', 30)->default('pending_payment');
            $table->unsignedInteger('queue_position')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index(['competition_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
