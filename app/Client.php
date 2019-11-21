<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function questions()
    {
        return $this->belongsToMany("App\Question", "clients_answers", "client_id", "question_id");
    }
}
