<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Массалык түрдө толтурула турган талаалар.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',         // admin же student
        'faculty',      // Мисалы: ФИТ
        'group_name',   // Мисалы: ПОВ-22
        'course',       // 1, 2, 3, 4
        'avatar',       // Профиль сүрөтү
        'phone',        // Телефон номери
    ];

    /**
     * Сериализация учурунда жашырыла турган талаалар.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Типтерди өзгөртүү (casting).
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * БАЙЛАНЫШ: Бир студенттин көп жетишкендиги болушу мүмкүн.
     */
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    /**
     * БАЙЛАНЫШ: Студент көптөгөн иш-чараларга каттала алат (Many-to-Many).
     */
    public function events()
    {
        return $this->belongsToMany(Event::class)
                    // ТҮЗӨТҮҮ: Базада жок колонкаларды (faculty, phone ж.б.) бул жерден өчүрдүк
                    ->withPivot('attended') 
                    ->withTimestamps();
    }

    /**
     * Админ экенин текшерүү үчүн жардамчы функция.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Студент экенин текшерүү үчүн жардамчы функция.
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Аватардын толук URL дарегин алуу үчүн.
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }
}