<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function employeeRates()
    {
        return $this->hasMany('App\models\feedback\EmployeeRate', 'employee_id', 'id');
    }
}
