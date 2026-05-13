<!DOCTYPE html>
<html lang="kg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Университет Платформасы</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        .hero-bg {
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1523050853051-f750004c4139?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }
        .form-gradient { background: linear-gradient(135deg, #1d4ed8 0%, #0f172a 100%); }
        .qr-card {
            background: repeating-conic-gradient(#f8fafc 0% 25%, #ffffff 0% 50%) 50% / 20px 20px;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-graduation-cap text-blue-600 text-3xl"></i>
                <div>
                    <h1 class="font-bold text-sm uppercase leading-tight tracking-tighter">УНИВЕРСИТЕТ ПЛАТФОРМАСЫ</h1>
                    <p class="text-xs text-gray-400 font-medium tracking-widest">OSHU UNIVERSITY</p>
                </div>
            </div>
            
            <div class="hidden md:flex space-x-8 font-bold text-[11px] uppercase tracking-[0.2em]">
                <a href="/" class="text-blue-600 border-b-2 border-blue-600 pb-1">Главная</a>
                <a href="#events" class="text-gray-500 hover:text-blue-600 transition">Иш-чаралар</a>
                <a href="#rating" class="text-gray-500 hover:text-blue-600 transition">Рейтинг</a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/dashboard" class="text-gray-500 hover:text-blue-600 transition">Админ</a>
                    @else
                        <a href="/student" class="text-gray-500 hover:text-blue-600 transition">Студент панели</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center">
                @auth
                    <div class="flex items-center space-x-4 border-l pl-4">
                        <div class="text-right">
                            <p class="text-[9px] text-blue-500 font-black uppercase leading-none">Студент</p>
                            <span class="text-xs font-black text-slate-800">{{ auth()->user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-red-500 transition">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-slate-900 text-white text-[10px] font-black rounded-lg hover:bg-blue-600 transition uppercase tracking-widest shadow-xl">
                        Войти
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="hero-bg h-[500px] flex items-center text-white text-center md:text-left">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl">
                <span class="bg-blue-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 inline-block">Окуу жана активдүүлүк</span>
                <h2 class="text-5xl md:text-7xl font-black mb-6 uppercase leading-[0.9] tracking-tighter">Студенттин <br><span class="text-blue-400">бирдиктүү порталы</span></h2>
                <p class="text-lg mb-10 text-gray-200 font-light max-w-xl">Иш-чараларга катталыңыз, сертификат жүктөңүз жана жетишкендик статусун студент панелден көзөмөлдөңүз.</p>
                <div class="flex space-x-4">
                    <a href="#events" class="bg-white text-slate-900 px-8 py-4 rounded-lg font-black text-xs uppercase tracking-widest hover:bg-blue-500 hover:text-white transition shadow-2xl">Иш-чаралар</a>
                    <a href="#achievement-form" class="bg-transparent border border-white/30 px-8 py-4 rounded-lg font-black text-xs uppercase tracking-widest hover:bg-white/10 transition">Жетишкендик жүктөө</a>
                </div>
            </div>
        </div>
    </section>

    <section id="events" class="py-24 bg-white">
        <div class="container mx-auto px-6 text-center mb-16">
            <h3 class="text-4xl font-black uppercase tracking-tighter text-slate-900">Жакынкы иш-чаралар</h3>
            <p class="text-gray-400 mt-2 font-medium tracking-widest uppercase text-[10px]">Онлайн катталып, катышууңузду белгилеңиз</p>
        </div>

        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($events as $event)
                <div class="group bg-gray-50 rounded-[2rem] p-8 border border-gray-100 hover:bg-white hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition">
                        <i class="fas fa-calendar-alt text-7xl"></i>
                    </div>
                    
                    <span class="text-blue-600 font-black text-[10px] uppercase tracking-widest block mb-4">
                        <i class="fas fa-map-marker-alt mr-2"></i>{{ $event->location ?? 'Университет' }}
                    </span>
                    <h4 class="text-xl font-black text-slate-800 mb-4 uppercase leading-tight">{{ $event->title }}</h4>
                    <p class="text-gray-500 text-sm mb-8 line-clamp-3 font-light">{{ $event->description }}</p>
                    
                    <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-200/50">
                        <div class="text-left">
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Дата проведения</p>
                            <p class="text-sm font-black text-slate-700">
                                {{ \Carbon\Carbon::parse($event->event_date)->format('d.m.Y') }}
                            </p>
                        </div>
                        
                        @auth
                            @php 
                                // Катышууну текшерүү (Эгер мамилеси бар болсо)
                                $isJoined = auth()->user()->events && auth()->user()->events->contains($event->id);
                            @endphp

                            @if($isJoined)
                                <div class="relative group/qr">
                                    <button class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-lg text-[10px] font-black uppercase">Катталдыңыз</button>
                                    <div class="absolute bottom-full right-0 mb-4 hidden group-hover/qr:block z-50">
                                        <div class="bg-white p-4 rounded-2xl shadow-2xl border border-gray-100 text-center w-48">
                                            <p class="text-[9px] font-bold text-gray-400 mb-2 uppercase">Сиздин QR</p>
                                            @if(class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode'))
                                                {!! QrCode::size(120)->margin(1)->generate(route('home')) !!}
                                            @else
                                                <div class="text-[8px] text-red-500">QR пакет орнотулган эмес</div>
                                            @endif
                                            <p class="mt-2 text-[8px] font-black text-blue-600 uppercase">Scan at entrance</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('events.join', $event->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg text-[10px] font-black uppercase hover:bg-slate-900 transition">Катталуу</button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-blue-600 text-[10px] font-black uppercase underline decoration-2 underline-offset-4">Войти</a>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-gray-400 font-medium">
                    <i class="fas fa-calendar-times text-4xl mb-4 block opacity-20"></i>
                    Иш-чаралар азырынча жок.
                </div>
            @endforelse
        </div>
    </section>

    <section id="rating" class="py-24 bg-slate-900 text-white overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none qr-card"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-black uppercase tracking-widest">Топ студенттер</h3>
                <p class="text-blue-400 text-[10px] font-bold uppercase tracking-[0.3em] mt-4">Тастыкталган жетишкендиктер боюнча рейтинг</p>
            </div>

            <div class="max-w-4xl mx-auto space-y-4">
                @forelse($topStudents as $index => $student)
                    <div class="flex items-center justify-between p-6 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 transition duration-300">
                        <div class="flex items-center space-x-6">
                            <span class="text-2xl font-black {{ $index == 0 ? 'text-yellow-500' : 'text-gray-400' }}">0{{ $index + 1 }}</span>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=random" class="w-12 h-12 rounded-full ring-2 ring-blue-500/30">
                            <div>
                                <h5 class="font-black text-sm uppercase tracking-tight">{{ $student->name }}</h5>
                                <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">Active Member</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-xl font-black text-blue-400">{{ $student->achievements_count }}</span>
                            <span class="block text-[8px] font-black text-gray-500 uppercase">Points</span>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 uppercase text-xs tracking-widest">Рейтинг азырынча бош</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="achievement-form" class="py-24 container mx-auto px-6">
        <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden flex flex-col lg:flex-row border border-gray-100">
            <div class="lg:w-1/3 form-gradient p-16 text-white flex flex-col justify-center">
                <i class="fas fa-medal text-6xl mb-8 opacity-30"></i>
                <h3 class="text-4xl font-black mb-6 uppercase leading-none">Сиздин <br>жетишкендик</h3>
                <p class="text-blue-100 text-sm mb-10 font-light leading-relaxed">Диплом же сертификатты жүктөңүз. Администратор текшергенден кийин ал профилиңизде жана рейтингде көрүнөт.</p>
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 border border-white/20 flex items-center justify-center font-black text-xs">1</div>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Загрузка</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 border border-white/20 flex items-center justify-center font-black text-xs">2</div>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Проверка</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 border border-white/20 flex items-center justify-center font-black text-xs">3</div>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Рейтинг</span>
                    </div>
                </div>
            </div>

            <div class="lg:w-2/3 p-16 bg-white">
                @auth
                    @if(session('message'))
                        <div class="mb-10 p-5 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 flex items-center font-bold text-sm">
                            <i class="fas fa-check-circle mr-3 text-lg"></i> {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{ route('achievement.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 tracking-[0.2em]">Название достижения</label>
                            <input type="text" name="title" required placeholder="Напр: 1-ое место на Хакатоне 2026" 
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl p-5 outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-medium text-sm">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 tracking-[0.2em]">Дата</label>
                                <input type="date" name="event_date" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl p-5 font-medium text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 tracking-[0.2em]">Документ (PDF/IMG)</label>
                                <input type="file" name="file" required class="w-full text-xs file:mr-4 file:py-4 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white py-6 rounded-2xl font-black uppercase tracking-[0.3em] hover:bg-blue-600 transition shadow-xl active:scale-95">Администраторго жөнөтүү</button>
                    </form>
                @else
                    <div class="text-center py-10">
                        <i class="fas fa-fingerprint text-6xl text-gray-100 mb-6"></i>
                        <h4 class="text-xl font-black text-slate-800 uppercase mb-4 tracking-tighter">Нужна Авторизация</h4>
                        <p class="text-gray-400 mb-8 font-light italic text-sm">Только зарегистрированные студенты могут подавать заявки на подтверждение достижений.</p>
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-10 py-4 rounded-xl font-black uppercase text-[10px] tracking-widest shadow-lg inline-block hover:bg-blue-700 transition">Вход в систему</a>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    <footer class="bg-white py-16 border-t border-gray-100">
        <div class="container mx-auto px-6 text-center">
            <div class="flex items-center justify-center space-x-3 mb-8">
                <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <span class="font-black text-slate-900 uppercase tracking-widest text-sm">Osh State University</span>
            </div>
            <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.5em]">&copy; 2026 Developed by Jumagul</p>
        </div>
    </footer>

</body>
</html>
