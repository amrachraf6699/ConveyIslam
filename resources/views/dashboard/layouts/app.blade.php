<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | بلِّغ الإسلام</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cairo:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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

        .main-content-adjusted {
            margin-right: 320px;
        }

        @media (max-width: 768px) {
            .main-content-adjusted {
                margin-right: 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-islamic-green min-h-screen font-arabic">
    <button id="mobileMenuBtn"
        class="absolute top-4 left-4 z-50 md:hidden bg-islamic-gold text-islamic-green p-3 rounded-full shadow-lg hover:bg-islamic-gold-hover transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden overlay"></div>

    <div class="flex min-h-screen">
        <main class="flex-1 p-4 md:p-8 transition-all duration-300 main-content-adjusted" id="mainContent">
            <!-- Islamic Pattern Background -->
            <div class="islamic-pattern fixed inset-0 pointer-events-none opacity-30"></div>

<!-- Header -->
<header class="relative z-10 mb-8 border-b border-islamic-gold border-opacity-20 pb-4">
    <div class="flex items-center justify-start space-x-4 space-x-reverse">
        <div class="hidden md:block">
            <button id="sidebarToggle"
                class="bg-islamic-gold text-islamic-green p-3 rounded-full shadow-lg hover:bg-islamic-gold-hover transition-colors">
                <svg class="w-6 h-6 transition-transform duration-300" id="toggleIcon" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">مرحباً بك، {{ auth()->user()->name }}
            </h1>
            <p class="text-islamic-light opacity-80" id="currentTime"></p>
        </div>
    </div>
</header>

            @yield('content')
        </main>

        <aside id="sidebar"
            class="fixed right-0 top-0 h-full w-80 bg-islamic-dark-green shadow-2xl z-40 sidebar-transition">
            <div class="p-6">
                <div class="flex items-center space-x-3 space-x-reverse mb-8">
                    <div class="bg-islamic-gold p-3 rounded-full">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10">
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">لوحة التحكم</h2>
                        <p class="text-islamic-light opacity-60 text-sm">بلِّغ الإسلام</p>
                    </div>
                </div>

                <nav class="space-y-2">
                    <div class="navigation-item">
                        <a href="{{ route('dashboard.index') }}"
                            class="flex items-center justify-between w-full space-x-3 space-x-reverse p-3 rounded-xl transition-colors
                            {{ request()->routeIs('dashboard.index') ? 'bg-islamic-gold bg-opacity-20 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-20 hover:text-islamic-gold' }}">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                </svg>
                                <span class="font-medium">لوحة التحكم</span>
                            </div>
                        </a>
                    </div>

                    <div class="navigation-item">
                        <button onclick="toggleDropdown('languages')"
                            class="flex items-center justify-between w-full space-x-3 space-x-reverse p-3 rounded-xl transition-colors
                            {{ request()->routeIs('dashboard.languages.*') ? 'bg-islamic-gold bg-opacity-20 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-20 hover:text-islamic-gold' }}">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                                    </path>
                                </svg>
                                <span class="font-medium">اللغات</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('dashboard.languages.*') ? 'rotate-180' : '' }}"
                                id="languages-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="languages-dropdown"
                            class="mt-2 mr-8 space-y-1 {{ request()->routeIs('dashboard.languages.*') ? '' : 'hidden' }}">
                            <a href="{{ route('dashboard.languages.index') }}"
                                class="block p-2 rounded-lg transition-colors text-sm
                                {{ request()->routeIs('dashboard.languages.index') ? 'bg-islamic-gold bg-opacity-10 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-10 hover:text-islamic-gold' }}">
                                عرض الكل
                            </a>
                            <a href="{{ route('dashboard.languages.create') }}"
                                class="block p-2 rounded-lg transition-colors text-sm
                                {{ request()->routeIs('dashboard.languages.create') ? 'bg-islamic-gold bg-opacity-10 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-10 hover:text-islamic-gold' }}">
                                إنشاء جديد
                            </a>
                        </div>
                    </div>

                    <div class="navigation-item">
                        <button onclick="toggleDropdown('officials')"
                            class="flex items-center justify-between w-full space-x-3 space-x-reverse p-3 rounded-xl transition-colors
                            {{ request()->routeIs('dashboard.admins.*') ? 'bg-islamic-gold bg-opacity-20 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-20 hover:text-islamic-gold' }}">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="font-medium">المسؤولين</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('dashboard.admins.*') ? 'rotate-180' : '' }}"
                                id="officials-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="officials-dropdown"
                            class="mt-2 mr-8 space-y-1 {{ request()->routeIs('dashboard.admins.*') ? '' : 'hidden' }}">
                            <a href="{{ route('dashboard.admins.index') }}"
                                class="block p-2 rounded-lg transition-colors text-sm
                                {{ request()->routeIs('dashboard.admins.index') ? 'bg-islamic-gold bg-opacity-10 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-10 hover:text-islamic-gold' }}">
                                عرض الكل
                            </a>
                            <a href="{{ route('dashboard.admins.create') }}"
                                class="block p-2 rounded-lg transition-colors text-sm
                                {{ request()->routeIs('dashboard.admins.create') ? 'bg-islamic-gold bg-opacity-10 text-islamic-gold' : 'text-islamic-light hover:bg-islamic-gold hover:bg-opacity-10 hover:text-islamic-gold' }}">
                                إنشاء جديد
                            </a>
                        </div>
                    </div>
                </nav>

                <div class="absolute bottom-6 left-6 right-6">
                    <a href="#" onclick="openPasswordModal()"
                        class="flex items-center space-x-3 space-x-reverse p-3 rounded-xl text-yellow-300 hover:bg-yellow-500 hover:bg-opacity-20 hover:text-yellow-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 15 15"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 8.5V7.5C12.5 6.94772 12.0523 6.5 11.5 6.5H1.5C0.947715 6.5 0.5 6.94772 0.5 7.5V13.5C0.5 14.0523 0.947715 14.5 1.5 14.5H11.5C12.0523 14.5 12.5 14.0523 12.5 13.5V12.5M12.5 8.5H8.5C7.39543 8.5 6.5 9.39543 6.5 10.5C6.5 11.6046 7.39543 12.5 8.5 12.5H12.5M12.5 8.5C13.6046 8.5 14.5 9.39543 14.5 10.5C14.5 11.6046 13.6046 12.5 12.5 12.5M3.5 6.5V3.5C3.5 1.84315 4.84315 0.5 6.5 0.5C8.15685 0.5 9.5 1.84315 9.5 3.5V6.5M12 10.5H13M10 10.5H11M8 10.5H9"
                                stroke="currentColor" />
                        </svg>
                        <span class="font-medium">تغيير كلمة المرور</span>
                    </a>
                    <a href="{{ route('dashboard.logout') }}"
                        class="flex items-center space-x-3 space-x-reverse p-3 rounded-xl text-red-300 hover:bg-red-500 hover:bg-opacity-20 hover:text-red-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="font-medium">تسجيل الخروج</span>
                    </a>
                </div>

                <div id="passwordModal"
                    class="fixed inset-0 bg-[#1A3C34] bg-opacity-75 flex items-center justify-center hidden z-50 ring-2 ring-yellow-400/30 rounded-xl p-4"
                    dir="rtl">
                    <div class="bg-islamic-dark-green rounded-xl p-8 w-full max-w-md">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-white">تغيير كلمة المرور</h2>
                            <button onclick="closePasswordModal()" class="text-gray-300 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <form id="passwordForm" action="{{ route('dashboard.password.update') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="newPassword" class="block text-white font-medium mb-2">كلمة المرور
                                        الحالية</label>
                                    <input type="text" id="newPassword" name="current_password" required
                                        class="p-3 rounded-xl bg-gray-800 bg-opacity-50 border border-yellow-400/30 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 placeholder-gray-400 text-right"
                                        placeholder="أدخل كلمة المرور الحالية" dir="rtl">
                                </div>
                                <div>
                                    <label for="newPassword" class="block text-white font-medium mb-2">كلمة المرور
                                        الجديدة</label>
                                    <input type="text" id="newPassword" name="new_password" required
                                        class="p-3 rounded-xl bg-gray-800 bg-opacity-50 border border-yellow-400/30 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 placeholder-gray-400 text-right"
                                        placeholder="أدخل كلمة المرور الجديدة" dir="rtl">
                                </div>
                                <div>
                                    <label for="confirmPassword" class="block text-white font-medium mb-2">تأكيد كلمة
                                        المرور</label>
                                    <input type="password" id="confirmPassword" name="new_password_confirmation" required
                                        class="p-3 rounded-xl bg-gray-800 bg-opacity-50 border border-yellow-400/30 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 placeholder-gray-400 text-right"
                                        placeholder="أكد كلمة المرور" dir="rtl">
                                </div>
                                <div class="flex justify-end space-x-3 space-x-reverse">
                                    <button type="button" onclick="closePasswordModal()"
                                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                        إلغاء
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-yellow-500 text-gray-900 rounded-lg hover:bg-yellow-400 transition-colors">
                                        حفظ
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('mainContent');
        const toggleIcon = document.getElementById('toggleIcon');

        let sidebarOpen = true;

        function updateSidebarState(isOpen) {
            sidebarOpen = isOpen;

            if (window.innerWidth >= 768) {
                if (isOpen) {
                    sidebar.classList.remove('translate-x-full');
                    mainContent.classList.add('main-content-adjusted');
                    toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                } else {
                    sidebar.classList.add('translate-x-full');
                    mainContent.classList.remove('main-content-adjusted');
                    toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }
                overlay.classList.add('hidden');
            } else {
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

        sidebarToggle.addEventListener('click', toggleSidebar);

        mobileMenuBtn.addEventListener('click', toggleSidebar);

        overlay.addEventListener('click', closeSidebar);

        window.addEventListener('resize', function () {
            updateSidebarState(sidebarOpen);
        });

        function initializeSidebar() {
            if (window.innerWidth >= 768) {
                updateSidebarState(true);
            } else {
                updateSidebarState(false);
            }
        }

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

        initializeSidebar();
        updateTime();
        setInterval(updateTime, 60000);

        document.addEventListener('keydown', function (e) {
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
    <script>
        function openPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
            document.getElementById('passwordForm').reset();
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closePasswordModal();
            }
        });

    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @session('success')
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to left, #174e36, #d4af37)",
                    fontFamily: "Cairo, sans-serif",
                    textAlign: "center"
                },
                onClick: function () { }
            }).showToast();
        </script>
    @endsession
    @error('current_password')
        <script>
            Toastify({
                text: "كلمة المرور الحالية غير صحيحة.",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to left, #c53030, #f56565)",
                    fontFamily: "Cairo, sans-serif",
                    textAlign: "center"
                },
                onClick: function () { }
            }).showToast();
        </script>
    @enderror
    @stack('scripts')
</body>

</html>