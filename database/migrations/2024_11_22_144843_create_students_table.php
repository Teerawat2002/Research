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
            $table->id();
            $table->integer('s_id')->unique(); // รหัสนักศึกษา
            $table->string('s_fname');
            $table->string('s_lname');
            $table->string('s_password');
            $table->string('status');
            $table->string('m_id'); // สาขา
            $table->string('ac_id'); // ปีการศึกษา
            $table->timestamps();
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
