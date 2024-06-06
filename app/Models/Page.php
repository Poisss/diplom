<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'form_id',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    public function question()
    {
        return $this->hasMany(Question::class);
    }
}
