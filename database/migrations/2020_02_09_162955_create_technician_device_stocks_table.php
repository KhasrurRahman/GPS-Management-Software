<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicianDeviceStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_device_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quantity');
            $table->string('device_id');
            $table->bigInteger('technician_id')->unsigned();
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');
            $table->bigInteger('assign_id')->unsigned();
            $table->foreign('assign_id')->references('id')->on('assign_technician_devices')->onDelete('cascade');
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
        Schema::dropIfExists('technician_device_stocks');
    }
}
