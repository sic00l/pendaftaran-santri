@extends('layouts.app')

@section('title', 'Login Santri')

@section('content')
<div class="login-page py-20 flex items-center justify-center min-h-[60vh]">
    <div class="card w-full max-w-md">
        <div class="card-header border-b text-center">
            <h2 class="card-title text-2xl">Dashboard Santri</h2>
            <p class="text-gray-500">Masuk untuk mengecek status pendaftaran Anda</p>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-error mb-4">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('santri.login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Pendaftaran / Nomor Daftar</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-id-card input-icon"></i>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Email atau PPDB-2024-XXXXXX" required autofocus>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Gunakan email yang Anda gunakan saat mendaftar.</p>
                </div>

                <div class="form-group">
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="form-label mb-0">Password</label>
                    </div>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Default password: <strong>santri123</strong> (kecuali sudah diubah).</p>
                </div>

                <button type="submit" class="btn btn-primary w-full py-3 text-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Dashboard
                </button>
                
                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-500">Belum punya akun?</p>
                    <a href="{{ route('registration.create') }}" class="text-primary font-bold hover:underline">Daftar Sekarang</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
