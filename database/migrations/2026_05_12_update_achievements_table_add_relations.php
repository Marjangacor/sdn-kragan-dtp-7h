<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('cascade')->after('id');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('cascade')->after('student_id');
        });
    }

    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropForeignIdFor('students');
            $table->dropForeignIdFor('teachers');
        });
    }
};
