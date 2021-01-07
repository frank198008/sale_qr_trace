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
            $table->unsignedBigInteger('salesman_id')->nullable()->comment('销售员id');
            $table->string('name')->comment('姓名');
            $table->string('phone')->unique()->comment('联系电话');
            $table->string('id_number')->nullable()->comment('身份证');
            $table->string('occupation')->nullable()->comment('职业');
            $table->tinyInteger('sex')->default(2)->comment('性别');
            $table->unsignedSmallInteger('age')->nullable()->comment('年龄');
            $table->tinyInteger('status')->default(0)->comment('状态');
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
        Schema::dropIfExists('customers');
    }
}
