<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommitteeMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'committee_id',
        'user_id',
        'role',
        'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Constantes para roles
    const ROLE_PRESIDENT = 'president';
    const ROLE_SECRETARY = 'secretary';
    const ROLE_MEMBER = 'member';

    // Relaciones
    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePresidents($query)
    {
        return $query->where('role', self::ROLE_PRESIDENT);
    }

    public function scopeSecretaries($query)
    {
        return $query->where('role', self::ROLE_SECRETARY);
    }

    public function scopeRegularMembers($query)
    {
        return $query->where('role', self::ROLE_MEMBER);
    }

    // Métodos útiles
    public function isPresident()
    {
        return $this->role === self::ROLE_PRESIDENT;
    }

    public function isSecretary()
    {
        return $this->role === self::ROLE_SECRETARY;
    }

    public function isRegularMember()
    {
        return $this->role === self::ROLE_MEMBER;
    }

    public function getMembershipDuration()
    {
        return $this->joined_at->diffForHumans();
    }

    // Métodos de autorización
    public function canManageMeetings()
    {
        return in_array($this->role, [self::ROLE_PRESIDENT, self::ROLE_SECRETARY]);
    }

    public function canCreateAgendaItems()
    {
        return in_array($this->role, [self::ROLE_PRESIDENT, self::ROLE_SECRETARY]);
    }

    public function canAssignTasks()
    {
        return in_array($this->role, [self::ROLE_PRESIDENT, self::ROLE_SECRETARY]);
    }
} 