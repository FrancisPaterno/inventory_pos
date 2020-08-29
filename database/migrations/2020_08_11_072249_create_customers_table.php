<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname', 100)->nullable(false);
            $table->string('middlename', 100)->nullable();
            $table->string('lastname', 100)->nullable(false);
            $table->unsignedBigInteger('gender_id');
            $table->string('address', 400)->nullable();
            $table->string('email', 150)->nullable()->unique();
            $table->string('contact', 30)->nullable(false);
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('gender_id')
            ->references('id')
            ->on('genders')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->unique(['firstname', 'middlename', 'lastname'], 'uniquename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
