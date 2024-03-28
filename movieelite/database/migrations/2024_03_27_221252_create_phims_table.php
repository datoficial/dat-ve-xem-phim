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
        Schema::create('phim', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theloaiphim_id')->constrained('theloaiphim');
            $table->string('tenphim');
            $table->string('tenphim_slug');
            $table->integer('gioihantuoi');
            $table->string('quocgia');
            $table->text('mota')->nullable();
            $table->text('trailler')->nullable();
            $table->string('trangthai');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phims');
    }
};
