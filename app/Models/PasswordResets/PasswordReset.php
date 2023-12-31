<?php

namespace App\Models\PasswordResets;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
    public $timestamps = FALSE;
}
