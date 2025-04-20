<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingMinute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meeting_id',
        'recorded_by',
        'content',
        'attachments',
        'start_time',
        'end_time',
        'attendees_summary',
        'key_points',
        'action_items',
        'status',
    ];

    protected $casts = [
        'attachments' => 'array',
        'key_points' => 'array',
        'action_items' => 'array',
        'attendees_summary' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Constantes para estados
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING_APPROVAL = 'pending_approval';
    const STATUS_APPROVED = 'approved';
    const STATUS_PUBLISHED = 'published';

    // Relaciones
    public function meeting()
    {
        return $this->belongsTo(CommitteeMeeting::class, 'meeting_id');
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    // Scopes
    public function scopeDrafts($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('status', self::STATUS_PENDING_APPROVAL);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    // Métodos útiles
    public function isDraft()
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isPendingApproval()
    {
        return $this->status === self::STATUS_PENDING_APPROVAL;
    }

    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isPublished()
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function submitForApproval()
    {
        if ($this->isDraft()) {
            $this->update(['status' => self::STATUS_PENDING_APPROVAL]);
            return true;
        }
        return false;
    }

    public function approve()
    {
        if ($this->isPendingApproval()) {
            $this->update(['status' => self::STATUS_APPROVED]);
            return true;
        }
        return false;
    }

    public function publish()
    {
        if ($this->isApproved()) {
            $this->update(['status' => self::STATUS_PUBLISHED]);
            return true;
        }
        return false;
    }

    public function getStatusLabel()
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'Borrador',
            self::STATUS_PENDING_APPROVAL => 'Pendiente de Aprobación',
            self::STATUS_APPROVED => 'Aprobada',
            self::STATUS_PUBLISHED => 'Publicada',
            default => 'Desconocido',
        };
    }

    public function getDuration()
    {
        if ($this->start_time && $this->end_time) {
            return $this->start_time->diffInMinutes($this->end_time);
        }
        return null;
    }

    public function addKeyPoint($point)
    {
        $keyPoints = $this->key_points ?? [];
        $keyPoints[] = $point;
        $this->update(['key_points' => $keyPoints]);
    }

    public function addActionItem($item)
    {
        $actionItems = $this->action_items ?? [];
        $actionItems[] = $item;
        $this->update(['action_items' => $actionItems]);
    }

    public function addAttachment($attachment)
    {
        $attachments = $this->attachments ?? [];
        $attachments[] = $attachment;
        $this->update(['attachments' => $attachments]);
    }

    public function hasAttachments()
    {
        return !empty($this->attachments);
    }

    public function getAttachmentsCount()
    {
        return count($this->attachments ?? []);
    }
} 