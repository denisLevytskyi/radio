<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function roles () {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function isAdministrator () {
        return $this->roles()->where('role', '=', 'ADMIN')->exists();
    }

    public function isRecorder () {
        return $this->roles()->where('role', '=', 'RECORDER')->exists();
    }

    public function isExporter () {
        return $this->roles()->where('role', '=', 'EXPORTER')->exists();
    }

    public function isUser () {
        return $this->roles()->where('role', '=', 'USER')->exists();
    }

    public function isGuest () {
        return $this->roles()->where('role', '=', 'GUEST')->exists();
    }

    public function isPassStrongMod () {
        return $this->isAdministrator() or (int) (new Prop())->getProp('app_mode');
    }
}
