<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- About Column -->
            <div class="footer-column">
                <div class="footer-logo">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                        <!-- Authentic "Seal Style" CSS Logo (Cleaned & Fixed) -->
                        <div class="logo-seal" style="position: relative; width: 65px; height: 65px; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; background: white;">
                            
                            <!-- Outer Gold Ring -->
                            <div style="position: absolute; inset: 0; border-radius: 50%; border: 3px solid #d4af37; box-shadow: inset 0 0 0 2px #064e3b;"></div>
                            
                            <!-- Green Patterned Ring (Simplified) -->
                            <div style="position: absolute; inset: 5px; border-radius: 50%; border: 4px solid #064e3b;"></div>

                            <!-- Inner Gold Border -->
                            <div style="position: absolute; inset: 9px; border-radius: 50%; border: 1px solid #d4af37; background: #ffffff;"></div>

                            <!-- Content Container -->
                            <div style="position: relative; z-index: 10; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; width: 100%; padding-top: 1px;">
                                
                                <!-- Arabic Calligraphy -->
                                <div style="font-family: 'Amiri', serif; font-size: 7px; color: #064e3b; font-weight: bold; line-height: 1; margin-bottom: 2px;">الكوثر</div>
                                
                                <!-- Central Icon Stack -->
                                <div style="position: relative; display: flex; flex-direction: column; align-items: center;">
                                    <i class="fas fa-mosque" style="color: #064e3b; font-size: 13px; line-height: 1;"></i>
                                    <div style="margin-top: -4px; background: #ffffff; padding: 0 3px; border-radius: 4px; z-index: 2;">
                                        <i class="fas fa-book-open" style="color: #d4af37; font-size: 9px; display: block;"></i>
                                    </div>
                                </div>

                                <!-- Bottom Text Stack -->
                                <div style="margin-top: 2px; text-align: center; line-height: 1;">
                                    <div style="font-family: 'Playfair Display', serif; font-size: 3px; color: #b8860b; font-weight: 900; letter-spacing: 0.3px;">AL-KAUTSAR</div>
                                    <div style="font-family: 'Playfair Display', serif; font-size: 2px; color: #064e3b; font-weight: 700; letter-spacing: 0.3px; opacity: 0.9;">ISLAMIC SCHOOL</div>
                                </div>
                            </div>
                        </div>
                        
                        <div style="display: flex; flex-direction: column; line-height: 1.2;">
                            <span style="font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #ffffff; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">Pesantren</span>
                            <span style="font-family: 'Playfair Display', serif; font-size: 15px; font-weight: 600; color: #d4af37; letter-spacing: 2px; margin-top: -3px;">AL-KAUTSAR</span>
                        </div>
                    </div>
                </div>
                <p>
                    Lembaga pendidikan Islam terpadu yang mengintegrasikan pendidikan agama dan umum 
                    dengan metode modern dan berkualitas.
                </p>
                <div class="footer-social">
                    <a href="#" class="footer-social-link">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="footer-social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="footer-social-link">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="footer-social-link">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-column">
                <h3>Link Cepat</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('requirements') }}">Syarat Pendaftaran</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>

            <!-- Programs -->
            <div class="footer-column">
                <h3>Program</h3>
                <ul>
                    <li><a href="#">Tahfidz Quran</a></li>
                    <li><a href="#">Pendidikan Akademik</a></li>
                    <li><a href="#">Bahasa Arab & Inggris</a></li>
                    <li><a href="#">Teknologi & Komputer</a></li>
                    <li><a href="#">Ekstrakurikuler</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-column">
                <h3>Kontak</h3>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <p>Jl. Pendidikan No. 123</p>
                        <p>Bogor, Jawa Barat 16000</p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <a href="tel:+62211234567">+62 21 1234 567</a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <a href="mailto:info@pesantrenalkautsar.ac.id">info@pesantrenalkautsar.ac.id</a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <div>
                        <a href="https://wa.me/628123456789">+62 812 3456 789</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-copyright">
                © {{ date('Y') }} Pesantren Al-Kautsar. All rights reserved.
            </div>
            <div class="footer-links">
                <a href="{{ route('privacy') }}">Kebijakan Privasi</a>
                <a href="{{ route('terms') }}">Syarat & Ketentuan</a>
                <a href="{{ route('sitemap') }}">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
