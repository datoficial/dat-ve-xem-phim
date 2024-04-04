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
        Schema::create('phongchieu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rapchieu_id')->constrained('rapchieu');
            $table->string('tenphong');
            $table->string('tenphong_slug');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phong_chieus');
    }
};
