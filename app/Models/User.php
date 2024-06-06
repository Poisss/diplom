<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'photo',
        'login',
        'email',
        'password',
        'theme_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function form()
    {
        return $this->hasMany(Form::class);
    }
    public function questionnaire()
    {
        return $this->hasMany(Questionnaire::class);
    }
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
