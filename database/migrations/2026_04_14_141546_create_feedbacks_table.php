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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->enum('category', ['pembelajaran', 'fasilitas', 'pelayanan_administrasi', 'lainnya'])->default('lainnya');
            $table->enum('type', ['saran', 'kritik', 'pujian'])->default('saran');
            $table->text('message');
            $table->enum('status', ['pending', 'read', 'replied'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
