@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran')

@section('content')
<div class="status-check-page py-20 bg-gray-50 min-h-[70vh]">
    <div class="container mx-auto px-4">
        <div class="max-w-xl mx-auto">
            <div class="card shadow-lg">
                <div class="card-header border-b text-center bg-white p-8">
                    <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4 text-primary text-2xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2 class="card-title text-2xl">Cek Status Pendaftaran</h2>
                    <p class="text-gray-500">Masukkan nomor pendaftaran atau NIK Anda</p>
                </div>
                <div class="card-body p-8">
                    <form id="form-status-check">
                        <div class="form-group">
                            <label for="search" class="form-label font-bold">Nomor Pendaftaran / NIK</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-id-card input-icon"></i>
                                <input type="text" id="search" name="search" class="form-control" placeholder="PPDB-2024-XXXXXX atau 16 digit NIK" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-full py-3 text-lg" id="btn-check">
                            <span class="btn-text">Cek Status Sekarang</span>
                        </button>
                    </form>

                    <!-- Result Section (Hidden by default) -->
                    <div id="status-result" class="mt-8 hidden">
                        <hr class="mb-8">
                        <div id="result-content" class="space-y-6">
                            <!-- Dynamically loaded -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-500">Lupa nomor pendaftaran? <a href="{{ route('contact') }}" class="text-primary hover:underline">Hubungi kami</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('form-status-check').addEventListener('submit', async function(e) {
        e.preventDefault();
        const search = document.getElementById('search').value;
        const btn = document.getElementById('btn-check');
        const resultDiv = document.getElementById('status-result');
        const resultContent = document.getElementById('result-content');

        // Show loading
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mencari...';

        try {
            // In a real app, this would be an AJAX call
            // For now, let's simulate it or redirect to a status page if we have one
            // But since we want it interactive, we'll use a dummy response for now
            // Unless we implement the API endpoint
            
            // Simulating API call
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = 'Cek Status Sekarang';
                
                resultDiv.classList.remove('hidden');
                resultContent.innerHTML = `
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Memproses Pencarian...</h4>
                            <p class="text-sm text-gray-500">Mohon tunggu sebentar, sistem sedang memverifikasi data Anda.</p>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <p>Silakan <a href="{{ route('santri.login') }}" class="font-bold underline">Login ke Dashboard</a> untuk melihat detail lengkap pendaftaran Anda.</p>
                    </div>
                `;
            }, 1000);

        } catch (error) {
            console.error(error);
            alert('Terjadi kesalahan saat mengecek status.');
            btn.disabled = false;
            btn.innerHTML = 'Cek Status Sekarang';
        }
    });
</script>
@endpush
