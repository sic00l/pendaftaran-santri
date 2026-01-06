@extends('layouts.app')

@section('title', 'Tentang Kami - Pesantren Al-Kautsar')

@section('content')
<!-- About Hero -->
<section class="hero-small" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%); padding: var(--space-20) 0; color: white; text-align: center;">
    <div class="container">
        <h1 class="text-4xl font-bold mb-4">Tentang Pesantren Al-Kautsar</h1>
        <p class="text-xl max-w-2xl mx-auto" style="color: #ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.3); font-weight: 500; line-height: 1.6;">Mengenal lebih dekat lembaga pendidikan Islam yang berdedikasi mencetak generasi unggul dan berakhlak mulia.</p>
    </div>
</section>

<!-- Caretaker Section -->
<section class="section">
    <div class="container">
        <div class="card card-about" style="overflow: hidden; border: none; box-shadow: var(--shadow-xl);">
            <div style="display: grid; grid-template-columns: 1fr; @media (min-width: 768px) { grid-template-columns: 400px 1fr; }">
                <div style="background-color: var(--color-bg-gray); display: flex; align-items: center; justify-content: center; padding: var(--space-8);">
                    <div style="text-align: center;">
                        <div style="width: 200px; height: 200px; border-radius: var(--radius-full); overflow: hidden; margin: 0 auto var(--space-6); box-shadow: 0 10px 25px rgba(255, 105, 180, 0.3); border: 4px solid #ffffff; position: relative;">
                            <!-- 'Korean Oppa' Filter: Brightness bump, slight saturation, soft contrast -->
                            <img src="/img/ustadz-sikul.jpg" alt="Ustadz Sikul Amal" style="width: 100%; height: 100%; object-fit: cover; object-position: top; filter: brightness(1.1) contrast(0.95) saturate(1.1);">
                            <!-- Soft Glow Overlay -->
                            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom right, rgba(255,255,255,0.2), transparent); pointer-events: none;"></div>
                        </div>
                        <h3 class="text-2xl font-bold color-primary">Ustadz Sikul Amal</h3>
                        <p class="text-muted">Pengasuh Utama</p>
                    </div>
                </div>
                <div style="padding: var(--space-10);">
                    <h2 class="section-title" style="text-align: left; margin-bottom: var(--space-6);">Profil Pengasuh</h2>
                    <p class="text-lg leading-relaxed mb-6">
                        <strong>Ustadz Sikul Amal</strong> adalah tokoh pendidik yang telah mendedikasikan hidupnya untuk kemajuan pendidikan Islam di Indonesia. Sebagai alumni Universitas Al-Azhar, Kairo, beliau membawa metodologi pembelajaran yang memadukan nilai-nilai tradisional pesantren dengan efisiensi pendidikan modern.
                    </p>
                    <p class="text-lg leading-relaxed mb-6">
                        Beliau percaya bahwa setiap santri memiliki potensi unik yang harus diasah dengan kesabaran dan kasih sayang. Di bawah bimbingan beliau, Pesantren Al-Kautsar terus berkembang menjadi institusi yang disegani karena kedisiplinan dan kualitas lulusannya.
                    </p>
                    <div style="display: flex; gap: var(--space-4);">
                        <div style="text-align: center; padding: var(--space-4); background: var(--color-bg-light); border-radius: var(--radius-lg); flex: 1;">
                            <div class="font-bold text-xl color-primary">20+</div>
                            <div class="text-sm">Tahun Pengalaman</div>
                        </div>
                        <div style="text-align: center; padding: var(--space-4); background: var(--color-bg-light); border-radius: var(--radius-lg); flex: 1;">
                            <div class="font-bold text-xl color-primary">Al-Azhar</div>
                            <div class="text-sm">Lulusan Terbaik</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="section" style="background-color: var(--color-bg-white);">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle">Tujuan Kami</div>
            <h2 class="section-title">Visi & Misi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-12">
            <!-- Vision -->
            <div class="card p-8" style="border-top: 5px solid var(--color-primary);">
                <div style="font-size: 3rem; margin-bottom: var(--space-4);">🎯</div>
                <h3 class="text-2xl font-bold mb-4">Visi</h3>
                <p class="text-lg leading-relaxed text-secondary">
                    "Menjadi lembaga pendidikan Islam terdepan dalam membentuk generasi Qur'ani yang unggul dalam Ilmu Pengetahuan dan Teknologi (IPTEK) serta kokoh dalam Iman dan Taqwa (IMTAK)."
                </p>
            </div>

            <!-- Mission -->
            <div class="card p-8" style="border-top: 5px solid var(--color-accent);">
                <div style="font-size: 3rem; margin-bottom: var(--space-4);">🚀</div>
                <h3 class="text-2xl font-bold mb-4">Misi</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: var(--space-4); display: flex; gap: var(--space-3);">
                        <i class="fas fa-check-circle color-primary mt-1"></i>
                        <span>Menanamkan nilai-nilai Al-Qur'an dan Sunnah dalam kehidupan sehari-hari seluruh santri.</span>
                    </li>
                    <li style="margin-bottom: var(--space-4); display: flex; gap: var(--space-3);">
                        <i class="fas fa-check-circle color-primary mt-1"></i>
                        <span>Menyelenggarakan sistem pendidikan berkualitas yang memadukan kurikulum nasional dan keilmuan pesantren.</span>
                    </li>
                    <li style="margin-bottom: var(--space-4); display: flex; gap: var(--space-3);">
                        <i class="fas fa-check-circle color-primary mt-1"></i>
                        <span>Meningkatkan kompetensi bahasa asing (Arab & Inggris) sebagai alat komunikasi global.</span>
                    </li>
                    <li style="margin-bottom: var(--space-4); display: flex; gap: var(--space-3);">
                        <i class="fas fa-check-circle color-primary mt-1"></i>
                        <span>Melatih kemandirian dan jiwa kepemimpinan santri melalui berbagai program pengembangan diri.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- History Section if needed -->
<section class="section" style="background-color: var(--color-bg-light);">
    <div class="container">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="section-title">Nilai-Nilai Kami</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12">
                <div>
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">🤝</div>
                    <h4 class="font-bold">Amanah</h4>
                </div>
                <div>
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">🎓</div>
                    <h4 class="font-bold">Cerdas</h4>
                </div>
                <div>
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">🛡️</div>
                    <h4 class="font-bold">Disiplin</h4>
                </div>
                <div>
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">✨</div>
                    <h4 class="font-bold">Ikhlas</h4>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

