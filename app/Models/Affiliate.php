<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Affiliate extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = "affiliate";

    protected $fillable = [
        'name',
        'email',
        'parent_id',
        'promo_code',
        'current_balance',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
