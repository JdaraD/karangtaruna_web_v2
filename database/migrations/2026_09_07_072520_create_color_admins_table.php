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
        Schema::create('color_admins', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(1);
            $table->string('warna_header');
            $table->string('warna_sidebar');
            $table->string('warna_main');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_admins');
    }
};
