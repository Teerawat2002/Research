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
        Schema::create('advisors', function (Blueprint $table) {
            $table->id();
            $table->integer('a_id')->unique(); // รหัสอาจารย์
            $table->string('a_fname');
            $table->string('a_lname');
            $table->string('a_password');
            $table->string('status');
            $table->string('a_type');
            $table->string('m_id'); // สาขา
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisors');
    }
};
