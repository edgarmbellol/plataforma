<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommitteeMeeting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'committee_id',
        'title',
        'observation',
        'start_date',
        'end_date',
        'location',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Constantes para estados
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    // Relaciones
    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }

    public function agendas()
    {
        return $this->hasMany(MeetingAgenda::class, 'meeting_id')
            ->orderBy('order');
    }

    public function attendees()
    {
        return $this->hasMany(MeetingAttendee::class, 'meeting_id');
    }

    public function tasks()
    {
        return $this->hasMany(MeetingTask::class, 'meeting_id');
    }

    public function minutes()
    {
        return $this->hasOne(MeetingMinute::class, 'meeting_id');
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now())
            ->where('status', self::STATUS_SCHEDULED);
    }

    public function scopePast($query)
    {
        return $query->where('end_date', '<', now())
            ->where('status', self::STATUS_COMPLETED);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('start_date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('start_date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    // Métodos útiles
    public function getDuration()
    {
        return $this->start_date->diffForHumans($this->end_date, true);
    }

    public function isUpcoming()
    {
        return $this->start_date->isFuture() && $this->status === self::STATUS_SCHEDULED;
    }

    public function isInProgress()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function getConfirmedAttendees()
    {
        return $this->attendees()->where('status', 'confirmed')->get();
    }

    public function getPendingTasks()
    {
        return $this->tasks()->where('status', 'pending')->get();
    }

    public function hasMinutes()
    {
        return $this->minutes()->exists();
    }

    public function canStart()
    {
        return $this->status === self::STATUS_SCHEDULED && 
               now()->between($this->start_date->subMinutes(15), $this->end_date);
    }

    public function canEnd()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }
} 