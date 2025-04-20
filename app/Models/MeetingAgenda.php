<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingAgenda extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meeting_id',
        'creator_id',
        'title',
        'content',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relaciones
    public function meeting()
    {
        return $this->belongsTo(CommitteeMeeting::class, 'meeting_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Métodos útiles
    public function moveUp()
    {
        if ($this->order > 1) {
            $previousItem = static::where('meeting_id', $this->meeting_id)
                ->where('order', $this->order - 1)
                ->first();

            if ($previousItem) {
                $previousOrder = $previousItem->order;
                $previousItem->update(['order' => $this->order]);
                $this->update(['order' => $previousOrder]);
            }
        }
    }

    public function moveDown()
    {
        $nextItem = static::where('meeting_id', $this->meeting_id)
            ->where('order', $this->order + 1)
            ->first();

        if ($nextItem) {
            $nextOrder = $nextItem->order;
            $nextItem->update(['order' => $this->order]);
            $this->update(['order' => $nextOrder]);
        }
    }

    public function setAsFirst()
    {
        $currentFirst = static::where('meeting_id', $this->meeting_id)
            ->where('order', 1)
            ->first();

        if ($currentFirst && $currentFirst->id !== $this->id) {
            static::where('meeting_id', $this->meeting_id)
                ->where('order', '>=', 1)
                ->increment('order');

            $this->update(['order' => 1]);
        }
    }

    public function setAsLast()
    {
        $maxOrder = static::where('meeting_id', $this->meeting_id)->max('order');
        $this->update(['order' => $maxOrder + 1]);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agenda) {
            if (!$agenda->order) {
                $agenda->order = static::where('meeting_id', $agenda->meeting_id)->max('order') + 1;
            }
        });
    }
} 