<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - الصفحة غير موجودة | لوحة التحكم الإسلامية</title>
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
            background-color: #174e36;
            overflow-x: hidden;
        }
        
        .islamic-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.05'%3E%3Cpath d='M30 30c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20 20-8.954 20-20zm0 0c0 11.046 8.954 20 20 20s20-8.954 20-20-8.954-20-20-20-20 8.954-20 20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.3;
            z-index: 0;
        }
        
        .geometric-star {
            position: relative;
            width: 200px;
            height: 200px;
        }
        
        .geometric-star::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #d4af37;
            opacity: 0.2;
            clip-path: polygon(
                50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%,
                50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%
            );
        }
        
        .geometric-star::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #d4af37;
            opacity: 0.4;
            clip-path: polygon(
                50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%,
                50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%
            );
            transform: rotate(18deg);
        }
        
        .crescent {
            position: relative;
            width: 120px;
            height: 120px;
        }
        
        .crescent::before {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #d4af37;
            box-shadow: 0 0 40px rgba(212, 175, 55, 0.6);
        }
        
        .crescent::after {
            content: "";
            position: absolute;
            top: 10px;
            left: 25px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #174e36;
        }
        
        .error-code {
            font-family: 'Amiri', serif;
            font-size: 10rem;
            line-height: 1;
            background: linear-gradient(135deg, #d4af37 0%, #e6c063 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        
        .error-code::after {
            content: "٤٠٤";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #d4af37 0%, #e6c063 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.3;
            filter: blur(8px);
            z-index: -1;
        }
        
        .btn-islamic {
            background-color: #d4af37;
            color: #0f3b28;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-islamic:hover {
            background-color: #e6c063;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }
        
        .btn-islamic:active {
            transform: translateY(0);
        }
        
        .btn-islamic::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        
        .btn-islamic:hover::after {
            opacity: 1;
        }
        
        .btn-outline {
            border: 2px solid rgba(212, 175, 55, 0.5);
            color: #d4af37;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            border-color: #d4af37;
            background-color: rgba(212, 175, 55, 0.1);
        }
        
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .pulsing {
            animation: pulse 4s ease-in-out infinite;
        }
        
        @media (max-width: 768px) {
            .error-code {
                font-size: 6rem;
            }
            
            .geometric-star {
                width: 150px;
                height: 150px;
            }
            
            .crescent {
                width: 80px;
                height: 80px;
            }
            
            .crescent::before {
                width: 80px;
                height: 80px;
            }
            
            .crescent::after {
                width: 70px;
                height: 70px;
                top: 5px;
                left: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Islamic Pattern Background -->
    <div class="islamic-pattern"></div>
    
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12 relative z-10">
        <!-- Decorative Elements -->
        <div class="absolute top-20 right-20 opacity-30 hidden md:block">
            <div class="pulsing"></div>
        </div>
        <div class="absolute bottom-20 left-20 opacity-30 hidden md:block">
            <div class="pulsing" style="transform: rotate(30deg);"></div>
        </div>
        
        <!-- Main Content -->
        <div class="max-w-3xl w-full bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-8 md:p-12 border border-islamic-gold border-opacity-20 shadow-xl text-center">
            <!-- Error Symbol -->
            <div class="mb-6 relative">
                <div class="crescent mx-auto floating"></div>
                <h1 class="error-code mt-4">٤٠٤</h1>
            </div>
            
            <!-- Error Message -->
            <h2 class="text-2xl md:text-3xl font-bold text-islamic-light mb-4">الصفحة غير موجودة</h2>
            <p class="text-islamic-light opacity-80 mb-8 max-w-lg mx-auto">
                عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها أو حذفها.
            </p>
            
            <!-- Decorative Separator -->
            <div class="flex items-center justify-center my-8">
                <div class="h-px bg-islamic-gold bg-opacity-30 w-24"></div>
                <svg class="w-6 h-6 mx-4 text-islamic-gold opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <div class="h-px bg-islamic-gold bg-opacity-30 w-24"></div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                <a href="{{ route('dashboard.index') }}" class="btn-islamic font-bold py-3 px-8 rounded-xl shadow-lg w-full md:w-auto">
                    العودة للصفحة الرئيسية
                </a>
                <button onclick="window.history.back()" class="btn-outline py-3 px-8 rounded-xl w-full md:w-auto">
                    الرجوع للصفحة السابقة
                </button>
            </div>
            
            <!-- Suggestions -->
            <div class="mt-10 text-islamic-light">
                <h3 class="font-bold mb-3">روابط قد تهمك:</h3>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('dashboard.index') }}" class="px-4 py-2 bg-islamic-dark-green bg-opacity-50 rounded-lg hover:bg-opacity-70 transition-all">لوحة التحكم</a>
                    <a href="{{ route('dashboard.languages.index') }}" class="px-4 py-2 bg-islamic-dark-green bg-opacity-50 rounded-lg hover:bg-opacity-70 transition-all">اللغات</a>
                    <a href="#" class="px-4 py-2 bg-islamic-dark-green bg-opacity-50 rounded-lg hover:bg-opacity-70 transition-all">تحميل التطبيق</a>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-islamic-light opacity-60 text-sm text-center">
            <p>لوحة التحكم الإسلامية &copy; 2023</p>
        </div>
    </div>
    
    <script>
        // Optional: Add any interactive elements or animations here
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Log the 404 error for analytics
            console.log('404 page viewed: ' + window.location.pathname);
        });
    </script>
</body>
</html>