<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. ЖАЛПЫГА АЧЫК БЕТТЕР ---
Route::get('/', [PublicController::class, 'index'])->name('home');

// Аутентификация (Кирүү/Чыгуу)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- 2. СТУДЕНТТЕР ҮЧҮН МАРШРУТТАР (Авторизациядан өткөндөр) ---
Route::middleware(['auth'])->group(function () {
    
    // Жетишкендикти (сертификат) базага сактоо
    Route::post('/achievement/store', [PublicController::class, 'store'])->name('achievement.store');
    
    // Иш-чарага онлайн катталуу жана QR-код алуу
    Route::post('/events/{id}/join', [EventController::class, 'join'])->name('events.join');

    // Студент панели
    Route::get('/student', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/student/achievement/store', [StudentController::class, 'storeAchievement'])->name('student.achievement.store');
    Route::put('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
    Route::put('/student/password', [StudentController::class, 'updatePassword'])->name('student.password.update');

});


// --- 3. АДМИН ПАНЕЛЬ & QR-КОД ТЕКШЕРҮҮ ---
Route::prefix('admin')->middleware(['auth'])->group(function () {
    
    // QR-КОДДУ СКАНЕРЛӨӨ: Бул шилтемени админдин телефону сканерлейт
    Route::get('/verify/{user_id}/{event_id}', [AdminController::class, 'verifyAttendance'])
        ->name('admin.verify.attendance');

    // Админдин башкы бети (статистика, сурамдар)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Студенттерди башкаруу
    Route::get('/students', [AdminController::class, 'studentsIndex'])->name('admin.students.index');
    Route::post('/student/store', [AdminController::class, 'storeStudent'])->name('admin.student.store');
    
    // Студенттин жетишкендигин бекитүү (Approve/Reject)
    Route::post('/achievement/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.status');
    
    // Иш-чараларды түзүү жана башкаруу
    Route::get('/events', [AdminController::class, 'eventsIndex'])->name('admin.events.index');
    Route::post('/events/store', [AdminController::class, 'storeEvent'])->name('admin.events.store');

});