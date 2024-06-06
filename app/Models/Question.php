<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'attribute',
        'type',
        'page_id',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
    public function option()
    {
        return $this->hasMany(Option::class);
    }
}
