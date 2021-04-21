<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('rent_start');
            $table->timestamp('rent_end');
            $table->string('description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('vehicle_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->dropForeign('bookings_user_id_foreign');
            $table->dropForeign('bookings_vehicle_id_foreign');
        });
        Schema::dropIfExists('bookings');
    }

}
