<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("field_name", 100);
            $table->unsignedSmallInteger("active");
            $table->unsignedSmallInteger("required");
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
        Schema::dropIfExists('active_fields');
    }
}
