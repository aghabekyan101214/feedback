<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("question_id");
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("general_answer_id");
            $table->foreign("general_answer_id")->references("id")->on("general_answers")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("employee_id");
            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedTinyInteger("rate");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_rates');
    }
}
