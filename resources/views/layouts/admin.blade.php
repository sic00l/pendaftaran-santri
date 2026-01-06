<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin Panel') - Pesantren Al-Kautsar</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    
    @stack('styles')
</head>
<body>
    <div class="sidebar-layout">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="main-content-header">
                <div class="main-content-header-top">
                    <div>
                        <!-- Sidebar Toggle (Mobile) -->
                        <button class="sidebar-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <!-- Breadcrumb -->
                        @if(isset($breadcrumbs))
                            <nav class="breadcrumb">
                                @foreach($breadcrumbs as $breadcrumb)
                                    <div class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                                        @if(!$loop->last)
                                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                                            <span class="breadcrumb-separator">/</span>
                                        @else
                                            {{ $breadcrumb['label'] }}
                                        @endif
                                    </div>
                                @endforeach
                            </nav>
                        @endif

                        <h1 class="main-content-title">@yield('page_title')</h1>
                    </div>

                    <!-- Header Actions -->
                    <div class="flex items-center gap-3">
                        @yield('header_actions')
                        
                        <!-- User Menu -->
                        <div class="navbar-user">
                            <button class="navbar-user-trigger">
                                <div class="navbar-user-avatar">
                                    <img src="{{ Auth::user()->avatar ?? '/img/avatar-default.png' }}" alt="Avatar">
                                </div>
                                <span class="navbar-user-name">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>

                            <div class="navbar-user-dropdown">
                                <a href="{{ route('admin.profile') }}">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                                <a href="{{ route('admin.settings') }}">
                                    <i class="fas fa-cog"></i> Pengaturan
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
                    </div>
                </div>
            </div>

            <!-- Content Body -->
            <div class="main-content-body">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <div class="alert-icon">✅</div>
                        <div class="alert-content">
                            <p class="alert-message">{{ session('success') }}</p>
                        </div>
                        <button class="alert-close">×</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <div class="alert-icon">❌</div>
                        <div class="alert-content">
                            <p class="alert-message">{{ session('error') }}</p>
                        </div>
                        <button class="alert-close">×</button>
                    </div>
                @endif

                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer-simple">
                © {{ date('Y') }} Pesantren Al-Kautsar. All rights reserved.
            </footer>
        </div>
    </div>

    <!-- Sidebar Backdrop (Mobile) -->
    <div class="sidebar-backdrop"></div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    @vite(['resources/js/app.js', 'resources/js/admin-datatable.js'])
    
    @stack('scripts')
</body>
</html>
