<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadioAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("question_id");
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("general_answer_id");
            $table->foreign("general_answer_id")->references("id")->on("general_answers")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("answer_variant_id");
            $table->foreign("answer_variant_id")->references("id")->on("answer_variants")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('radio_answers');
    }
}
