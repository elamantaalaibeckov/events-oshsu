<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Сизде админ панелге кирүүгө укук жок.');
        }
    }

    /**
     * Админ панелдин башкы бети
     */
    public function dashboard() 
    {
        $this->ensureAdmin();

        // 2. Күтүүдөгү жетишкендиктер (Бул жерди $achievements деп атадык, Blade файлында ушуну издеп жатат)
        $achievements = Achievement::where('status', 'pending')->with('user')->latest()->get();
        
        // 3. Бардык студенттер
        $students = User::where('role', 'student')->with('achievements')->latest()->get();

        // 4. Бардык иш-чаралар
        $events = Event::with('users')->latest()->get();

        // Өзгөрмөлөрдү compact ичинде туура жиберүү
        return view('admin.dashboard', compact('achievements', 'students', 'events'));
    }

    public function studentsIndex()
    {
        $this->ensureAdmin();

        return redirect()->route('admin.dashboard')->with('message', 'Студенттер тизмеси админ панелде көрсөтүлөт.');
    }

    public function eventsIndex()
    {
        $this->ensureAdmin();

        return redirect()->route('admin.dashboard')->with('message', 'Иш-чаралар админ панелде көрсөтүлөт.');
    }

    /**
     * QR-КОД СКАНЕРЛЕНГЕНДЕ СТУДЕНТТИ КАТТОО
     */
    public function verifyAttendance($user_id, $event_id)
    {
        $this->ensureAdmin();

        $event = Event::findOrFail($event_id);
        $user = User::findOrFail($user_id);

        // updateExistingPivot колдонуу үчүн 'attended' талаасы базада болушу шарт
        $event->users()->updateExistingPivot($user_id, [
            'attended' => true
        ]);

        return "✅ Студент ийгиликтүү катталды: " . $user->name . " (Иш-чара: " . $event->title . ")";
    }

    /**
     * Жетишкендикти бекитүү же четке кагуу
     */
    public function updateStatus(Request $request, $id) 
    {
        $this->ensureAdmin();

        $request->validate([
            'action' => 'required|in:approve,reject',
            'comment' => 'nullable|string|max:500',
        ]);

        $achievement = Achievement::findOrFail($id);
        
        if ($request->action == 'approve') {
            $achievement->status = 'approved';
        } elseif ($request->action == 'reject') {
            $achievement->status = 'rejected';
            $achievement->admin_comment = $request->comment;
        }
        
        $achievement->save();
        return back()->with('message', 'Статус ийгиликтүү жаңыртылды!');
    }

    /**
     * Жаңы студентти базага кошуу
     */
    public function storeStudent(Request $request) 
    {
        $this->ensureAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'faculty' => 'nullable|string|max:255',
            'group_name' => 'nullable|string|max:100',
            'course' => 'nullable|integer|min:1|max:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'faculty' => $request->faculty,
            'group_name' => $request->group_name,
            'course' => $request->course,
        ]);

        return back()->with('message', 'Жаңы студент ийгиликтүү кошулду!');
    }

    /**
     * Жаңы иш-чара түзүү
     */
    public function storeEvent(Request $request) 
    {
        $this->ensureAdmin();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
        ]);

        // Маалыматтарды коопсуз сактоо
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
        ]);

        return back()->with('message', 'Жаңы иш-чара ийгиликтүү түзүлдү!');
    }
}
