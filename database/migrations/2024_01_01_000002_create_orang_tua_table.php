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
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            
            // Data Ayah
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            
            // Data Ibu
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            
            // Kontak
            $table->string('no_hp_orangtua', 15);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};
