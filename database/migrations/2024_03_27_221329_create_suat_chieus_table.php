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
        Schema::create('suatchieu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phongchieu_id')->constrained('phongchieu');
            $table->foreignId('phim_id')->constrained('phim');
            $table->date('ngaychieu');
            $table->time('giobatdau');
            $table->time('gioketthuc');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suat_chieus');
    }
};
