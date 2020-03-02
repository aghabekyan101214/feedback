<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("question_id");
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("general_answer_id");
            $table->foreign("general_answer_id")->references("id")->on("general_answers")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('rating_answers');
    }
}
