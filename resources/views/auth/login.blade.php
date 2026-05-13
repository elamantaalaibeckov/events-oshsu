<!DOCTYPE html>
<html lang="kg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кирүү | Студент Панели</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Manrope', sans-serif; }
        body { background: #f6f8fb; }
        .input-field { transition: all 0.2s; }
        .input-field:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.12); }
        .btn-login { background: #2563eb; transition: all 0.2s; }
        .btn-login:hover { background: #1d4ed8; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <div class="flex items-center space-x-3 mb-8">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-black text-sm" style="background:#2563eb;">UP</div>
                <div>
                    <h1 class="font-black text-gray-900 text-sm leading-none">Университет платформасы</h1>
                    <p class="text-gray-400 text-[10px] mt-0.5 font-medium">Студент жана админ үчүн кирүү</p>
                </div>
            </div>
            <h2 class="font-black text-gray-900 text-2xl mb-1">Аккаунтка кирүү</h2>
            <p class="text-gray-500 text-sm mb-7 font-medium">Email жана сырсөздү жазыңыз. Роль автоматтык аныкталат.</p>
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 mb-5 text-sm font-semibold">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first() }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="student@oshsu.kg"
                        class="input-field w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 outline-none text-sm font-medium text-gray-800">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Сыр сөз</label>
                    <input type="password" name="password" required
                        placeholder="••••••••"
                        class="input-field w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 outline-none text-sm font-medium text-gray-800">
                </div>
                <button type="submit" class="btn-login w-full text-white py-3.5 rounded-xl font-black text-sm uppercase tracking-widest">
                    Кирүү
                </button>
            </form>
            <p class="text-center text-xs text-gray-400 mt-6">
                <a href="/" class="text-blue-700 font-black hover:underline"><i class="fas fa-arrow-left mr-1"></i>Башкы бетке</a>
            </p>
            <div class="mt-4 grid grid-cols-1 gap-2">
                <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-100">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Тест аккаунт</p>
                <p class="text-xs font-medium text-gray-600">student@oshsu.kg / student12345</p>
                </div>
                <div class="bg-blue-50 rounded-xl px-4 py-3 border border-blue-100">
                    <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1">Админ аккаунт</p>
                    <p class="text-xs font-medium text-gray-700">admin@oshsu.kg / admin12345</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
