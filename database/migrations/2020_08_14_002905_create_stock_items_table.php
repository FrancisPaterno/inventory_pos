<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_header_id')->nullable(false);
            $table->unsignedBigInteger('item_id')->nullable(false);
            $table->string('description', 500)->nullable(true);
            $table->integer('Qty')->nullable(false);
            $table->float('wholesale_price')->nullable(false);
            $table->float('retail_price')->nullable(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('stock_header_id')
            ->references('id')
            ->on('stock_headers')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('item_id')
            ->references('id')
            ->on('items')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->unique(['stock_header_id', 'item_id'], 'unique_item_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_items');
    }
}
