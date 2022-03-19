<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_transaction', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->string('ticker');          
            $table->integer('coin_id');
            $table->string('code');
            $table->string('exchange');
            $table->boolean('invalid');
            $table->string('record_time');
            $table->decimal('usd', $precision = 50, $scale = 8);
            $table->decimal('idr', $precision = 50, $scale = 8);
            $table->decimal('hnst', $precision = 50, $scale = 8);
            $table->decimal('eth', $precision = 50, $scale = 8);
            $table->decimal('btc', $precision = 50, $scale = 8);
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
        Schema::dropIfExists('crypto_transaction');
    }
}
