@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="stats-grid">
    <div class="card card-stat">
        <div class="card-stat-icon bg-primary-light">
            <i class="fas fa-users text-primary"></i>
        </div>
        <div class="card-stat-info">
            <h3 class="card-stat-value">{{ \App\Models\Santri::count() }}</h3>
            <p class="card-stat-label">Total Pendaftar</p>
        </div>
    </div>

    <div class="card card-stat">
        <div class="card-stat-icon bg-warning-light">
            <i class="fas fa-clock text-warning"></i>
        </div>
        <div class="card-stat-info">
            <h3 class="card-stat-value">{{ \App\Models\Santri::status('pending')->count() }}</h3>
            <p class="card-stat-label">Pending Verifikasi</p>
        </div>
    </div>

    <div class="card card-stat">
        <div class="card-stat-icon bg-success-light">
            <i class="fas fa-check-circle text-success"></i>
        </div>
        <div class="card-stat-info">
            <h3 class="card-stat-value">{{ \App\Models\Santri::status('verified')->count() }}</h3>
            <p class="card-stat-label">Terverifikasi</p>
        </div>
    </div>

    <div class="card card-stat">
        <div class="card-stat-icon bg-info-light">
            <i class="fas fa-user-graduate text-info"></i>
        </div>
        <div class="card-stat-info">
            <h3 class="card-stat-value">{{ \App\Models\Santri::status('accepted')->count() }}</h3>
            <p class="card-stat-label">Santri Diterima</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pendaftaran Terbaru</h3>
            <a href="{{ route('admin.santri.index') }}" class="btn btn-sm btn-outline">Lihat Semua</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Santri::latest()->take(5)->get() as $santri)
                        <tr>
                            <td>{{ $santri->nomor_pendaftaran }}</td>
                            <td>{{ $santri->nama_lengkap }}</td>
                            <td>{!! $santri->status_badge !!}</td>
                            <td>{{ $santri->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Statistik Gelombang</h3>
        </div>
        <div class="card-body">
            @for($i = 1; $i <= 4; $i++)
            <div class="mb-4">
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-medium">Gelombang {{ $i }}</span>
                    <span class="text-sm text-gray-500">{{ \App\Models\Santri::gelombang($i)->count() }} Santri</span>
                </div>
                <div class="progress progress-sm">
                    @php 
                        $total = \App\Models\Santri::count();
                        $percent = $total > 0 ? (\App\Models\Santri::gelombang($i)->count() / $total) * 100 : 0;
                    @endphp
                    <div class="progress-bar" style="width: {{ $percent }}%"></div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection
