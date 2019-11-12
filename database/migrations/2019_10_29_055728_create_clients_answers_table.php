<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("client_id");
            $table->foreign("client_id")->references("id")->on("clients")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("question_id");
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("employee_id")->nullable();
            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("variant_id")->nullable();
            $table->foreign("variant_id")->references("id")->on("answer_variants")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedSmallInteger("rate")->nullable();
            $table->text("text")->nullable();
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
        Schema::dropIfExists('clients_answers');
    }
}
