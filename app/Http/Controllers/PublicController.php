<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Achievement;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    /**
     * Башкы бетти көрсөтүү
     */
    public function index()
    {
        // 1. Иш-чаралар: Эң акыркы кошулгандарын биринчи чыгарабыз
        // orderBy('event_date', 'asc') кээде эски ивенттерди биринчи чыгарып, жаңыларын көрсөтпөй коёт
        $events = Event::latest()->take(4)->get();

        // 2. Акыркы бекитилген (approved) жетишкендиктер
        $achievements = Achievement::where('status', 'approved')
            ->with('user')
            ->latest()
            ->take(6)
            ->get();

        // 3. РЕЙТИНГ: Студенттердин бекитилген жетишкендиктерин саноо
        $topStudents = User::where('role', 'student')
            ->withCount(['achievements' => function($query) {
                $query->where('status', 'approved'); 
            }])
            ->orderBy('achievements_count', 'desc')
            ->take(5)
            ->get();

        return view('welcome', compact('events', 'achievements', 'topStudents'));
    }

    /**
     * Студенттин жетишкендигин (сертификат) сактоо
     */
    public function store(Request $request)
    {
        // Валидация
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Файлды storage/app/public/achievements папкасына сактайбыз
        $path = $request->file('file')->store('achievements', 'public');

        // Базага жазуу
        Achievement::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'file_path' => $path,
            'status' => 'pending', 
        ]);

        return back()->with('message', 'Сиздин жетишкендигиңиз текшерүүгө жөнөтүлдү!');
    }
}