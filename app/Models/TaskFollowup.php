<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskFollowup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'task_id',
        'observation',
        'followup_date',
        'attachments',
        'created_by',
    ];

    protected $casts = [
        'followup_date' => 'datetime',
        'attachments' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relaciones
    public function task()
    {
        return $this->belongsTo(MeetingTask::class, 'task_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeLatest($query)
    {
        return $query->orderBy('followup_date', 'desc');
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('followup_date', $date);
    }

    public function scopeWithAttachments($query)
    {
        return $query->whereNotNull('attachments')
            ->where('attachments', '!=', '[]');
    }

    // Métodos útiles
    public function hasAttachments()
    {
        return !empty($this->attachments);
    }

    public function getAttachmentsCount()
    {
        return count($this->attachments ?? []);
    }

    public function addAttachment($attachment)
    {
        $attachments = $this->attachments ?? [];
        $attachments[] = $attachment;
        $this->update(['attachments' => $attachments]);
    }

    public function removeAttachment($index)
    {
        $attachments = $this->attachments ?? [];
        if (isset($attachments[$index])) {
            unset($attachments[$index]);
            $this->update(['attachments' => array_values($attachments)]);
            return true;
        }
        return false;
    }

    public function getTimeElapsed()
    {
        return $this->followup_date->diffForHumans();
    }

    public function isFromToday()
    {
        return $this->followup_date->isToday();
    }

    public function isFromYesterday()
    {
        return $this->followup_date->isYesterday();
    }

    public function isFromThisWeek()
    {
        return $this->followup_date->isCurrentWeek();
    }
} 