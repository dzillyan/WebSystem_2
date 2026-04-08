<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();           // Field 1
            $table->string('first_name');                      // Field 2
            $table->string('last_name');                       // Field 3
            $table->string('middle_name')->nullable();         // Field 4
            $table->string('email')->unique();                 // Field 5
            $table->string('password');
            $table->string('phone_number');                    // Field 6
            $table->date('date_of_birth');                     // Field 7
            $table->enum('gender', ['Male', 'Female', 'Other']); // Field 8
            $table->text('address');                           // Field 9
            $table->string('city');                            // Field 10
            $table->string('province');                        // Field 11
            $table->string('zip_code');                        // Field 12
            $table->string('course');                          // Field 13
            $table->string('year_level');                      // Field 14
            $table->string('guardian_name')->nullable();       // Field 15
            $table->string('guardian_contact')->nullable();    // Field 16
            $table->string('profile_photo')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};