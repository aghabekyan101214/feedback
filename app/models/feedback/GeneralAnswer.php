<?php

namespace App\models\feedback;

use Illuminate\Database\Eloquent\Model;

class GeneralAnswer extends Model
{
    public function clients()
    {
        return $this->belongsTo("App\Client", "client_id", "id");
    }

    public function customAnswers()
    {
        return $this->hasMany('App\models\feedback\CustomAnswer', "general_answer_id", "id");
    }

    public function employeeRates()
    {
        return $this->hasMany('App\models\feedback\EmployeeRate', "general_answer_id", "id");
    }

    public function radioAnswers()
    {
        return $this->hasMany('App\models\feedback\RadioAnswer', "general_answer_id", "id");
    }

    public function ratingAnswer()
    {
        return $this->hasMany('App\models\feedback\RatingAnswer', "general_answer_id", "id");
    }
}
