<aside class="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
            <img src="/img/logo.png" alt="Logo">
            <span>Admin Panel</span>
        </a>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar-menu">
        <!-- Main Menu -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Menu Utama</div>
            
            <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.santri.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.santri.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Data Santri</span>
                @if(isset($pendingCount) && $pendingCount > 0)
                    <span class="sidebar-menu-badge">{{ $pendingCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.verification.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.verification.*') ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i>
                <span>Verifikasi</span>
            </a>

            <a href="{{ route('admin.payment.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.payment.*') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Pembayaran</span>
            </a>
        </div>

        <!-- Reports -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Laporan</div>
            
            <a href="{{ route('admin.reports.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>

            <a href="{{ route('admin.exports.index') }}" class="sidebar-menu-item">
                <i class="fas fa-file-export"></i>
                <span>Export Data</span>
            </a>
        </div>

        <!-- Settings -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Pengaturan</div>
            
            <a href="{{ route('admin.settings.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i>
                <span>Kelola Admin</span>
            </a>
        </div>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="p-4 bg-gray rounded">
            <p class="text-xs text-secondary mb-2">Logged in as:</p>
            <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
        </div>
    </div>
</aside>
