<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientAnswer extends Model
{
    protected $table = "clients_answers";

    public function clients()
    {
        return $this->belongsTo("App\Client", "client_id", "id");
    }

    public function employee()
    {
        return $this->belongsTo("App\Employee", "employee_id", "id");
    }
}
