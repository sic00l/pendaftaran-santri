@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="error-page py-20 flex items-center justify-center min-h-[70vh] text-center">
    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto">
            <h1 class="text-9xl font-extrabold text-primary opacity-20 mb-[-4rem]">404</h1>
            <div class="relative z-10">
                <h2 class="text-3xl font-bold mb-4">Ups! Halaman Tidak Ditemukan</h2>
                <p class="text-gray-500 text-lg mb-8">
                    Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline">
                        <i class="fas fa-headset mr-2"></i> Hubungi Bantuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
