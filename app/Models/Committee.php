<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Committee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Constantes para estados
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_ARCHIVED = 'archived';

    // Relaciones
    public function members()
    {
        return $this->hasMany(CommitteeMember::class);
    }

    public function meetings()
    {
        return $this->hasMany(CommitteeMeeting::class);
    }

    // Relaciones a través de otras tablas
    public function users()
    {
        return $this->belongsToMany(User::class, 'committee_members')
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', self::STATUS_INACTIVE);
    }

    public function scopeArchived($query)
    {
        return $query->where('status', self::STATUS_ARCHIVED);
    }

    // Métodos útiles
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function president()
    {
        return $this->members()
            ->where('role', 'president')
            ->first()
            ?->user;
    }

    public function secretary()
    {
        return $this->members()
            ->where('role', 'secretary')
            ->first()
            ?->user;
    }

    public function upcomingMeetings()
    {
        return $this->meetings()
            ->where('start_date', '>', now())
            ->where('status', 'scheduled')
            ->orderBy('start_date');
    }

    public function lastMeeting()
    {
        return $this->meetings()
            ->where('status', 'completed')
            ->orderBy('end_date', 'desc')
            ->first();
    }

    public function pendingTasks()
    {
        return $this->hasManyThrough(MeetingTask::class, CommitteeMeeting::class)
            ->where('status', 'pending');
    }
} 