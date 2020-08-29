<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('delivery_receipt_no', 30)->unique()->nullable(true);
            $table->string('description', 500)->nullable(true);
            $table->date('date')->nullable(false);
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('supplier_id');
            $table->double('total')->nullable(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('warehouse_id')
            ->references('id')
            ->on('warehouses')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('supplier_id')
            ->references('id')
            ->on('warehouses')
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
        Schema::dropIfExists('stock_headers');
    }
}
