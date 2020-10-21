<?php
declare(strict_types=1);

namespace Viezel\OTP\Models;

use Illuminate\Database\Eloquent\Model;

class OneTimePassword extends Model
{
    protected $table = 'one_time_passwords';

    public $timestamps = false;

    protected $fillable = [
        'url',
        'code',
        'expires_at',
    ];

    protected $hidden = [];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
