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

<!-- Caretaker Section (Styled to match Requirements Page) -->
<section class="section" style="background-color: #ffffff;">
    <div class="container">
        <div class="card overflow-hidden" style="border: none; box-shadow: var(--shadow-lg); border-radius: var(--radius-lg); display: grid; grid-template-columns: 1fr; @media (min-width: 768px) { grid-template-columns: 350px 1fr; }">
            
            <!-- Left Side (Ornament & Identity) -->
            <div style="background-color: var(--color-primary); color: white; padding: var(--space-12); display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; position: relative;">
                <!-- Subtle Background Texture (matching requirements style) -->
                <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%); pointer-events: none;"></div>
                
                <div style="width: 160px; height: 160px; background: rgba(255,255,255,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: var(--space-6); border: 2px solid rgba(255,255,255,0.3); position: relative; z-index: 2;">
                    <i class="fas fa-user-tie" style="font-size: 70px;"></i>
                </div>
                
                <h3 class="text-xl font-bold" style="margin-bottom: 5px; color: white; font-family: 'Inter', sans-serif;">KH. Sikul Amal, M.Pd.</h3>
                <p class="text-sm" style="opacity: 0.9; text-transform: uppercase; letter-spacing: 1px; font-weight: 500;">Pengasuh Pesantren</p>
            </div>

            <!-- Right Side (Biography Text) -->
            <div style="padding: var(--space-10); background: white;">
                <h2 class="text-xl font-bold color-primary" style="margin-bottom: var(--space-6); display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-id-card"></i> Profil Pengasuh
                </h2>
                
                <div style="font-family: 'Inter', sans-serif; color: var(--color-secondary); line-height: 1.8;">
                    <p style="margin-bottom: var(--space-6); font-size: 1rem;">
                        <strong>KH. Sikul Amal, M.Pd.</strong> adalah sosok pendidik yang berdedikasi tinggi dalam membimbing santri dengan kasih sayang dan ketegasan. Beliau memadukan kurikulum pesantren salaf dengan sistem pendidikan modern yang relevan dengan tantangan zaman.
                    </p>
                    
                    <p style="margin-bottom: var(--space-8); font-size: 1rem;">
                        Di bawah kepemimpinan beliau, Pesantren Al-Kautsar mengedepankan pembentukan karakter islami yang kuat, kemandirian, serta penguasaan ilmu pengetahuan sebagai bekal santri untuk masa depan yang gemilang.
                    </p>

                    <div class="grid grid-cols-2 gap-4">
                        <div style="padding: var(--space-4); border: 1px solid var(--color-bg-light); border-bottom: 3px solid var(--color-primary); border-radius: var(--radius-md);">
                            <div class="font-bold text-lg color-primary">20+ Tahun</div>
                            <div class="text-xs text-muted font-medium">Dedikasi Pendidikan</div>
                        </div>
                        <div style="padding: var(--space-4); border: 1px solid var(--color-bg-light); border-bottom: 3px solid var(--color-accent); border-radius: var(--radius-md);">
                            <div class="font-bold text-lg color-accent">Al-Azhar</div>
                            <div class="text-xs text-muted font-medium">Lulusan Terbaik</div>
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

<!-- Value Section -->
<section class="section" style="background-color: var(--color-bg-light);">
    <div class="container text-center">
        <h2 class="section-title">Nilai-Nilai Kami</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12">
            <div class="card p-6">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🤝</div>
                <h4 class="font-bold">Amanah</h4>
            </div>
            <div class="card p-6">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🎓</div>
                <h4 class="font-bold">Cerdas</h4>
            </div>
            <div class="card p-6">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🛡️</div>
                <h4 class="font-bold">Disiplin</h4>
            </div>
            <div class="card p-6">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">✨</div>
                <h4 class="font-bold">Ikhlas</h4>
            </div>
        </div>
    </div>
</section>
@endsection
