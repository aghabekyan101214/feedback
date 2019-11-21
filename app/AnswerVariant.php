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


    public function clients_answers()
    {
        return $this->belongsToMany("App\Question", "clients_answers",  "variant_id", "question_id");
    }
}
