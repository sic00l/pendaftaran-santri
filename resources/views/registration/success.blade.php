@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="registration-success-page py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <div class="success-icon-wrapper mb-8 animate-bounce">
                <div class="w-24 h-24 bg-success rounded-full flex items-center justify-center mx-auto text-white text-5xl">
                    <i class="fas fa-check"></i>
                </div>
            </div>
            
            <h1 class="text-4xl font-bold mb-4">Pendaftaran Berhasil!</h1>
            <p class="text-gray-600 text-lg mb-8">
                Alhamdulillah, data pendaftaran Anda telah berhasil kami terima. Silakan simpan nomor pendaftaran di bawah ini untuk mengecek status pendaftaran Anda secara berkala.
            </p>

            <div class="card bg-gray-50 border-2 border-dashed border-primary mb-8">
                <div class="card-body p-8">
                    <span class="text-sm text-gray-500 uppercase tracking-widest block mb-2">Nomor Pendaftaran</span>
                    <h2 class="text-3xl font-mono font-bold text-primary">{{ $santri->nomor_pendaftaran }}</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
                <div class="card text-left">
                    <div class="card-body">
                        <h3 class="font-bold mb-2"><i class="fas fa-print mr-2 text-primary"></i> Cetak Kartu</h3>
                        <p class="text-sm text-gray-500 mb-4">Cetak kartu pendaftaran sebagai bukti fisik saat verifikasi dokumen.</p>
                        <button class="btn btn-outline btn-sm w-full">Cetak PDF</button>
                    </div>
                </div>
                <div class="card text-left">
                    <div class="card-body">
                        <h3 class="font-bold mb-2"><i class="fas fa-search-dollar mr-2 text-primary"></i> Cek Status</h3>
                        <p class="text-sm text-gray-500 mb-4">Gunakan nomor pendaftaran untuk mengecek progress verifikasi admin.</p>
                        <a href="{{ route('status.check') }}" class="btn btn-primary btn-sm w-full">Cek Status</a>
                    </div>
                </div>
            </div>

            <div class="alert alert-info text-left">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-content">
                    <h4 class="font-bold">Langkah Selanjutnya:</h4>
                    <ol class="list-decimal list-inside text-sm space-y-1">
                        <li>Bergabung ke grup WhatsApp calon santri (Link dikirim ke email).</li>
                        <li>Melakukan pembayaran biaya pendaftaran sebesar Rp 250.000.</li>
                        <li>Mengunggah bukti pembayaran di halaman dashboard santri.</li>
                        <li>Menunggu jadwal tes seleksi online/offline.</li>
                    </ol>
                </div>
            </div>

            <div class="mt-12">
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
