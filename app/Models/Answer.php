<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'questionnaire_id',
        'question_id',
    ];


    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
