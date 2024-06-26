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
        Schema::create('ve', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('suatchieu_id')->constrained('suatchieu');
            $table->date('ngayban');
            $table->string('tenghe');
            $table->integer('soluong');
            $table->double('giave');
            $table->string('qrcode');
            $table->timestamps();
            $table->engine = 'InnoDB';
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ves');
    }
};
