<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_customers', function (Blueprint $table) {
            $table->unsignedSmallInteger('activity_id');
            $table->unsignedSmallInteger('customer_id');
            $table->unsignedSmallInteger('salesman_id_register')->nullable();
            $table->unsignedSmallInteger('salesman_id_deal')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('activity_customers');
    }
}
