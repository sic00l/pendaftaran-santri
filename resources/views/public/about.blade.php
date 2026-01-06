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

<!-- Caretaker Section (Back to Original Card Style with Ornament) -->
<section class="section">
    <div class="container">
        <div class="card card-about" style="overflow: hidden; border: none; box-shadow: var(--shadow-xl); border-radius: 20px;">
            <div style="display: grid; grid-template-columns: 1fr; @media (min-width: 768px) { grid-template-columns: 350px 1fr; }">
                <div style="background-color: var(--color-primary); display: flex; align-items: center; justify-content: center; padding: var(--space-12); color: white; position: relative; overflow: hidden;">
                    <!-- Geometric Background Ornament -->
                    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                    
                    <div style="text-align: center; position: relative; z-index: 2;">
                        <div style="width: 180px; height: 180px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-6); border: 2px dashed rgba(255,255,255,0.5);">
                            <!-- Person Ornament (Icon) -->
                            <i class="fas fa-user-tie" style="font-size: 80px; color: white;"></i>
                        </div>
                        <h3 class="text-2xl font-bold" style="margin-bottom: 5px;">KH. Sikul Amal, M.Pd.</h3>
                        <p style="opacity: 0.8; font-size: 0.9rem; letter-spacing: 1px;">PENGASUH PESANTREN</p>
                    </div>
                </div>
                <div style="padding: var(--space-10); background: white;">
                    <h2 class="section-title" style="text-align: left; margin-bottom: var(--space-6); color: var(--color-primary);">Profil Pengasuh</h2>
                    <div style="font-size: 1.1rem; line-height: 1.8; color: var(--color-secondary);">
                        <p style="margin-bottom: var(--space-6);">
                            <strong>KH. Sikul Amal, M.Pd.</strong> adalah sosok pendidik yang berdedikasi tinggi dalam membimbing santri dengan kasih sayang dan ketegasan. Beliau memadukan kurikulum pesantren salaf dengan sistem pendidikan modern yang relevan dengan tantangan zaman.
                        </p>
                        <p style="margin-bottom: var(--space-6);">
                            Di bawah kepemimpinan beliau, Pesantren Al-Kautsar mengedepankan pembentukan karakter islami yang kuat, kemandirian, serta penguasaan ilmu pengetahuan sebagai bekal santri untuk masa depan yang gemilang.
                        </p>
                    </div>
                    <div style="display: flex; gap: var(--space-4); margin-top: var(--space-8);">
                        <div style="padding: var(--space-4); background: var(--color-bg-light); border-radius: var(--radius-lg); flex: 1; text-align: center;">
                            <div class="font-bold text-xl color-primary">20+</div>
                            <div class="text-sm">Tahun Dedikasi</div>
                        </div>
                        <div style="padding: var(--space-4); background: var(--color-bg-light); border-radius: var(--radius-lg); flex: 1; text-align: center;">
                            <div class="font-bold text-xl color-primary">Alumni</div>
                            <div class="text-sm">Terbaik Al-Azhar</div>
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

<!-- History Section -->
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
