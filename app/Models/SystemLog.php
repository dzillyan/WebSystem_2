<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemLog extends Model
{
    protected $fillable = [
        'student_id',
        'event_type',
        'description',
        'ip_address',
        'user_agent',
        'old_values',
        'new_values',
        'status',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Event type constants
    const EVENT_LOGIN          = 'login';
    const EVENT_LOGOUT         = 'logout';
    const EVENT_REGISTER       = 'register';
    const EVENT_LOGIN_FAILED   = 'login_failed';
    const EVENT_PROFILE_UPDATE = 'profile_update';
    const EVENT_PASSWORD_CHANGE = 'password_change';
    const EVENT_PAGE_VISIT     = 'page_visit';

    public static function record(
        string $eventType,
        string $description,
        ?int $studentId = null,
        string $status = 'success',
        ?array $oldValues = null,
        ?array $newValues = null
    ): self {
        return self::create([
            'student_id'  => $studentId,
            'event_type'  => $eventType,
            'description' => $description,
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
            'old_values'  => $oldValues,
            'new_values'  => $newValues,
            'status'      => $status,
        ]);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'success' => 'badge-success',
            'failed'  => 'badge-danger',
            'warning' => 'badge-warning',
            default   => 'badge-secondary',
        };
    }
}