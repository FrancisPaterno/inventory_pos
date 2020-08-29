<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('receipt_no', 20)->unique()->nullable(false);
            $table->date('date')->nullable(false);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_name', 200)->nullable();
            $table->string('description', 400)->nullable(true);
            $table->float('total')->nullable(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
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
        Schema::dropIfExists('sales');
    }
}
