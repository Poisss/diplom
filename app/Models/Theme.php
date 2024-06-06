<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'header',
        'footer',
        'font',
        'background',
    ];

    public function form()
    {
        return $this->hasMany(Form::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
