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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategoribarang')->constrained('categories')->onDelete('cascade');
            $table->foreignId('supplierbarang')->constrained('suppliers')->onDelete('cascade');
            $table->string('namabarang');
            $table->unsignedBigInteger('hargabarang');
            $table->unsignedBigInteger('jumlahbarang');
            $table->string('fotobarang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
