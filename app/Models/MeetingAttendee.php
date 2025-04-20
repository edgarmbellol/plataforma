<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingAttendee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meeting_id',
        'user_id',
        'status',
        'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Constantes para estados
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_DECLINED = 'declined';
    const STATUS_ATTENDED = 'attended';

    // Relaciones
    public function meeting()
    {
        return $this->belongsTo(CommitteeMeeting::class, 'meeting_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    public function scopeDeclined($query)
    {
        return $query->where('status', self::STATUS_DECLINED);
    }

    public function scopeAttended($query)
    {
        return $query->where('status', self::STATUS_ATTENDED);
    }

    // Métodos útiles
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isConfirmed()
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function isDeclined()
    {
        return $this->status === self::STATUS_DECLINED;
    }

    public function hasAttended()
    {
        return $this->status === self::STATUS_ATTENDED;
    }

    public function confirm()
    {
        $this->update(['status' => self::STATUS_CONFIRMED]);
    }

    public function decline()
    {
        $this->update(['status' => self::STATUS_DECLINED]);
    }

    public function markAsAttended()
    {
        $this->update([
            'status' => self::STATUS_ATTENDED,
            'joined_at' => now(),
        ]);
    }

    public function getAttendanceStatus()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pendiente',
            self::STATUS_CONFIRMED => 'Confirmado',
            self::STATUS_DECLINED => 'Declinado',
            self::STATUS_ATTENDED => 'Asistió',
            default => 'Desconocido',
        };
    }
} 