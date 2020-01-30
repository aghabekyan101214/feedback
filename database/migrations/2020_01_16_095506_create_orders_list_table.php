<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("item_id");
            $table->foreign("item_id")->references("id")->on("items")->onDelete("cascade")->onUpdate("cascade");
            $table->decimal("quantity", 8, 2);
            $table->text("notes")->nullable();
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
        Schema::dropIfExists('orders');
    }
}
