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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(1);
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->foreignId('kategori_usaha_id')->constrained('kategori_usahas')->cascadeOnDelete();
            $table->integer('harga')->default(0);
            $table->string('link-pembelian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
