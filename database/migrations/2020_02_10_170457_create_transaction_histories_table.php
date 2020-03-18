<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('all_users')->onDelete('cascade');
            $table->bigInteger('technician_id')->unsigned();
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');
            $table->bigInteger('assign_id')->unsigned();
            $table->foreign('assign_id')->references('id')->on('assign_technician_devices')->onDelete('cascade');
            $table->double('sell_price');
            $table->double('installation_cost');
            $table->double('device_costing');
            $table->double('profit_or_loss');
            $table->integer('Profit_status');
            $table->integer('total_amount');
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
        Schema::dropIfExists('transaction_histories');
    }
}
