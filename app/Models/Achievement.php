<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Тест жасоо үчүн керек
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Achievement extends Model
{
    use HasFactory;

    /**
     * Маалымат базасына түз жазууга уруксат берилген талаалар.
     */
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'event_date', 
        'file_path', 
        'status', 
        'admin_comment'
    ];

    /**
     * Даталарды автоматтык түрдө Carbon объектисине айлантуу.
     */
    protected $casts = [
        'event_date' => 'date',
        // Статустарды катасыз башкаруу үчүн төмөнкү түшүндүрмөнү кара
    ];

    /**
     * Статустардын тизмесин туруктуу (const) кылып сактап койгонуң жакшы.
     * Бул коддо ката кетирбөөгө жардам берет (мисалы: 'pending' ордуна 'pendin' деп жазып албайсың)
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Бул жетишкендик кимге таандык (User модели менен байланыш).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Кошумча: Сүрөттүн толук шилтемесин алуу үчүн (Helper)
     * Муну Blade шаблонунда <img src="{{ $achievement->file_url }}"> деп колдонсоң болот
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}