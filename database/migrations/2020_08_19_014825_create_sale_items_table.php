<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_id')->nullable(false);
            $table->unsignedBigInteger('stock_item_id')->nullable(false)->unique();
            $table->string('description', 400)->nullable(true);
            $table->float('quantity')->nullable(false);
            $table->float('sale_price')->nullable(false);
            $table->float('total')->nullable(false);
            $table->timestamps();

            $table->foreign('sale_id')
            ->references('id')
            ->on('sales')
            ->onDelete('restrict')
            ->onDelete('cascade');

            $table->foreign('stock_item_id')
            ->references('id')
            ->on('stock_items')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
}
