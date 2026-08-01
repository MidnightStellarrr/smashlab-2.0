<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class FrontdeskUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'frontdesk_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'employee_code',
        'phone',
        'shift',
        'status',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
    ];

    // ✅ ADD THIS METHOD
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    // ✅ ADD THIS METHOD
    public function updateLastLogin(Request $request): void
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);
    }
}