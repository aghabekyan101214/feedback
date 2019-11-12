<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerVariant extends Model
{
    protected $guarded = [];

    public function questions()
    {
        return $this->belongsTo("App\Question", "question_id", "id");
    }
}
