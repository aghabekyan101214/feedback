<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("table_id");
            $table->foreign("order_id")->references("id")->on("orders")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("table_id")->references("id")->on("tables")->onUpdate("cascade")->onDelete("cascade");
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
        Schema::dropIfExists('orders_tables');
    }
}
