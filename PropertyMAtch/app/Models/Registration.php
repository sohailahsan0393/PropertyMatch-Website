<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // <-- Add this

class Registration extends Authenticatable
{
    use Notifiable; // <-- Add this
    protected $table = 'registrations';

    protected $fillable = ['phone', 'email', 'password'];

    protected $hidden = ['password'];
}
