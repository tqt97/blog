<?php

namespace App\Models;

use App\Notifications\Auth\QueuedVerifyEmail;
use App\Notifications\Auth\QueueSetPasswordReset;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'auth_type',
        'facebook_id',
        'google_id',
        'github_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Scope a query to only include users with a given provider and socialId.
     */
    public function scopeWithProvider(Builder $query, string $provider, string $socialId): Builder
    {
        return $query->where("{$provider}_id", $socialId);
    }

    /**
     * Determine if the user has a given provider and socialId.
     */
    public function isLinkedWithProvider(string $provider, string $providerId): bool
    {
        return $this->{"{$provider}_id"} === $providerId;
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new QueuedVerifyEmail);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new QueueSetPasswordReset($token));
    }
}
