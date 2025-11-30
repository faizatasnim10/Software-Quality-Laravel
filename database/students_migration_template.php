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
        Schema::create('students', function (Blueprint $table) {
            $table->id();                    // Primary key (auto-increment)
            $table->string('name');          // Student name
            $table->string('email')->unique(); // Student email (must be unique)
            $table->string('major');         // Academic major
            $table->integer('year');         // Academic year (1-4)
            $table->timestamps();            // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};