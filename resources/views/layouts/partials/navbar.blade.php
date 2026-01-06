<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="navbar-logo" style="display: flex; align-items: center; gap: 15px; text-decoration: none;">
            <!-- Authentic "Seal Style" CSS Logo (Cleaned & Fixed) -->
            <div class="logo-seal" style="position: relative; width: 70px; height: 70px; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; background: white;">
                
                <!-- Outer Gold Ring -->
                <div style="position: absolute; inset: 0; border-radius: 50%; border: 3px solid #d4af37; box-shadow: inset 0 0 0 2px #064e3b;"></div>
                
                <!-- Green Patterned Ring (Simplified) -->
                <div style="position: absolute; inset: 5px; border-radius: 50%; border: 4px solid #064e3b;"></div>

                <!-- Inner Gold Border -->
                <div style="position: absolute; inset: 9px; border-radius: 50%; border: 1px solid #d4af37; background: #ffffff;"></div>

                <!-- Content Container -->
                <div style="position: relative; z-index: 10; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; width: 100%; padding-top: 1px;">
                    
                    <!-- Arabic Calligraphy -->
                    <div style="font-family: 'Amiri', serif; font-size: 8px; color: #064e3b; font-weight: bold; line-height: 1; margin-bottom: 2px;">الكوثر</div>
                    
                    <!-- Central Icon Stack -->
                    <div style="position: relative; display: flex; flex-direction: column; align-items: center;">
                        <!-- Mosque Dome -->
                        <i class="fas fa-mosque" style="color: #064e3b; font-size: 14px; line-height: 1;"></i>
                        <!-- Book Overlay -->
                        <div style="margin-top: -4px; background: #ffffff; padding: 0 3px; border-radius: 3px; z-index: 2;">
                            <i class="fas fa-book-open" style="color: #d4af37; font-size: 10px; display: block;"></i>
                        </div>
                    </div>

                    <!-- Bottom Text Stack -->
                    <div style="margin-top: 2px; text-align: center; line-height: 1;">
                        <div style="font-family: 'Playfair Display', serif; font-size: 3.5px; color: #b8860b; font-weight: 900; letter-spacing: 0.3px;">AL-KAUTSAR</div>
                        <div style="font-family: 'Playfair Display', serif; font-size: 2.5px; color: #064e3b; font-weight: 700; letter-spacing: 0.3px; opacity: 0.9;">ISLAMIC SCHOOL</div>
                    </div>
                </div>
            </div>

            <!-- Side Text -->
            <div class="logo-text-group" style="display: flex; flex-direction: column; line-height: 1.1;">
                <span class="navbar-logo-text" style="font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #064e3b; text-transform: uppercase; letter-spacing: 1px;">Pesantren</span>
                <span style="font-family: 'Playfair Display', serif; font-size: 16px; font-weight: 600; color: #b8860b; letter-spacing: 2px; margin-top: -4px;">AL-KAUTSAR</span>
            </div>
        </a>

        <!-- Desktop Menu -->
        <div class="navbar-menu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Beranda
            </a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                Tentang
            </a>
            <a href="{{ route('requirements') }}" class="{{ request()->routeIs('requirements') ? 'active' : '' }}">
                Syarat Pendaftaran
            </a>
        </div>

        <!-- Actions -->
        <div class="navbar-actions">
            <a href="{{ route('status.check') }}" class="btn btn-outline btn-sm">
                Cek Status
            </a>
            
            @guest
                <a href="{{ route('registration.create') }}" class="btn btn-primary btn-sm">
                    Daftar Sekarang
                </a>
                <div class="navbar-user">
                    <button class="navbar-user-trigger">
                        <span>Login</span>
                        <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div class="navbar-user-dropdown">
                        <a href="{{ route('santri.login') }}">
                            <i class="fas fa-user"></i> Login Santri
                        </a>
                        <a href="{{ route('admin.login') }}">
                            <i class="fas fa-user-shield"></i> Login Admin
                        </a>
                    </div>
                </div>
            @else
                <div class="navbar-user">
                    <button class="navbar-user-trigger">
                        <div class="navbar-user-avatar">
                            <img src="{{ Auth::user()->avatar ?? '/img/avatar-default.png' }}" alt="Avatar">
                        </div>
                        <span class="navbar-user-name">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>

                    <div class="navbar-user-dropdown">
                        <a href="{{ route('santri.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="{{ route('santri.profile') }}">
                            <i class="fas fa-user"></i> Profil
                        </a>
                        <hr>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </form>
                    </div>
                </div>
            @endguest

            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggle">
                <i class="fas fa-bars navbar-toggle-icon"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="navbar-mobile-menu">
        <div class="navbar-mobile-menu-content">
            <nav>
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('about') }}">Tentang</a>
                <a href="{{ route('requirements') }}">Syarat Pendaftaran</a>
                <a href="{{ route('status.check') }}">Cek Status</a>
                <hr>
                @guest
                    <a href="{{ route('registration.create') }}">🎓 Daftar Sekarang</a>
                    <a href="{{ route('santri.login') }}">👤 Login Santri</a>
                    <a href="{{ route('admin.login') }}">🛡️ Login Admin</a>
                @else
                    <a href="{{ route('santri.dashboard') }}">Dashboard</a>
                    <a href="{{ route('santri.profile') }}">Profil</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </nav>
        </div>
    </div>
</nav>
