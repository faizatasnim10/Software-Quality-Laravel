<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{

    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            // Primary key - auto-incrementing ID
            $table->id();                    // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            
            // Student information fields
            $table->string('name');          // VARCHAR(255) - student's full name
            $table->string('email')->unique(); // VARCHAR(255) with UNIQUE constraint
            $table->string('major');         // VARCHAR(255) - student's major/subject
            $table->integer('year');         // INT - academic year (1-4)
            
            // Automatic timestamp fields
            $table->timestamps();            // created_at and updated_at TIMESTAMP fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
