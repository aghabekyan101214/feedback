<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const GENERAL  = 0;
    const EMPLOYEE = 1;
    const CUSTOM   = 2;

    const RATE = 0;
    const RADIO = 1;

    const GROUPS = ["General", "Employee", "Custom"];
    const TYPES = ["Rate", "Radio", "Custom"];

    protected $guarded = [];

    public function variants()
    {
        return $this->hasMany("App\AnswerVariant");
    }

    public function client()
    {
        return $this->belongsToMany("App\Client", "clients_answers", "question_id", "client_id");
    }

    public function custom_answer()
    {
        return $this->hasMany("App\AnswerVariant");
    }


    public function clients_answers()
    {
        return $this->hasMany("App\ClientAnswer", "question_id", "id");
    }

    public function avgRating()
    {
        return $this->clients_answers()
            ->selectRaw('round(avg(rate), 2) as rate, question_id')->groupBy('question_id');
    }
}
