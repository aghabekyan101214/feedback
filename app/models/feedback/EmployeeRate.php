<?php

namespace App\models\feedback;

use Illuminate\Database\Eloquent\Model;

class EmployeeRate extends Model
{
    public function questions()
    {
        return $this->belongsTo("App\Question", "question_id", "id");
    }

    public function employees()
    {
        return $this->belongsTo("App\Employee", "employee_id", "id");
    }
}
