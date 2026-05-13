<!DOCTYPE html>
<html lang="kg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель | Университет</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&display=swap');
        body { font-family: 'Manrope', sans-serif; scroll-behavior: smooth; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#f6f8fb] text-slate-900">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-600 text-white p-2 rounded-lg">
                    <i class="fas fa-graduation-cap text-xl"></i>
                </div>
                <div>
                    <h1 class="font-black text-sm uppercase tracking-tighter">Админ панель</h1>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Студенттер жана иш-чаралар</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-6">
                <a href="/" class="text-xs font-bold uppercase text-gray-400 hover:text-blue-600 transition">Башкы бет</a>
                <div class="h-8 w-[1px] bg-gray-100"></div>
                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <p class="text-[10px] text-gray-400 font-black uppercase leading-none">Администратор</p>
                        <span class="text-sm font-bold">{{ auth()->user()->name }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-red-500 transition">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-10">
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4 text-sm font-semibold">
                <i class="fas fa-circle-exclamation mr-2"></i>{{ $errors->first() }}
            </div>
        @endif
        
        {{-- Статистика блогу --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                <i class="fas fa-clock absolute -right-4 -bottom-4 text-8xl text-gray-50 group-hover:text-blue-50 transition duration-500"></i>
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2 relative">Текшерилчү арыздар</p>
                <h3 class="text-4xl font-black text-blue-600 relative">{{ $achievements->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                <i class="fas fa-users absolute -right-4 -bottom-4 text-8xl text-gray-50 group-hover:text-emerald-50 transition duration-500"></i>
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2 relative">Студенты</p>
                <h3 class="text-4xl font-black text-slate-800 relative">{{ $students->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                <i class="fas fa-calendar-check absolute -right-4 -bottom-4 text-8xl text-gray-50 group-hover:text-emerald-50 transition duration-500"></i>
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2 relative">Иш-чаралар</p>
                <h3 class="text-4xl font-black text-slate-800 relative">{{ $events->count() }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <div class="lg:col-span-2 space-y-10">
                
                {{-- Заявкаларды текшерүү --}}
                <section>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-black uppercase tracking-tight text-slate-800">Жетишкендиктерди текшерүү</h2>
                        <span class="bg-blue-100 text-blue-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Админ текшерет</span>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50/50 border-b border-gray-100">
                                <tr>
                                    <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest">Студент</th>
                                    <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest">Жетишкендик</th>
                                    <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest text-center">Аракет</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($achievements as $req)
                                <tr class="hover:bg-gray-50/50 transition duration-300">
                                    <td class="p-6">
                                        <div class="flex items-center space-x-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($req->user->name) }}&background=random" class="w-10 h-10 rounded-full">
                                            <div>
                                                <div class="font-bold text-slate-800 text-sm">{{ $req->user->name }}</div>
                                                <div class="text-[10px] text-gray-400 font-medium">{{ $req->user->faculty }} | {{ $req->user->group_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="text-sm font-bold text-slate-700 leading-snug mb-1">{{ $req->title }}</div>
                                        <a href="{{ asset('storage/' . $req->file_path) }}" target="_blank" class="text-[10px] text-blue-600 font-black uppercase tracking-widest hover:underline italic">
                                            <i class="fas fa-file-alt mr-1"></i> Документ
                                        </a>
                                    </td>
                                    <td class="p-6 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <form action="{{ route('admin.status', $req->id) }}" method="POST">
                                                @csrf
                                                <button name="action" value="approve" class="bg-emerald-600 text-white px-3 py-2 rounded-lg hover:bg-emerald-700 transition text-[10px] font-black uppercase flex items-center justify-center gap-2">
                                                    <i class="fas fa-check text-xs"></i> Кабыл алуу
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.status', $req->id) }}" method="POST">
                                                @csrf
                                                <button name="action" value="reject" class="bg-white border border-gray-200 text-red-600 px-3 py-2 rounded-lg hover:bg-red-50 transition text-[10px] font-black uppercase flex items-center justify-center gap-2">
                                                    <i class="fas fa-times text-xs"></i> Четке кагуу
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="p-20 text-center text-gray-300 font-black uppercase text-[10px] tracking-widest">Жаңы арыз жок</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Студенттердин тизмеси --}}
                <section>
                    <h2 class="text-2xl font-black uppercase tracking-tight text-slate-800 mb-6">Бардык студенттер</h2>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="max-h-[400px] overflow-y-auto custom-scrollbar">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50/50 sticky top-0 z-10 border-b border-gray-100">
                                    <tr>
                                        <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest">ФИО жана окуу маалыматы</th>
                                        <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest">Email</th>
                                        <th class="p-6 text-[10px] font-black uppercase text-gray-400 tracking-widest text-center">Статус</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($students as $student)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="p-6">
                                            <div class="font-bold text-sm text-slate-800">{{ $student->name }}</div>
                                            <div class="text-[10px] font-bold text-blue-500 uppercase tracking-tight mt-1">
                                                {{ $student->faculty ?? 'Фак. жок' }} • {{ $student->group_name ?? 'Тайпа жок' }} • {{ $student->course }}-курс
                                            </div>
                                        </td>
                                        <td class="p-6 text-xs text-gray-400">{{ $student->email }}</td>
                                        <td class="p-6 text-center">
                                            <span class="bg-slate-100 text-slate-500 text-[9px] font-black px-3 py-1 rounded-full uppercase">Студент</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            {{-- Оң жактагы панель --}}
            <div class="lg:col-span-1 space-y-8">
                
                {{-- Лидерлер --}}
                <div class="bg-slate-900 p-8 rounded-[2rem] text-white shadow-2xl shadow-slate-200">
                    <h2 class="text-lg font-black uppercase tracking-widest mb-6 border-b border-slate-800 pb-4">Топ студенттер</h2>
                    <div class="space-y-4">
                        @foreach($students->sortByDesc(fn($s) => $s->achievements->where('status', 'approved')->count())->take(3) as $index => $top)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span class="text-slate-500 font-black text-xs">#{{ $index + 1 }}</span>
                                <div>
                                    <div class="text-sm font-bold truncate w-24">{{ $top->name }}</div>
                                    <div class="text-[8px] text-slate-500 uppercase">{{ $top->faculty }}</div>
                                </div>
                            </div>
                            <span class="bg-blue-600 text-[10px] px-2 py-1 rounded-lg font-black">{{ $top->achievements->where('status', 'approved')->count() }} 🏆</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Жаңы студент кошуу --}}
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    <h2 class="text-xl font-black uppercase tracking-tight text-slate-800 mb-6">Жаңы студент</h2>
                    <form action="{{ route('admin.student.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" name="name" placeholder="ФИО" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-sm outline-none focus:ring-2 focus:ring-blue-500/10 transition">
                        <input type="email" name="email" placeholder="Email" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-sm outline-none focus:ring-2 focus:ring-blue-500/10 transition">
                        
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" name="faculty" placeholder="Факультет" class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-[11px] outline-none transition">
                            <input type="text" name="group_name" placeholder="Тайпа" class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-[11px] outline-none transition">
                        </div>
                        
                        <select name="course" class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-sm outline-none transition text-gray-500">
                            <option value="">Курсту тандаңыз</option>
                            <option value="1">1-курс</option>
                            <option value="2">2-курс</option>
                            <option value="3">3-курс</option>
                            <option value="4">4-курс</option>
                        </select>

                        <input type="password" name="password" placeholder="Сырсөз" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-sm outline-none transition">
                        <button class="w-full bg-blue-600 text-white py-4 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-blue-700 transition">Каттоо</button>
                    </form>
                </div>

                {{-- Жаңы иш-чара түзүү --}}
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    <h2 class="text-xl font-black uppercase tracking-tight text-slate-800 mb-6">Жаңы иш-чара</h2>
                    <form action="{{ route('admin.events.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" name="title" placeholder="Иш-чаранын аталышы" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-sm outline-none transition">
                        <input type="date" name="event_date" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-sm outline-none transition">
                        <input type="text" name="location" placeholder="Өтүүчү жери" required class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-sm outline-none transition">
                        <textarea name="description" placeholder="Кыскача сүрөттөмө..." rows="3" class="w-full bg-gray-50 border-gray-100 rounded-xl p-4 text-sm outline-none transition"></textarea>
                        <button class="w-full bg-blue-600 text-white py-4 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-blue-700 transition">Жарыялоо</button>
                    </form>
                </div>

                {{-- Ивенттин катышуучулары --}}
                <div class="space-y-4">
                    <h2 class="text-xl font-black uppercase tracking-tight text-slate-800 mb-2">Иш-чара катышуучулары</h2>
                    @foreach($events as $event)
                    <div class="bg-white p-5 rounded-3xl border border-gray-100 mb-4">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-[10px] font-black uppercase text-blue-600 tracking-tighter truncate w-40">{{ $event->title }}</span>
                            <span class="bg-gray-100 text-gray-500 text-[8px] font-black px-2 py-1 rounded-md">{{ $event->users->count() }}</span>
                        </div>
                        <div class="flex -space-x-2">
                            @foreach($event->users->take(5) as $s)
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($s->name) }}&background=random" class="w-7 h-7 rounded-full border-2 border-white shadow-sm" title="{{ $s->name }} ({{ $s->faculty }})">
                            @endforeach
                            @if($event->users->count() > 5)
                                <div class="w-7 h-7 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center text-[8px] font-bold">+{{ $event->users->count() - 5 }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    @if(session('message'))
        <div class="fixed bottom-10 right-10 bg-slate-900 text-white px-8 py-4 rounded-2xl shadow-2xl animate-bounce flex items-center space-x-3 z-[100]">
            <i class="fas fa-check-circle text-emerald-400 text-xl"></i>
            <span class="text-xs font-black uppercase tracking-widest">{{ session('message') }}</span>
        </div>
    @endif

</body>
</html>
