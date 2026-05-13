<!DOCTYPE html>
<html lang="kg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студент Панели | UP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Manrope', sans-serif; }
        :root {
            --crimson: #2563EB;
            --crimson-dark: #1E40AF;
            --crimson-light: #3B82F6;
            --gold: #10B981;
        }
        body { background: #F6F8FB; color: #111827; }

        /* Sidebar */
        .sidebar { background: linear-gradient(180deg, #0F172A 0%, #1E3A8A 100%); }
        .sidebar-link { transition: all 0.2s; border-radius: 12px; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(37,99,235,0.28); }
        .sidebar-link.active { background: var(--crimson); box-shadow: 0 4px 20px rgba(37,99,235,0.35); }

        /* Cards */
        .stat-card { background: white; border-radius: 20px; border: 1px solid rgba(0,0,0,0.06); }
        .achievement-card { background: white; border-radius: 16px; border: 1px solid rgba(0,0,0,0.06); transition: all 0.2s; }
        .achievement-card:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.08); }

        /* Status badges */
        .badge-approved { background: #ECFDF5; color: #059669; border: 1px solid #A7F3D0; }
        .badge-pending  { background: #FFFBEB; color: #D97706; border: 1px solid #FDE68A; }
        .badge-rejected { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

        /* Tabs */
        .tab-btn { transition: all 0.2s; }
        .tab-btn.active { background: var(--crimson); color: white; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        /* Progress bar */
        .progress-bar { background: linear-gradient(90deg, var(--crimson), var(--gold)); border-radius: 99px; }

        /* Event card */
        .event-card { border-left: 4px solid var(--crimson); }

        /* Notification dot */
        .notif-dot { background: #EF4444; width: 8px; height: 8px; border-radius: 50%; display: inline-block; }

        /* Mobile sidebar */
        .mobile-sidebar { transform: translateX(-100%); transition: transform 0.3s; }
        .mobile-sidebar.open { transform: translateX(0); }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 99px; }

        /* File upload zone */
        .upload-zone { border: 2px dashed #e5e7eb; border-radius: 12px; transition: all 0.2s; }
        .upload-zone:hover { border-color: var(--crimson); background: #EFF6FF; }

        /* Animation */
        @keyframes fadeInUp { from { opacity:0; transform: translateY(16px); } to { opacity:1; transform: translateY(0); } }
        .fade-in { animation: fadeInUp 0.4s ease both; }
        .fade-in-1 { animation-delay: 0.05s; }
        .fade-in-2 { animation-delay: 0.1s; }
        .fade-in-3 { animation-delay: 0.15s; }
        .fade-in-4 { animation-delay: 0.2s; }
    </style>
</head>
<body>

{{-- MOBILE OVERLAY --}}
<div id="overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" onclick="closeSidebar()"></div>

{{-- ====== SIDEBAR ====== --}}
<div id="sidebar" class="mobile-sidebar lg:translate-x-0 fixed top-0 left-0 h-full w-64 sidebar z-40 flex flex-col">
    {{-- Logo --}}
    <div class="px-6 py-6 border-b border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white text-sm" style="background: var(--crimson);">UP</div>
            <div>
                <p class="text-white font-black text-sm leading-none">Студент панели</p>
                <p class="text-gray-500 text-[10px] mt-0.5 font-medium">Иш-чара жана жетишкендик</p>
            </div>
        </div>
    </div>

    {{-- Nav links --}}
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <p class="text-gray-600 text-[10px] font-black uppercase tracking-widest px-3 mb-3">Негизги</p>
        <a href="#" class="sidebar-link active flex items-center space-x-3 px-3 py-2.5 text-white" onclick="showTab('home')">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="text-sm font-semibold">Башкы бет</span>
        </a>
        <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-400" onclick="showTab('events')">
            <i class="fas fa-calendar-alt w-5 text-center"></i>
            <span class="text-sm font-semibold">Иш-чаралар</span>
        </a>
        <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-400" onclick="showTab('achievements')">
            <i class="fas fa-trophy w-5 text-center"></i>
            <span class="text-sm font-semibold">Жетишкендиктер</span>
        </a>
        <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-400" onclick="showTab('upload')">
            <i class="fas fa-upload w-5 text-center"></i>
            <span class="text-sm font-semibold">Жүктөө</span>
        </a>

        <div class="pt-4">
            <p class="text-gray-600 text-[10px] font-black uppercase tracking-widest px-3 mb-3">Аккаунт</p>
            <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-400" onclick="showTab('notifications')">
                <i class="fas fa-bell w-5 text-center"></i>
                <span class="text-sm font-semibold">Билдирүүлөр</span>
                @if($notifications->where('status','pending')->count() > 0)
                    <span class="ml-auto bg-red-500 text-white text-[9px] font-black px-2 py-0.5 rounded-full">{{ $notifications->where('status','pending')->count() }}</span>
                @endif
            </a>
            <a href="#" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-400" onclick="showTab('profile')">
                <i class="fas fa-user-circle w-5 text-center"></i>
                <span class="text-sm font-semibold">Профиль</span>
            </a>
        </div>
    </nav>

    {{-- Bottom: User + logout --}}
    <div class="px-4 py-4 border-t border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-black text-sm flex-shrink-0" style="background: var(--crimson);">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white text-xs font-bold truncate">{{ $user->name }}</p>
                <p class="text-gray-500 text-[10px] truncate">{{ $user->email }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-500 hover:text-red-400 transition" title="Чыгуу">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ====== MAIN CONTENT ====== --}}
<div class="lg:ml-64 min-h-screen">

    {{-- TOP BAR --}}
    <header class="bg-white border-b border-gray-100 sticky top-0 z-20 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button onclick="openSidebar()" class="lg:hidden text-gray-400 hover:text-gray-700">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div>
                <h2 class="font-black text-gray-900 text-sm" id="page-title">Башкы бет</h2>
                <p class="text-gray-400 text-[10px] font-medium">Университеттик ачык платформа</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <a href="/" class="text-[10px] font-black text-gray-400 hover:text-gray-700 uppercase tracking-widest hidden md:block">
                <i class="fas fa-globe mr-1"></i> Сайт
            </a>
            @if(Auth::user()->role === 'admin')
                <a href="/admin/dashboard" class="px-4 py-2 rounded-xl text-[10px] font-black uppercase text-white tracking-widest" style="background: var(--crimson);">
                    <i class="fas fa-user-shield mr-1"></i> Админ панель
                </a>
            @endif
        </div>
    </header>

    {{-- ALERTS --}}
    <div class="px-6 pt-4">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-5 py-4 flex items-center space-x-3 mb-4 fade-in">
                <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-400 hover:text-emerald-600"><i class="fas fa-times"></i></button>
            </div>
        @endif
        @if(session('message'))
            <div class="bg-blue-50 border border-blue-200 text-blue-700 rounded-xl px-5 py-4 flex items-center space-x-3 mb-4 fade-in">
                <i class="fas fa-info-circle text-blue-500 text-lg"></i>
                <span class="text-sm font-semibold">{{ session('message') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-blue-400 hover:text-blue-600"><i class="fas fa-times"></i></button>
            </div>
        @endif
    </div>

    {{-- CONTENT AREA --}}
    <main class="px-6 py-6">

        {{-- ========== HOME TAB ========== --}}
        <div id="tab-home" class="tab-content active">
            {{-- Welcome --}}
            <div class="rounded-2xl p-6 mb-6 text-white fade-in" style="background: linear-gradient(135deg, #1D4ED8, #0F172A);">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-red-200 text-xs font-semibold mb-1">СТУДЕНТ ПАНЕЛИ</p>
                        <h1 class="text-2xl font-black mb-2">Салам, {{ explode(' ', $user->name)[0] }}! 👋</h1>
                        <p class="text-red-200 text-sm font-medium leading-relaxed max-w-md">
                            Бул жерде университеттеги иш-чараларды көрүп, жетишкендиктериңизди жүктөп, текшерүү статусун көзөмөлдөй аласыз.
                        </p>
                        <div class="flex space-x-3 mt-5">
                            <button onclick="showTab('upload')" class="bg-white text-gray-900 px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-gray-100 transition">
                                <i class="fas fa-upload mr-1.5"></i> Жетишкендик жүктөө
                            </button>
                            <button onclick="showTab('achievements')" class="border border-white/30 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-white/10 transition">
                                Статустарды көрүү
                            </button>
                        </div>
                    </div>
                    <div class="hidden md:block text-right">
                        <div class="text-5xl font-black text-white/20">{{ strtoupper(substr($user->name,0,2)) }}</div>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="stat-card p-5 fade-in fade-in-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Жакынкы иш-чара</p>
                    <h3 class="text-3xl font-black text-gray-900">{{ $stats['upcoming'] }}</h3>
                    <p class="text-[10px] text-blue-500 font-semibold mt-1"><i class="fas fa-calendar mr-1"></i>Пландалган</p>
                </div>
                <div class="stat-card p-5 fade-in fade-in-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Тастыкталган</p>
                    <h3 class="text-3xl font-black text-emerald-600">{{ $stats['approved'] }}</h3>
                    <p class="text-[10px] text-emerald-500 font-semibold mt-1"><i class="fas fa-check-circle mr-1"></i>Жетишкендик</p>
                </div>
                <div class="stat-card p-5 fade-in fade-in-3">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Текшерүүдө</p>
                    <h3 class="text-3xl font-black text-amber-500">{{ $stats['pending'] }}</h3>
                    <p class="text-[10px] text-amber-500 font-semibold mt-1"><i class="fas fa-clock mr-1"></i>Күтүүдө</p>
                </div>
                <div class="stat-card p-5 fade-in fade-in-4">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Профиль</p>
                    <h3 class="text-3xl font-black text-gray-900">{{ $profilePercent }}%</h3>
                    <div class="mt-2 bg-gray-100 rounded-full h-1.5">
                        <div class="progress-bar h-1.5" style="width: {{ $profilePercent }}%"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Upcoming events --}}
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-black text-gray-900 text-sm uppercase tracking-wide">Жакынкы иш-чаралар</h3>
                        <button onclick="showTab('events')" class="text-xs font-bold text-blue-700 hover:underline">Бардык иш-чаралар →</button>
                    </div>
                    <div class="space-y-3">
                        @forelse($upcomingEvents as $event)
                            <div class="achievement-card p-4 event-card">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 text-center bg-red-50 rounded-xl px-3 py-2 w-14">
                                        <p class="text-blue-700 font-black text-xl leading-none">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</p>
                                        <p class="text-red-400 text-[9px] font-black uppercase">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('M') }}</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-gray-900 text-sm truncate">{{ $event->title }}</h4>
                                        <p class="text-gray-400 text-xs mt-0.5">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $event->location ?? 'Университет' }}
                                        </p>
                                        <p class="text-gray-500 text-xs mt-1 line-clamp-1">{{ $event->description }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        @if($joinedEventIds->contains($event->id))
                                            <span class="badge-approved text-[10px] font-black px-2.5 py-1 rounded-full">Катталдыңыз</span>
                                        @else
                                            <form action="{{ route('events.join', $event->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-white text-[10px] font-black px-3 py-1.5 rounded-lg hover:opacity-80 transition" style="background: var(--crimson);">
                                                    Катталуу
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-400">
                                <i class="fas fa-calendar-times text-3xl mb-3 block opacity-30"></i>
                                <p class="text-sm font-medium">Жакынкы иш-чаралар жок</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Profile card + notifications --}}
                <div class="space-y-4">
                    {{-- Profile mini --}}
                    <div class="bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white font-black text-lg flex-shrink-0" style="background: var(--crimson);">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="font-black text-gray-900 text-sm">{{ $user->name }}</h4>
                                <p class="text-gray-400 text-xs">{{ $user->faculty ?? 'Факультет белгисиз' }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-gray-400 font-medium">Тайпа</span>
                                <span class="font-bold text-gray-700">{{ $user->group_name ?? '—' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400 font-medium">Курс</span>
                                <span class="font-bold text-gray-700">{{ $user->course ?? '—' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400 font-medium">Email</span>
                                <span class="font-bold text-gray-700 truncate max-w-[120px]">{{ $user->email }}</span>
                            </div>
                        </div>
                        <button onclick="showTab('upload')" class="mt-4 w-full text-white text-xs font-black py-2.5 rounded-xl hover:opacity-90 transition" style="background: var(--crimson);">
                            <i class="fas fa-plus mr-1"></i> Сертификат кошуу
                        </button>
                    </div>

                    {{-- Notifications mini --}}
                    <div class="bg-white rounded-2xl border border-gray-100 p-5">
                        <h4 class="font-black text-gray-900 text-xs uppercase tracking-widest mb-3">Билдирүүлөр</h4>
                        <div class="space-y-3">
                            @forelse($notifications->take(3) as $notif)
                                <div class="flex items-start space-x-2">
                                    <span class="mt-1.5 flex-shrink-0">
                                        @if($notif->status === 'approved')
                                            <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                                        @elseif($notif->status === 'rejected')
                                            <i class="fas fa-times-circle text-red-500 text-sm"></i>
                                        @else
                                            <i class="fas fa-clock text-amber-500 text-sm"></i>
                                        @endif
                                    </span>
                                    <p class="text-xs text-gray-600 leading-snug">
                                        <span class="font-bold">{{ Str::limit($notif->title, 25) }}</span>
                                        @if($notif->status === 'approved') <span class="text-emerald-600"> — сайтка жарыяланды</span>
                                        @elseif($notif->status === 'rejected') <span class="text-red-600"> — четке кагылды</span>
                                        @else <span class="text-amber-600"> — текшерүүдө</span>
                                        @endif
                                    </p>
                                </div>
                            @empty
                                <p class="text-xs text-gray-400 text-center py-2">Билдирүүлөр жок</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========== EVENTS TAB ========== --}}
        <div id="tab-events" class="tab-content">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="font-black text-gray-900 text-lg">Иш-чаралар</h2>
                    <p class="text-gray-400 text-xs font-medium mt-0.5">Жакынкы жана учурдагы иш-чаралар</p>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($upcomingEvents as $event)
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-all">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-red-50 rounded-2xl px-4 py-3 text-center">
                                    <p class="text-blue-700 font-black text-2xl leading-none">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</p>
                                    <p class="text-red-400 text-[10px] font-black uppercase mt-0.5">{{ \Carbon\Carbon::parse($event->event_date)->format('M Y') }}</p>
                                </div>
                                <div>
                                    <h3 class="font-black text-gray-900 text-base mb-1">{{ $event->title }}</h3>
                                    <div class="flex items-center space-x-4 text-xs text-gray-400 font-medium mb-2">
                                        <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $event->location ?? 'Университет' }}</span>
                                        @if($event->max_participants)
                                            <span><i class="fas fa-users mr-1"></i>{{ $event->max_participants }} орун</span>
                                        @endif
                                    </div>
                                    <p class="text-gray-500 text-sm leading-relaxed max-w-lg">{{ $event->description }}</p>
                                    @php
                                        $days = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($event->event_date), false);
                                    @endphp
                                    @if($days >= 0 && $days <= 7)
                                        <span class="inline-block mt-2 bg-amber-50 text-amber-600 border border-amber-200 text-[10px] font-black px-2 py-1 rounded-full uppercase">
                                            {{ $days == 0 ? 'Бүгүн!' : $days . ' күн калды' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-shrink-0 ml-4">
                                @if($joinedEventIds->contains($event->id))
                                    <span class="badge-approved text-xs font-black px-3 py-1.5 rounded-full">
                                        <i class="fas fa-check mr-1"></i>Катталдыңыз
                                    </span>
                                @else
                                    <form action="{{ route('events.join', $event->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-white text-xs font-black px-5 py-2 rounded-xl hover:opacity-80 transition" style="background: var(--crimson);">
                                            <i class="fas fa-plus mr-1"></i> Катталуу
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 text-gray-400">
                        <i class="fas fa-calendar-times text-5xl mb-4 block opacity-20"></i>
                        <p class="font-bold text-sm">Иш-чаралар азырынча жок</p>
                        <p class="text-xs mt-1">Администратор иш-чара кошкондо бул жерде пайда болот</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ========== ACHIEVEMENTS TAB ========== --}}
        <div id="tab-achievements" class="tab-content">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="font-black text-gray-900 text-lg">Менин жетишкендиктерим</h2>
                    <p class="text-gray-400 text-xs font-medium mt-0.5">Жүктөлгөн жана тастыкталган жетишкендиктер</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="showTab('upload')" class="text-white text-xs font-black px-4 py-2 rounded-xl hover:opacity-80 transition" style="background: var(--crimson);">
                        <i class="fas fa-plus mr-1"></i> Жаңы жүктөө
                    </button>
                </div>
            </div>

            {{-- Filter tabs --}}
            <div class="flex space-x-2 mb-5">
                <button class="tab-btn active text-xs font-black px-4 py-2 rounded-lg border border-gray-200" onclick="filterAchievements('all', this)">Баары ({{ $achievements->count() }})</button>
                <button class="tab-btn text-xs font-black px-4 py-2 rounded-lg border border-gray-200 text-gray-500" onclick="filterAchievements('approved', this)">Тастыкталган ({{ $stats['approved'] }})</button>
                <button class="tab-btn text-xs font-black px-4 py-2 rounded-lg border border-gray-200 text-gray-500" onclick="filterAchievements('pending', this)">Текшерүүдө ({{ $stats['pending'] }})</button>
                <button class="tab-btn text-xs font-black px-4 py-2 rounded-lg border border-gray-200 text-gray-500" onclick="filterAchievements('rejected', this)">Четке кагылган ({{ $stats['rejected'] }})</button>
            </div>

            <div id="achievement-list" class="space-y-3">
                @forelse($achievements as $ach)
                    <div class="achievement-card p-5 achievement-item" data-status="{{ $ach->status }}">
                        <div class="flex items-start space-x-4">
                            {{-- Icon --}}
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0
                                @if($ach->status === 'approved') bg-emerald-50
                                @elseif($ach->status === 'rejected') bg-red-50
                                @else bg-amber-50 @endif">
                                @if($ach->status === 'approved')
                                    <i class="fas fa-trophy text-emerald-500 text-xl"></i>
                                @elseif($ach->status === 'rejected')
                                    <i class="fas fa-times text-red-400 text-xl"></i>
                                @else
                                    <i class="fas fa-hourglass-half text-amber-400 text-xl"></i>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h4 class="font-black text-gray-900 text-sm mb-1">{{ $ach->title }}</h4>
                                        @if($ach->description)
                                            <p class="text-gray-400 text-xs mb-2 line-clamp-1">{{ $ach->description }}</p>
                                        @endif
                                        <p class="text-gray-300 text-[10px] font-medium">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ \Carbon\Carbon::parse($ach->event_date)->format('d.m.Y') }}
                                        </p>
                                        @if($ach->admin_comment && $ach->status === 'rejected')
                                            <div class="mt-2 bg-red-50 border border-red-100 rounded-lg px-3 py-2">
                                                <p class="text-[10px] font-black text-red-400 uppercase mb-0.5">Администратордун комментарийи:</p>
                                                <p class="text-xs text-red-600">{{ $ach->admin_comment }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-3 ml-4">
                                        @if($ach->file_path)
                                            <a href="{{ asset('storage/' . $ach->file_path) }}" target="_blank"
                                               class="text-[10px] font-black text-blue-600 hover:underline flex items-center">
                                                <i class="fas fa-file mr-1"></i> Файл
                                            </a>
                                        @endif
                                        <span class="text-[10px] font-black px-3 py-1 rounded-full
                                            @if($ach->status === 'approved') badge-approved
                                            @elseif($ach->status === 'rejected') badge-rejected
                                            @else badge-pending @endif">
                                            @if($ach->status === 'approved') Тастыкталды
                                            @elseif($ach->status === 'rejected') Четке кагылды
                                            @else Текшерүүдө @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 text-gray-400">
                        <i class="fas fa-trophy text-5xl mb-4 block opacity-20"></i>
                        <p class="font-bold text-sm">Жетишкендиктер азырынча жок</p>
                        <p class="text-xs mt-1 mb-4">Дипломуңузду же сертификатыңызды жүктөп, тастыктатыңыз</p>
                        <button onclick="showTab('upload')" class="text-white text-xs font-black px-5 py-2.5 rounded-xl hover:opacity-80 transition" style="background: var(--crimson);">
                            <i class="fas fa-upload mr-1"></i> Жетишкендик жүктөө
                        </button>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ========== UPLOAD TAB ========== --}}
        <div id="tab-upload" class="tab-content">
            <div class="max-w-2xl mx-auto">
                <div class="mb-6">
                    <h2 class="font-black text-gray-900 text-lg">Жетишкендик жүктөө</h2>
                    <p class="text-gray-400 text-xs font-medium mt-0.5">
                        <span class="text-blue-600 font-bold">Администратор текшерет</span> — жүктөгөндөн кийин статус бул жерде көрүнөт
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-8">
                    <form action="{{ route('student.achievement.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Жетишкендиктин аталышы *</label>
                            <input type="text" name="title" required placeholder="Мисалы: Математика боюнча олимпиада"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 outline-none focus:ring-2 focus:border-red-500 transition text-sm font-medium"
                                style="--tw-ring-color: rgba(139,26,26,0.2);">
                            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Байланышкан иш-чара</label>
                                <input type="text" name="event_name" placeholder="Хакатон, турнир, конкурс"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 outline-none focus:ring-2 transition text-sm font-medium">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Орун же жыйынтык</label>
                                <input type="text" name="place" placeholder="1-орун"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 outline-none focus:ring-2 transition text-sm font-medium">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Кыскача сүрөттөмө</label>
                            <textarea name="description" rows="3" placeholder="Жетишкендик тууралуу кыскача маалымат жазыңыз"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 outline-none focus:ring-2 transition text-sm font-medium resize-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Диплом же сертификат файлы *</label>
                            <div class="upload-zone p-6 text-center cursor-pointer" onclick="document.getElementById('file-input').click()">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2 block"></i>
                                <p class="text-sm font-bold text-gray-500">Файлды сүйрөп таштаңыз же чыкылдатыңыз</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, PDF — максимум 5MB</p>
                                <p id="file-name" class="text-xs font-bold text-red-600 mt-2 hidden"></p>
                            </div>
                            <input type="file" id="file-input" name="file" required accept=".jpg,.jpeg,.png,.pdf" class="hidden"
                                onchange="document.getElementById('file-name').textContent = this.files[0].name; document.getElementById('file-name').classList.remove('hidden')">
                            @error('file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Process steps --}}
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Текшерүү процесси</p>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 rounded-full text-white flex items-center justify-center text-[10px] font-black" style="background: var(--crimson);">1</div>
                                    <span class="text-xs font-bold text-gray-600">Жүктөө</span>
                                </div>
                                <div class="flex-1 h-px bg-gray-200"></div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-[10px] font-black">2</div>
                                    <span class="text-xs font-bold text-gray-400">Текшерүү</span>
                                </div>
                                <div class="flex-1 h-px bg-gray-200"></div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-[10px] font-black">3</div>
                                    <span class="text-xs font-bold text-gray-400">Жарыялоо</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full text-white py-4 rounded-xl font-black uppercase tracking-widest text-sm hover:opacity-90 transition" style="background: var(--crimson);">
                            <i class="fas fa-paper-plane mr-2"></i> Текшерүүгө жөнөтүү
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ========== NOTIFICATIONS TAB ========== --}}
        <div id="tab-notifications" class="tab-content">
            <div class="mb-6">
                <h2 class="font-black text-gray-900 text-lg">Билдирүүлөр</h2>
                <p class="text-gray-400 text-xs font-medium mt-0.5">Жетишкендиктериңиздин статусу жана өзгөрүүлөр</p>
            </div>

            <div class="max-w-2xl space-y-3">
                @forelse($notifications as $notif)
                    <div class="bg-white rounded-2xl border border-gray-100 p-5 flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                            @if($notif->status === 'approved') bg-emerald-50
                            @elseif($notif->status === 'rejected') bg-red-50
                            @else bg-amber-50 @endif">
                            @if($notif->status === 'approved')
                                <i class="fas fa-check-circle text-emerald-500"></i>
                            @elseif($notif->status === 'rejected')
                                <i class="fas fa-times-circle text-red-400"></i>
                            @else
                                <i class="fas fa-clock text-amber-400"></i>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-900">{{ $notif->title }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                @if($notif->status === 'approved')
                                    ✅ Жетишкендигиңиз тастыкталды жана сайтка жарыяланды
                                @elseif($notif->status === 'rejected')
                                    ❌ Жетишкендигиңиз четке кагылды
                                    @if($notif->admin_comment) — <span class="text-red-500">{{ $notif->admin_comment }}</span>@endif
                                @else
                                    🕐 Жетишкендигиңиз текшерүүдө, күтө туруңуз
                                @endif
                            </p>
                            <p class="text-[10px] text-gray-300 mt-1 font-medium">{{ $notif->updated_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-[10px] font-black px-3 py-1 rounded-full flex-shrink-0
                            @if($notif->status === 'approved') badge-approved
                            @elseif($notif->status === 'rejected') badge-rejected
                            @else badge-pending @endif">
                            @if($notif->status === 'approved') Тастыкталды
                            @elseif($notif->status === 'rejected') Четке кагылды
                            @else Текшерүүдө @endif
                        </span>
                    </div>
                @empty
                    <div class="text-center py-20 text-gray-400">
                        <i class="fas fa-bell text-5xl mb-4 block opacity-20"></i>
                        <p class="font-bold text-sm">Билдирүүлөр жок</p>
                        <p class="text-xs mt-1">Жетишкендик жүктөгөндөн кийин статус бул жерде көрүнөт</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ========== PROFILE TAB ========== --}}
        <div id="tab-profile" class="tab-content">
            <div class="max-w-2xl">
                <div class="mb-6">
                    <h2 class="font-black text-gray-900 text-lg">Профиль</h2>
                    <p class="text-gray-400 text-xs font-medium mt-0.5">Жеке маалыматтарыңызды жаңыртыңыз</p>
                </div>

                {{-- Profile card --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-5">
                    <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-gray-100">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white font-black text-2xl flex-shrink-0" style="background: var(--crimson);">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="font-black text-gray-900">{{ $user->name }}</h3>
                            <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <div class="bg-gray-100 rounded-full h-1.5 w-24">
                                    <div class="progress-bar h-1.5 rounded-full" style="width: {{ $profilePercent }}%"></div>
                                </div>
                                <span class="text-[10px] font-black text-gray-400">{{ $profilePercent }}% толтурулган</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Аты-жөнү *</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 outline-none focus:ring-2 transition text-sm font-medium">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Факультет</label>
                                <input type="text" name="faculty" value="{{ old('faculty', $user->faculty) }}" placeholder="Маалыматтык технологиялар"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 outline-none focus:ring-2 transition text-sm font-medium">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Тайпа (группа)</label>
                                <input type="text" name="group_name" value="{{ old('group_name', $user->group_name) }}" placeholder="ИС-21"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 outline-none focus:ring-2 transition text-sm font-medium">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Курс</label>
                                <select name="course" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 outline-none focus:ring-2 transition text-sm font-medium">
                                    <option value="">Тандаңыз</option>
                                    @for($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}" {{ $user->course == $i ? 'selected' : '' }}>{{ $i }}-курс</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Телефон</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+996 700 000 000"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 outline-none focus:ring-2 transition text-sm font-medium">
                        </div>

                        <button type="submit" class="text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:opacity-90 transition" style="background: var(--crimson);">
                            <i class="fas fa-save mr-1.5"></i> Сактоо
                        </button>
                    </form>
                </div>

                {{-- Change password --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h4 class="font-black text-gray-900 text-sm uppercase tracking-wide mb-5">Сырсөздү өзгөртүү</h4>
                    <form action="{{ route('student.password.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Учурдагы сырсөз</label>
                            <input type="password" name="current_password" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 outline-none focus:ring-2 transition text-sm font-medium">
                            @error('current_password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Жаңы сырсөз</label>
                                <input type="password" name="password" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 outline-none focus:ring-2 transition text-sm font-medium">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Ырастоо</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 outline-none focus:ring-2 transition text-sm font-medium">
                            </div>
                        </div>
                        <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-700 transition">
                            <i class="fas fa-lock mr-1.5"></i> Сырсөздү өзгөртүү
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
    // Tab switching
    function showTab(name) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        // Show target
        const target = document.getElementById('tab-' + name);
        if (target) target.classList.add('active');

        // Update sidebar links
        document.querySelectorAll('.sidebar-link').forEach(l => {
            l.classList.remove('active');
            l.classList.add('text-gray-400');
            l.classList.remove('text-white');
        });
        const activeLink = document.querySelector(`.sidebar-link[onclick*="${name}"]`);
        if (activeLink) {
            activeLink.classList.add('active', 'text-white');
            activeLink.classList.remove('text-gray-400');
        }

        // Update page title
        const titles = {
            home: 'Башкы бет',
            events: 'Иш-чаралар',
            achievements: 'Жетишкендиктер',
            upload: 'Жетишкендик жүктөө',
            notifications: 'Билдирүүлөр',
            profile: 'Профиль'
        };
        document.getElementById('page-title').textContent = titles[name] || 'Студент Панели';

        // Close mobile sidebar
        closeSidebar();
    }

    // Achievement filter
    function filterAchievements(status, btn) {
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('active');
            b.classList.add('text-gray-500');
        });
        btn.classList.add('active');
        btn.classList.remove('text-gray-500');

        document.querySelectorAll('.achievement-item').forEach(item => {
            if (status === 'all' || item.dataset.status === status) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Mobile sidebar
    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('overlay').classList.remove('hidden');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.add('hidden');
    }

    // Drag & drop upload
    const uploadZone = document.querySelector('.upload-zone');
    if (uploadZone) {
        uploadZone.addEventListener('dragover', e => {
            e.preventDefault();
            uploadZone.style.borderColor = '#2563EB';
            uploadZone.style.background = '#EFF6FF';
        });
        uploadZone.addEventListener('dragleave', () => {
            uploadZone.style.borderColor = '';
            uploadZone.style.background = '';
        });
        uploadZone.addEventListener('drop', e => {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            if (file) {
                const input = document.getElementById('file-input');
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                document.getElementById('file-name').textContent = file.name;
                document.getElementById('file-name').classList.remove('hidden');
            }
            uploadZone.style.borderColor = '';
            uploadZone.style.background = '';
        });
    }
</script>

</body>
</html>
