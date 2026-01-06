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

<!-- Caretaker Section (Refined Elegant Design) -->
<section class="section" style="background: #ffffff; padding: 100px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr; @media (min-width: 992px) { grid-template-columns: 450px 1fr; } gap: 60px; align-items: center;">
            
            <!-- Photo Side (Circular) -->
            <div style="display: flex; justify-content: center; position: relative;">
                <div style="width: 380px; height: 380px; border-radius: 50%; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); border: 12px solid #ffffff; position: relative; z-index: 2;">
                    <img src="/img/pengasuh.jpg" alt="KH. Sikul Amal" style="width: 100%; height: 100%; object-fit: cover; object-position: center 20%; filter: brightness(1.05) contrast(1.02);">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.2) 0%, transparent 30%);"></div>
                </div>
                <!-- Subtle Decorative Ring -->
                <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); width: 410px; height: 410px; border: 2px solid var(--color-primary); border-radius: 50%; opacity: 0.1; z-index: 1;"></div>
            </div>

            <!-- Content Side -->
            <div>
                <div style="display: inline-block; padding: 6px 16px; background: var(--color-bg-light); color: var(--color-primary); border-radius: 99px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 24px;">
                    Profil Pengasuh
                </div>
                <h1 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 800; color: #1e293b; margin-bottom: 8px; line-height: 1.2;">
                    KH. Sikul Amal, <span style="color: var(--color-primary);">M.Pd.</span>
                </h1>
                <p style="font-size: 1.2rem; color: #64748b; font-weight: 500; margin-bottom: 35px; border-left: 4px solid var(--color-accent); padding-left: 15px;">Pengasuh Pesantren Al-Kautsar</p>
                
                <div style="font-size: 1.15rem; line-height: 1.8; color: #475569; margin-bottom: 40px;">
                    <p style="margin-bottom: 20px;">
                        <strong>KH. Sikul Amal</strong> memimpin Pesantren Al-Kautsar dengan dedikasi tinggi, menggabungkan kearifan lokal dengan pandangan global untuk menciptakan lingkungan pendidikan yang islami dan progresif.
                    </p>
                    <p>
                        Beliau menekankan pentingnya pembentukan karakter (akhlak) di samping keunggulan akademik, memastikan setiap santri siap menghadapi tantangan zaman dengan pondasi iman yang kokoh.
                    </p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <div style="padding: 20px; background: #f8fafc; border-radius: 20px; border: 1px solid #e2e8f0;">
                        <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 5px;">Amanah & Bijak</h4>
                        <p style="font-size: 0.9rem; color: #64748b;">Memimpin dengan ketulusan dan integritas tinggi.</p>
                    </div>
                    <div style="padding: 20px; background: #f8fafc; border-radius: 20px; border: 1px solid #e2e8f0;">
                        <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 5px;">Visi Modern</h4>
                        <p style="font-size: 0.9rem; color: #64748b;">Menerapkan sistem pendidikan yang adaptif dan relevan.</p>
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
