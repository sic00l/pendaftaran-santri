@extends('layouts.app')

@section('title', 'Dashboard Santri')

@section('content')
<div class="dashboard-page bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4">
        <!-- Welcome Header -->
        <div class="card mb-8 shadow-sm">
            <div class="card-body p-8 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-primary-light">
                        <img src="{{ Auth::guard('santri')->user()->foto_url ?? '/img/avatar-default.png' }}" alt="Foto Profile" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Assalamu'alaikum, {{ Auth::guard('santri')->user()->nama_lengkap }}</h1>
                        <p class="text-gray-500">Nomor Pendaftaran: <span class="font-mono font-bold text-primary">{{ Auth::guard('santri')->user()->nomor_pendaftaran }}</span></p>
                    </div>
                </div>
                <div>
                    {!! Auth::guard('santri')->user()->status_badge !!}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Status & Steps -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Status Timeline -->
                <div class="card">
                    <div class="card-header border-b">
                        <h3 class="card-title">Progress Pendaftaran</h3>
                    </div>
                    <div class="card-body p-8">
                        <div class="status-timeline">
                            @php
                                $status = Auth::guard('santri')->user()->status;
                                $steps = [
                                    'pending' => ['label' => 'Mendaftar', 'icon' => 'fa-edit'],
                                    'verified' => ['label' => 'Verifikasi Berkas', 'icon' => 'fa-check-double'],
                                    'accepted' => ['label' => 'Diterima', 'icon' => 'fa-user-graduate'],
                                ];
                                $currentStep = 1;
                                if ($status == 'verified') $currentStep = 2;
                                if ($status == 'accepted') $currentStep = 3;
                            @endphp

                            @foreach($steps as $key => $step)
                            <div class="timeline-item {{ $loop->iteration <= $currentStep ? 'active' : '' }}">
                                <div class="timeline-icon">
                                    <i class="fas {{ $step['icon'] }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4 class="font-bold">{{ $step['label'] }}</h4>
                                    <p class="text-xs text-gray-500">
                                        @if($loop->iteration < $currentStep)
                                            Selesai
                                        @elseif($loop->iteration == $currentStep)
                                            Sedang Berjalan
                                        @else
                                            Belum Dimulai
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="card">
                    <div class="card-header border-b flex justify-between items-center">
                        <h3 class="card-title">Data Diri</h3>
                        <a href="{{ route('santri.profile') }}" class="btn btn-sm btn-outline">Ubah Data</a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-fixed">
                            <tbody>
                                <tr>
                                    <td class="bg-gray-50 font-medium w-1/3">NIK</td>
                                    <td>{{ Auth::guard('santri')->user()->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray-50 font-medium font-medium">Tempat, Tanggal Lahir</td>
                                    <td>{{ Auth::guard('santri')->user()->tempat_lahir }}, {{ Auth::guard('santri')->user()->tanggal_lahir->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray-50 font-medium">Jenis Kelamin</td>
                                    <td>{{ Auth::guard('santri')->user()->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray-50 font-medium">Asal Sekolah</td>
                                    <td>{{ Auth::guard('santri')->user()->asal_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-gray-50 font-medium text-top">Alamat</td>
                                    <td>{{ Auth::guard('santri')->user()->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Quick Actions & Sidebar Info -->
            <div class="space-y-8">
                <!-- Rejection Reason if any -->
                @if($status == 'rejected')
                <div class="alert alert-error">
                    <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="alert-content">
                        <h4 class="font-bold">Pendaftaran Ditolak</h4>
                        <p class="text-sm">{{ Auth::guard('santri')->user()->rejection_reason }}</p>
                    </div>
                </div>
                @endif

                <!-- Payment Info -->
                <div class="card bg-primary text-white overflow-hidden">
                    <div class="card-body p-8 relative">
                        <i class="fas fa-wallet absolute -right-4 -bottom-4 text-8xl opacity-10"></i>
                        <h3 class="text-xl font-bold mb-2">Informasi Pembayaran</h3>
                        <p class="text-primary-100 text-sm mb-6">Silakan lakukan pembayaran biaya pendaftaran untuk melanjutkan proses verifikasi.</p>
                        <div class="bg-white/10 rounded-lg p-4 mb-6">
                            <span class="text-xs uppercase tracking-wider block mb-1">Nominal</span>
                            <span class="text-2xl font-bold">Rp 250.000</span>
                        </div>
                        <button class="btn btn-secondary w-full py-3">Unggah Bukti Bayar</button>
                    </div>
                </div>

                <!-- Documents Status -->
                <div class="card">
                    <div class="card-header border-b">
                        <h3 class="card-title">Berkas Terunggah</h3>
                    </div>
                    <div class="card-body p-6">
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                <i class="fas {{ Auth::guard('santri')->user()->foto ? 'fa-check-circle text-success' : 'fa-times-circle text-gray-300' }}"></i>
                                <span class="text-sm">Pas Foto 3x4</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas {{ Auth::guard('santri')->user()->ijazah ? 'fa-check-circle text-success' : 'fa-times-circle text-gray-300' }}"></i>
                                <span class="text-sm">Ijazah / SKL</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas {{ Auth::guard('santri')->user()->akta ? 'fa-check-circle text-success' : 'fa-times-circle text-gray-300' }}"></i>
                                <span class="text-sm">Akta Kelahiran</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
