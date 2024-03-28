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
        Schema::create('chi_tiet_ve', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ve_id')->constrained('ve');
            $table->date('ngayban');
            $table->string('tenghe');
            $table->integer('soluong');
            $table->double('giave');
            $table->timestamps();
            $table->engine = 'InnoDB';
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_ves');
    }
};
