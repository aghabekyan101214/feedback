<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("question_en", 255);
            $table->string("question_fr", 255);
            $table->string("question_ar", 255);
            $table->enum("answer_type", ['radio', 'checkbox'])->default("radio");
            $table->unsignedSmallInteger("active");
            $table->enum("type", ['employee', 'general', 'custom']);
            $table->unsignedSmallInteger("order");
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
        Schema::dropIfExists('questions');
    }
}
