<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User; // Рейтинг үчүн керек болушу мүмкүн
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Башкы бетти көрсөтүү жана ивенттерди базадан алып келүү
     */
    public function index()
    {
        // 1. Базадан бардык ивенттерди алабыз
        $events = Event::all();

        // 2. Рейтинг үчүн студенттерди алабыз (эгер рейтингиң ошол эле бетте болсо)
        // Achievements санагы менен эң алдыңкы 10 студент
        $topStudents = User::withCount('achievements')
                           ->orderBy('achievements_count', 'desc')
                           ->take(10)
                           ->get();

        // 3. Аларды Blade шаблонуна жиберебиз
        return view('welcome', compact('events', 'topStudents'));
    }

    /**
     * Студенттин иш-чарага жазылуусу
     */
    public function join($id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();

        if ($user->events->contains($event->id)) {
            return back()->with('error', 'Сиз бул иш-чарага буга чейин катталгансыз!');
        }

        $user->events()->attach($event->id, [
            'attended' => false
        ]);

        return back()->with('message', 'Куттуктайбыз! Сиз ийгиликтүү катталдыңыз.');
    }
}