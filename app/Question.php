<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const GENERAL  = 0;
    const EMPLOYEE = 1;
    const CUSTOM   = 2;
    const TYPES = ["general", "employee", "custom"];

    protected $guarded = [];

    public function variants()
    {
        return $this->hasMany("App\AnswerVariant");
    }

    public function custom_answer()
    {
        return $this->hasMany("App\AnswerVariant");
    }
}
