<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Студент панелинин башкы бети
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Студенттин жетишкендиктери
        $achievements = Achievement::where('user_id', $user->id)
            ->latest()
            ->get();

        // Жакынкы иш-чаралар (5 шт)
        $upcomingEvents = Event::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();

        // Студент катталган иш-чаралар
        $joinedEventIds = $user->events ? $user->events->pluck('id') : collect();

        // Статистика
        $stats = [
            'upcoming'   => $upcomingEvents->count(),
            'approved'   => $achievements->where('status', 'approved')->count(),
            'pending'    => $achievements->where('status', 'pending')->count(),
            'rejected'   => $achievements->where('status', 'rejected')->count(),
        ];

        // Профиль толтурулгандыгы (%)
        $filled = 0;
        if ($user->name)       $filled += 20;
        if ($user->email)      $filled += 20;
        if ($user->faculty)    $filled += 20;
        if ($user->group_name) $filled += 20;
        if ($user->course)     $filled += 20;
        $profilePercent = $filled;

        // Билдирүүлөр (акыркы 5 жетишкендик статус өзгөргөн)
        $notifications = Achievement::where('user_id', $user->id)
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'user', 'achievements', 'upcomingEvents', 
            'joinedEventIds', 'stats', 'profilePercent', 'notifications'
        ));
    }

    /**
     * Жетишкендик жүктөө (форма)
     */
    public function storeAchievement(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_name'  => 'nullable|string|max:255',
            'place'       => 'nullable|string|max:100',
            'file'        => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $path = $request->file('file')->store('achievements', 'public');

        Achievement::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description . ($request->event_name ? ' | Иш-чара: ' . $request->event_name : '') . ($request->place ? ' | Орун: ' . $request->place : ''),
            'event_date'  => now()->toDateString(),
            'file_path'   => $path,
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Жетишкендигиңиз текшерүүгө жөнөтүлдү! Статус: текшерүүдө.');
    }

    /**
     * Профилди жаңыртуу
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name'       => 'required|string|max:255',
            'faculty'    => 'nullable|string|max:255',
            'group_name' => 'nullable|string|max:100',
            'course'     => 'nullable|integer|min:1|max:6',
            'phone'      => 'nullable|string|max:20',
        ]);

        $user->update($request->only(['name', 'faculty', 'group_name', 'course', 'phone']));

        return back()->with('success', 'Профилиңиз ийгиликтүү жаңыртылды!');
    }

    /**
     * Сырсөздү өзгөртүү
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Учурдагы сырсөз туура эмес!']);
        }

        Auth::user()->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Сырсөз ийгиликтүү өзгөртүлдү!');
    }
}
