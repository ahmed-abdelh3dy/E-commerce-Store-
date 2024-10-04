<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Concerns\HasRoles;

class Admin  extends User
{
    use HasFactory, Notifiable, HasApiTokens , HasRoles;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'username',
        'password',
        'super_admin',
        'status'
    ];
}
