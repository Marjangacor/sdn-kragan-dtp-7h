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
        Schema::create('spmb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('student_email');
            $table->date('student_birthdate');
            $table->text('student_address');
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('parent_email')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmb_registrations');
    }
};
