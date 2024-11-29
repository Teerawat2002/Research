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
        Schema::create('proposes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // ชื่อหัวข้อที่นำเสนอ
            $table->text('objective'); // วัตถุประสงค์ของโครงการ
            $table->text('scope'); // ขอบเขตของโครงการ
            $table->text('tools')->nullable(); // ภาษาและเครื่องมือที่ใช้
            $table->string('group_id')->nullable();
            $table->string('type_id')->nullable();
            $table->string('status')->default(1);
            $table->text('comments')->nullable(); // ความเห็นของอาจารย์ที่ปรึกษา
            $table->string('a_id')->nullable(); // ชื่ออาจารย์ที่ปรึกษา
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposes');
    }
};
