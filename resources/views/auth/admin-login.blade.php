@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<div class="login-page py-20 flex items-center justify-center min-h-[60vh]">
    <div class="card w-full max-w-md">
        <div class="card-header border-b text-center">
            <h2 class="card-title text-2xl">Admin Panel</h2>
            <p class="text-gray-500">Silakan login untuk mengelola pendaftaran</p>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-error mb-4">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="role" value="admin">
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control" placeholder="admin@example.com" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="form-label mb-0">Password</label>
                        <a href="#" class="text-xs text-primary hover:underline">Lupa password?</a>
                    </div>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-primary">
                        <span class="text-sm text-gray-600">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-full py-3 text-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
