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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            
            // Detail Pembayaran
            $table->string('jenis_pembayaran')->default('Pendaftaran'); // Pendaftaran, SPP, dll
            $table->decimal('jumlah', 12, 2);
            $table->date('tanggal_bayar')->nullable();
            
            // Bukti Transfer
            $table->string('bukti_transfer')->nullable();
            $table->string('nama_pengirim')->nullable();
            $table->string('bank_pengirim')->nullable();
            
            // Status
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users');
            
            $table->timestamps();
            
            // Indexes
            $table->index('status');
            $table->index('tanggal_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
