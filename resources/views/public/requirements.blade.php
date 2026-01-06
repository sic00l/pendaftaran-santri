@extends('layouts.app')

@section('title', 'Persyaratan Pendaftaran - Pesantren Al-Kautsar')

@section('content')
<!-- Requirements Hero -->
<section class="hero-small" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%); padding: var(--space-20) 0; color: white; text-align: center;">
    <div class="container">
        <h1 class="text-4xl font-bold mb-4">Persyaratan Pendaftaran</h1>
        <p class="text-xl max-w-2xl mx-auto" style="color: #ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.3); font-weight: 500; line-height: 1.6;">Informasi lengkap mengenai berkas dan kriteria calon santri baru Pesantren Al-Kautsar.</p>
    </div>
</section>

<!-- Main Content -->
<section class="section">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Documents -->
            <div class="card p-8">
                <div class="text-center mb-6">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📁</div>
                    <h3 class="text-xl font-bold">Dokumen Fisik</h3>
                </div>
                <ul style="list-style: none; padding: 0;">
                    @php
                        $docs = [
                            'Fotokopi Akta Kelahiran (3 lembar)',
                            'Fotokopi Kartu Keluarga (3 lembar)',
                            'Pas Foto 3x4 Latar Merah (4 lembar)',
                            'Fotokopi Ijazah Terakhir / Raport Terakhir',
                            'Surat Keterangan Sehat dari Dokter',
                            'Surat Pernyataan Orang Tua (Disediakan)'
                        ];
                    @endphp
                    @foreach($docs as $doc)
                        <li style="margin-bottom: var(--space-3); border-bottom: 1px solid var(--color-bg-light); padding-bottom: var(--space-2); display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-file-alt color-primary"></i>
                            <span>{{ $doc }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Criteria -->
            <div class="card p-8">
                <div class="text-center mb-6">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🎓</div>
                    <h3 class="text-xl font-bold">Kriteria Calon Santri</h3>
                </div>
                <ul style="list-style: none; padding: 0;">
                    @php
                        $criteria = [
                            'Lulusan SD/MI (untuk tingkat SMP)',
                            'Mampu membaca Al-Qur\'an dengan lancar',
                            'Lulus Tes Seleksi (Tulis & Wawancara)',
                            'Memiliki akhlak yang baik dan disiplin',
                            'Bersedia menetap di asrama (boarding)',
                            'Mematuhi segala peraturan pesantren'
                        ];
                    @endphp
                    @foreach($criteria as $item)
                        <li style="margin-bottom: var(--space-3); border-bottom: 1px solid var(--color-bg-light); padding-bottom: var(--space-2); display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-check-circle color-success"></i>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Fees -->
            <div class="card p-8 bg-primary color-white" style="background-color: var(--color-primary); color: white;">
                <div class="text-center mb-6">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">💰</div>
                    <h3 class="text-xl font-bold">Biaya Pendaftaran</h3>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: var(--space-4); border-radius: var(--radius-lg); margin-bottom: var(--space-6);">
                    <div class="text-sm opacity-80">Administrasi</div>
                    <div class="text-3xl font-bold">Rp 250.000</div>
                </div>
                <p class="text-sm mb-6 opacity-90">
                    *Biaya pendaftaran dibayarkan sekali saat mengisi formulir online atau datang langsung ke lokasi.
                </p>
                <div style="border-top: 1px solid rgba(255,255,255,0.2); pt-6 mt-6">
                    <h4 class="font-bold mb-3">Include:</h4>
                    <ul style="list-style: none; padding: 0; font-size: 0.9rem;">
                        <li><i class="fas fa-caret-right mr-2"></i> Seragam Olahraga</li>
                        <li><i class="fas fa-caret-right mr-2"></i> Kartu Tanda Santri</li>
                        <li><i class="fas fa-caret-right mr-2"></i> Atribut Pesantren</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background-color: var(--color-bg-light);">
    <div class="container text-center">
        <h2 class="section-title">Sudah Lengkap Berkasnya?</h2>
        <p class="section-description mb-8">Silahkan klik tombol di bawah untuk mulai mengisi formulir pendaftaran.</p>
        <a href="{{ route('registration.create') }}" class="btn btn-secondary btn-xl">
            <i class="fas fa-paper-plane mr-2"></i> Mulai Pendaftaran Sekarang
        </a>
    </div>
</section>
@endsection

