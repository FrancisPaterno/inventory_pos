<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('barcode', 13)->unique()->nullable(false);
            $table->string('name', 150)->unique();
            $table->string('sku', 100)->unique()->nullable(true);
            $table->string('description', 500)->nullable();
            $table->unsignedBigInteger('item_category_id')->nullable(false);
            $table->unsignedBigInteger('item_brand_id')->nullable(false);
            $table->unsignedBigInteger('item_unit_id')->nullable(false);
            $table->unsignedBigInteger('item_status_id')->nullable(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('item_category_id')
            ->references('id')
            ->on('item_categories')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('item_brand_id')
            ->references('id')
            ->on('item_brands')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('item_unit_id')
            ->references('id')
            ->on('item_units')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('item_status_id')
            ->references('id')
            ->on('item_statuses')
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
        Schema::dropIfExists('items');
    }
}
