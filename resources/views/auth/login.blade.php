<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - </title>
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
        
        .form-input:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }
        
        .islamic-border {
            background: 
                linear-gradient(to right, #d4af37 4px, transparent 4px) 0 0,
                linear-gradient(to right, #d4af37 4px, transparent 4px) 0 100%,
                linear-gradient(to left, #d4af37 4px, transparent 4px) 100% 0,
                linear-gradient(to left, #d4af37 4px, transparent 4px) 100% 100%,
                linear-gradient(to bottom, #d4af37 4px, transparent 4px) 0 0,
                linear-gradient(to bottom, #d4af37 4px, transparent 4px) 100% 0,
                linear-gradient(to top, #d4af37 4px, transparent 4px) 0 100%,
                linear-gradient(to top, #d4af37 4px, transparent 4px) 100% 100%;
            background-repeat: no-repeat;
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-islamic-green min-h-screen font-arabic">
    <!-- Islamic Pattern Background -->
    <div class="islamic-pattern fixed inset-0 pointer-events-none opacity-30"></div>
    
    <!-- Login Container -->
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo/Brand -->
            <div class="flex flex-col items-center mb-8">
                <div class="bg-islamic-gold p-4 rounded-full mb-4">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10">
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">لوحة تحكم بلِّغ الإسلام</h1>
                <p class="text-islamic-light opacity-80 mt-2">مرحباً بك في نظام الإدارة</p>
            </div>
            
            <!-- Login Form -->
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-8 shadow-xl islamic-border">
                <!-- Bismillah -->
                <div class="text-center mb-8">
                    <p class="font-amiri text-islamic-gold text-xl">بسم الله الرحمن الرحيم</p>
                </div>

                @if($errors->any())
                    <div class="bg-red-800 text-white p-4 rounded-lg mb-6 bg-opacity-60">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="" class="space-y-6">
                    @csrf
                    <!-- Username/Email Field -->
                    <div class="mb-6">
                        <label for="username" class="block text-islamic-light font-medium mb-2">البريد الإلكتروني</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="username" 
                                name="email" 
                                class="form-input w-full bg-white bg-opacity-10 border border-islamic-gold border-opacity-30 rounded-xl px-4 py-3 text-white placeholder-islamic-light placeholder-opacity-60 focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:ring-opacity-50 transition-all"
                                placeholder="أدخل أو البريد الإلكتروني"
                                dir="rtl"
                                value="{{ old('email') }}"
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="mb-6">
                        <label for="password" class="block text-islamic-light font-medium mb-2">كلمة المرور</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-input w-full bg-white bg-opacity-10 border border-islamic-gold border-opacity-30 rounded-xl px-4 py-3 text-white placeholder-islamic-light placeholder-opacity-60 focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:ring-opacity-50 transition-all"
                                placeholder="أدخل كلمة المرور"
                                dir="rtl"
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-islamic-gold hover:bg-islamic-gold-hover text-islamic-dark-green font-bold py-3 px-4 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:ring-opacity-50 shadow-lg"
                    >
                        تسجيل الدخول
                    </button>
                </form>
            </div>
            
            <!-- Footer Quote -->
            <div class="mt-8 text-center">
                <p class="text-islamic-light opacity-70 text-sm font-amiri">
                    "إِنَّ اللَّهَ مَعَ الصَّابِرِينَ"
                </p>
                <p class="text-islamic-gold text-xs mt-1">سورة البقرة، الآية 153</p>
            </div>
        </div>
    </div>
    
    <script>
        // Optional: Add password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            const togglePassword = document.createElement('button');
            togglePassword.type = 'button';
            togglePassword.className = 'absolute inset-y-0 left-0 flex items-center pl-3 text-islamic-gold hover:text-islamic-gold-hover focus:outline-none';
            togglePassword.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            `;
            
            passwordField.parentElement.appendChild(togglePassword);
            
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                
                // Change icon based on password visibility
                if (type === 'text') {
                    this.innerHTML = `
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    `;
                } else {
                    this.innerHTML = `
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    `;
                }
            });
        });
    </script>
</body>
</html>