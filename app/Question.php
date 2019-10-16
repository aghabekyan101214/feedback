<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const GENERAL  = 0;
    const EMPLOYEE = 1;
    const CUSTOM   = 2;
}
