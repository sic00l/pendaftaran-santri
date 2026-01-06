@extends('layouts.app')

@section('title', 'Pendaftaran Santri Baru 2026/2027')
@section('meta_description', 'Daftarkan putra-putri Anda di Pesantren Al-Kautsar. Pendidikan Islam terpadu dengan fasilitas modern dan tenaga pengajar berkualitas.')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    Pendaftaran Santri Baru<br>
                    Tahun Ajaran 2026/2027
                </h1>
                <p class="hero-subtitle">
                    Bergabunglah dengan ribuan santri yang telah meraih prestasi gemilang. 
                    Pendidikan Islam berkualitas dengan metode modern dan fasilitas terbaik.
                </p>
                <div class="hero-cta">
                    <a href="{{ route('registration.create') }}" class="btn btn-secondary btn-xl">
                        <i class="fas fa-edit"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('status.check') }}" class="btn btn-outline btn-xl" style="color: white; border-color: white;">
                        <i class="fas fa-search"></i> Cek Status
                    </a>
                </div>

                <!-- Countdown Timer -->
                <div class="mt-8">
                    <p class="text-white text-sm mb-2">🕐 Pendaftaran Gelombang 1 berakhir dalam:</p>
                    <div id="countdown-timer"></div>
                </div>
            </div>

            <!-- Hero Image with Smart Text Patching -->
            <div class="hero-image" style="position: relative; overflow: hidden; border-radius: 20px;">
                <img src="/img/hero-santri.jpg" alt="Santri Belajar" loading="lazy" style="width: 100%; height: auto; display: block;">
                
                <!-- Solid Gradient Mask to COMPLETELY Hide Old Text -->
                <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 50%; background: linear-gradient(to top, #ffffff 50%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%); z-index: 1;"></div>
                
                <!-- New Overlay Text to Replace Al-Hikmah -->
                <div style="position: absolute; bottom: 30px; left: 0; right: 0; text-align: center; z-index: 2; padding: 20px;">
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 800; color: #064e3b; margin: 0;">PESANTREN</h2>
                    <h1 style="font-family: 'Playfair Display', serif; font-size: 3.5rem; font-weight: 900; color: #d4af37; text-shadow: 1px 1px 0 #064e3b; margin: -5px 0 0 0; letter-spacing: 2px;">AL-KAUTSAR</h1>
                    <p style="font-size: 1.2rem; font-weight: 600; color: #064e3b; margin-top: 5px;">Mencetak Generasi Qur'ani Berakhlak Mulia</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="card card-stats">
                <div class="card-stats-icon">📚</div>
                <div class="card-stats-value">500+</div>
                <div class="card-stats-label">Total Santri</div>
            </div>
            <div class="card card-stats">
                <div class="card-stats-icon">🏆</div>
                <div class="card-stats-value">A</div>
                <div class="card-stats-label">Akreditasi</div>
            </div>
            <div class="card card-stats">
                <div class="card-stats-icon">👨‍🏫</div>
                <div class="card-stats-value">50+</div>
                <div class="card-stats-label">Tenaga Pengajar</div>
            </div>
            <div class="card card-stats">
                <div class="card-stats-icon">🌍</div>
                <div class="card-stats-value">95%</div>
                <div class="card-stats-label">Tingkat Kelulusan</div>
            </div>
        </div>

        <!-- Quota Progress -->
        <div class="quota-progress">
            <div class="quota-info">
                <span class="quota-available">Kuota Tersisa: <strong>45 dari 100</strong></span>
                <span class="quota-total">Gelombang 1</span>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 55%"></div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle">Keunggulan Kami</div>
            <h2 class="section-title">Mengapa Memilih Pesantren Al-Kautsar?</h2>
            <p class="section-description">
                Kami menyediakan pendidikan Islam terpadu yang mengintegrasikan nilai-nilai agama 
                dengan ilmu pengetahuan modern untuk membentuk generasi yang berakhlak mulia.
            </p>
        </div>

        <div class="card-grid card-grid-3">
            <div class="card card-feature">
                <div class="card-feature-icon">📖</div>
                <h3>Tahfidz Al-Quran</h3>
                <p>Program hafalan Al-Quran dengan metode terbukti efektif dan bimbingan ustadz/ustadzah berpengalaman.</p>
            </div>

            <div class="card card-feature">
                <div class="card-feature-icon">🎓</div>
                <h3>Akademik Terintegrasi</h3>
                <p>Kurikulum nasional terintegrasi dengan pendidikan agama untuk keseimbangan ilmu dunia dan akhirat.</p>
            </div>

            <div class="card card-feature">
                <div class="card-feature-icon">💪</div>
                <h3>Pembentukan Karakter</h3>
                <p>Pendidikan karakter islami melalui pembiasaan ibadah, akhlak mulia, dan kedisiplinan sehari-hari.</p>
            </div>

            <div class="card card-feature">
                <div class="card-feature-icon">🌐</div>
                <h3>Bahasa Internasional</h3>
                <p>Penguasaan bahasa Arab dan Inggris aktif melalui program bilingual intensif.</p>
            </div>

            <div class="card card-feature">
                <div class="card-feature-icon">💻</div>
                <h3>Teknologi Modern</h3>
                <p>Fasilitas teknologi pembelajaran modern dengan lab komputer dan internet berkecepatan tinggi.</p>
            </div>

            <div class="card card-feature">
                <div class="card-feature-icon">🏅</div>
                <h3>Prestasi Gemilang</h3>
                <p>Ratusan prestasi tingkat lokal, nasional, dan internasional di berbagai bidang lomba.</p>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="section" style="background: white;">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle">Timeline</div>
            <h2 class="section-title">Alur Pendaftaran</h2>
        </div>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-marker">1</div>
                <div class="timeline-content">
                    <h3>Pendaftaran Online</h3>
                    <p><strong>1 Januari - 31 Maret 2026</strong></p>
                    <p>Isi formulir pendaftaran online dan upload dokumen yang diperlukan.</p>
                </div>
                <div></div>
            </div>

            <div class="timeline-item">
                <div class="timeline-marker">2</div>
                <div></div>
                <div class="timeline-content">
                    <h3>Verifikasi Data</h3>
                    <p><strong>1-7 hari kerja</strong></p>
                    <p>Tim admin akan memverifikasi kelengkapan dokumen dan data pendaftar.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-marker">3</div>
                <div class="timeline-content">
                    <h3>Tes Seleksi</h3>
                    <p><strong>1-15 April 2026</strong></p>
                    <p>Tes tulis, wawancara, dan tes baca Al-Quran.</p>
                </div>
                <div></div>
            </div>

            <div class="timeline-item">
                <div class="timeline-marker">4</div>
                <div></div>
                <div class="timeline-content">
                    <h3>Pengumuman</h3>
                    <p><strong>20 April 2026</strong></p>
                    <p>Pengumuman hasil seleksi melalui website dan email.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-marker">5</div>
                <div class="timeline-content">
                    <h3>Daftar Ulang</h3>
                    <p><strong>25 April - 10 Mei 2026</strong></p>
                    <p>Daftar ulang dan pembayaran bagi yang diterima.</p>
                </div>
                <div></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Siap Mendaftar?</h2>
            <p class="cta-description">
                Jangan lewatkan kesempatan bergabung dengan pesantren terbaik. 
                Daftar sekarang dan raih masa depan gemilang bersama kami!
            </p>
            <a href="{{ route('registration.create') }}" class="btn btn-secondary btn-xl">
                <i class="fas fa-rocket"></i> Daftar Sekarang
            </a>
        </div>
    </div>
</section>

<!-- Floating CTA (Mobile) -->
<a href="{{ route('registration.create') }}" class="floating-cta btn btn-primary btn-lg">
    <i class="fas fa-edit"></i> Daftar
</a>
@endsection

@push('scripts')
@vite(['resources/js/loading-states.js'])
<script>
    // Initialize countdown timer
    document.addEventListener('DOMContentLoaded', () => {
        // Deadline: 31 Maret 2026, 23:59
        LoadingStates.startCountdown('countdown-timer', '2026-03-31T23:59:59');
    });
</script>
@endpush
