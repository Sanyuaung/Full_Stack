<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyavisatransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('syavisatrans', function (Blueprint $table) {
            // $table->id();
            $table->string('settleDate', 500);
            $table->string('noTrans', 500);
            $table->string('usdAmt', 500);
            $table->string('mmkAmt', 500);
            $table->string('exRate', 500);
            $table->string('commAmt', 500);
            $table->string('typeOfTrans', 500);
            $table->string('cardType', 500);
            $table->string('currency', 500);
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
        Schema::dropIfExists('syavisatrans');
    }
}