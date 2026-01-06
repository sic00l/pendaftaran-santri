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
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftaran', 20)->unique();
            $table->string('password');
            
            // Data Diri
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nik', 16)->unique();
            $table->text('alamat');
            
            // Kontak
            $table->string('email')->unique();
            $table->string('no_hp', 15);
            
            // Pendidikan
            $table->string('asal_sekolah');
            $table->decimal('nilai_rata', 4, 2);
            
            // File Upload
            $table->string('foto')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('akta')->nullable();
            
            // Status dan Tanggal
            $table->enum('status', ['pending', 'verified', 'rejected', 'accepted'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            
            // Gelombang & Tahun
            $table->integer('gelombang')->default(1);
            $table->year('tahun_ajaran');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('status');
            $table->index('gelombang');
            $table->index('tahun_ajaran');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri');
    }
};
