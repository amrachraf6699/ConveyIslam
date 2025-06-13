<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم الإسلامية</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'islamic-green': '#174e36',
                        'islamic-dark-green': '#0f3b28',
                        'islamic-gold': '#d4af37',
                        'islamic-gold-hover': '#e6c063',
                        'islamic-light': '#f3f4f6'
                    },
                    fontFamily: {
                        'arabic': ['Cairo', 'Amiri', 'sans-serif'],
                        'amiri': ['Amiri', 'serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        .islamic-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.05'%3E%3Cpath d='M30 30c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20 20-8.954 20-20zm0 0c0 11.046 8.954 20 20 20s20-8.954 20-20-8.954-20-20-20-20 8.954-20 20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .crescent-icon {
            transform: rotate(-45deg);
        }
        
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        
        .overlay {
            transition: opacity 0.3s ease-in-out;
        }

        /* Main content margin adjustment when sidebar is visible on desktop */
        .main-content-adjusted {
            margin-right: 320px;
        }
        
        @media (max-width: 768px) {
            .main-content-adjusted {
                margin-right: 0;
            }
        }
    </style>
</head>
<body class="bg-islamic-green min-h-screen font-arabic">
    <!-- Mobile Menu Button -->
    <button id="mobileMenuBtn" class="fixed top-4 right-4 z-50 md:hidden bg-islamic-gold text-islamic-green p-3 rounded-full shadow-lg hover:bg-islamic-gold-hover transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden overlay"></div>

    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-8 transition-all duration-300 main-content-adjusted" id="mainContent">
            <!-- Islamic Pattern Background -->
            <div class="islamic-pattern fixed inset-0 pointer-events-none opacity-30"></div>
            
            <!-- Header -->
            <header class="relative z-10 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">مرحباً بك، أحمد</h1>
                        <p class="text-islamic-light opacity-80" id="currentTime"></p>
                    </div>
                    <div class="hidden md:block">
                        <button id="sidebarToggle" class="bg-islamic-gold text-islamic-green p-3 rounded-full shadow-lg hover:bg-islamic-gold-hover transition-colors">
                            <svg class="w-6 h-6 transition-transform duration-300" id="toggleIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Welcome Card -->
            <div class="relative z-10 bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-lg border border-islamic-gold border-opacity-20 mb-8">
                <div class="flex items-start space-x-4 space-x-reverse">
                    <div class="bg-islamic-gold bg-opacity-20 p-4 rounded-full">
                        <div class="crescent-icon text-islamic-gold text-2xl">🌙</div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl md:text-2xl font-semibold text-white mb-4">بسم الله الرحمن الرحيم</h2>
                        <blockquote class="text-islamic-light font-amiri text-lg md:text-xl leading-relaxed mb-4">
                            "وَمَن يَتَّقِ اللَّهَ يَجْعَل لَّهُ مَخْرَجًا وَيَرْزُقْهُ مِنْ حَيْثُ لَا يَحْتَسِبُ"
                        </blockquote>
                        <cite class="text-islamic-gold text-sm">سورة الطلاق، الآية 2-3</cite>
                    </div>
                </div>
            </div>

            <!-- Dashboard Stats -->
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-islamic-gold border-opacity-20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-islamic-light opacity-80 text-sm">إجمالي اللغات</p>
                            <p class="text-2xl font-bold text-white">١٢٣٤</p>
                        </div>
                        <div class="bg-islamic-gold bg-opacity-20 p-3 rounded-full">
                            <svg class="w-6 h-6 text-islamic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-islamic-gold border-opacity-20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-islamic-light opacity-80 text-sm">عدد المسؤولين</p>
                            <p class="text-2xl font-bold text-white">٤٢</p>
                        </div>
                        <div class="bg-islamic-gold bg-opacity-20 p-3 rounded-full">
                            <svg class="w-6 h-6 text-islamic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed right-0 top-0 h-full w-80 bg-islamic-dark-green shadow-2xl z-40 sidebar-transition">
            <div class="p-6">
                <!-- Logo/Brand -->
                <div class="flex items-center space-x-3 space-x-reverse mb-8">
                    <div class="bg-islamic-gold p-3 rounded-full">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10">
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">لوحة التحكم</h2>
                        <p class="text-islamic-light opacity-60 text-sm">بلِّغ الإسلام</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <!-- Dashboard -->
                    <div class="navigation-item">
                        <a href="{{ route('dashboard.index') }}" class="flex items-center justify-between w-full space-x-3 space-x-reverse p-3 rounded-xl transition-colors
                            {{ request()->routeIs('dashboard.index') ? 'bg-islamic-gold bg-opacity-20 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-20 hover:text-islamic-gold' }}">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                </svg>
                                <span class="font-medium">لوحة التحكم</span>
                            </div>
                        </a>
                    </div>

                    <!-- Languages -->
                    <div class="navigation-item">
                        <button onclick="toggleDropdown('languages')" class="flex items-center justify-between w-full space-x-3 space-x-reverse p-3 rounded-xl transition-colors
                            {{ request()->routeIs('languages*') ? 'bg-islamic-gold bg-opacity-20 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-20 hover:text-islamic-gold' }}">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                </svg>
                                <span class="font-medium">اللغات</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('languages*') ? 'rotate-180' : '' }}" 
                                id="languages-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="languages-dropdown" class="mt-2 mr-8 space-y-1 {{ request()->routeIs('languages*') ? '' : 'hidden' }}">
                            <a href="{{ route('dashboard.languages.index') }}" class="block p-2 rounded-lg transition-colors text-sm
                                {{ request()->routeIs('dashboard.languages.index') ? 'bg-islamic-gold bg-opacity-10 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-10 hover:text-islamic-gold' }}">
                                عرض الكل
                            </a>
                            <a href="{{ route('dashboard.languages.create') }}" class="block p-2 rounded-lg transition-colors text-sm
                                {{ request()->routeIs('dashboard.languages.create') ? 'bg-islamic-gold bg-opacity-10 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-10 hover:text-islamic-gold' }}">
                                إنشاء جديد
                            </a>
                        </div>
                    </div>

                    <!-- Officials -->
                    <div class="navigation-item">
                        <button onclick="toggleDropdown('officials')" class="flex items-center justify-between w-full space-x-3 space-x-reverse p-3 rounded-xl transition-colors
                            {{ request()->routeIs('officials*') ? 'bg-islamic-gold bg-opacity-20 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-20 hover:text-islamic-gold' }}">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="font-medium">المسؤولين</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('officials*') ? 'rotate-180' : '' }}" 
                                id="officials-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="officials-dropdown" class="mt-2 mr-8 space-y-1 {{ request()->routeIs('officials*') ? '' : 'hidden' }}">
                            <a href="{{ route('dashboard.admins.index') }}" class="block p-2 rounded-lg transition-colors text-sm
                                {{ request()->routeIs('dashboard.admins.index') ? 'bg-islamic-gold bg-opacity-10 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-10 hover:text-islamic-gold' }}">
                                عرض الكل
                            </a>
                            <a href="{{ route('dashboard.admins.create') }}" class="block p-2 rounded-lg transition-colors text-sm
                                {{ request()->routeIs('dashboard.admins.create') ? 'bg-islamic-gold bg-opacity-10 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-10 hover:text-islamic-gold' }}">
                                إنشاء جديد
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- Logout Button -->
                <div class="absolute bottom-6 left-6 right-6">
                    <a href="#" class="flex items-center space-x-3 space-x-reverse p-3 rounded-xl text-red-300 hover:bg-red-500 hover:bg-opacity-20 hover:text-red-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="font-medium">تسجيل الخروج</span>
                    </a>
                </div>
            </div>
        </aside>
    </div>

    <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('mainContent');
        const toggleIcon = document.getElementById('toggleIcon');

        // Track sidebar state
        let sidebarOpen = true;

        function updateSidebarState(isOpen) {
            sidebarOpen = isOpen;
            
            if (window.innerWidth >= 768) {
                // Desktop behavior
                if (isOpen) {
                    sidebar.classList.remove('translate-x-full');
                    mainContent.classList.add('main-content-adjusted');
                    // Change icon to close/X
                    toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                } else {
                    sidebar.classList.add('translate-x-full');
                    mainContent.classList.remove('main-content-adjusted');
                    // Change icon to hamburger
                    toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }
                overlay.classList.add('hidden');
            } else {
                // Mobile behavior
                if (isOpen) {
                    sidebar.classList.remove('translate-x-full');
                    overlay.classList.remove('hidden');
                } else {
                    sidebar.classList.add('translate-x-full');
                    overlay.classList.add('hidden');
                }
                mainContent.classList.remove('main-content-adjusted');
            }
        }

        function toggleSidebar() {
            updateSidebarState(!sidebarOpen);
        }

        function closeSidebar() {
            updateSidebarState(false);
        }

        function openSidebar() {
            updateSidebarState(true);
        }

        // Desktop sidebar toggle
        sidebarToggle.addEventListener('click', toggleSidebar);

        // Mobile menu toggle
        mobileMenuBtn.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking overlay
        overlay.addEventListener('click', closeSidebar);

        // Handle window resize
        window.addEventListener('resize', function() {
            // Reinitialize sidebar state based on new screen size
            updateSidebarState(sidebarOpen);
        });

        // Initialize sidebar state based on screen size
        function initializeSidebar() {
            if (window.innerWidth >= 768) {
                // Desktop: sidebar open by default
                updateSidebarState(true);
            } else {
                // Mobile: sidebar closed by default
                updateSidebarState(false);
            }
        }

        // Update current time
        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            
            const arabicTime = now.toLocaleDateString('ar-SA', options);
            document.getElementById('currentTime').textContent = arabicTime;
        }

        // Initialize
        initializeSidebar();
        updateTime();
        setInterval(updateTime, 60000); // Update every minute

        // Close sidebar with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSidebar();
            }
        });
    </script>
    
    <script>
        function toggleDropdown(section) {
            const dropdown = document.getElementById(section + '-dropdown');
            const arrow = document.getElementById(section + '-arrow');
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            } else {
                dropdown.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        }
    </script>
</body>
</html>