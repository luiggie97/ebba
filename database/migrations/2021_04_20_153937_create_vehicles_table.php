<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->integer('model_vehicle_id')->unsigned();
            $table->string('photo')->nullable();
            $table->string('plate')->unique();
            $table->enum('type', ['Carro', 'Moto']);
            $table->string('description')->nullable();
            $table->integer('year');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('model_vehicle_id')->references('id')->on('model_vehicles');
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->dropForeign('vehicles_brand_id_foreign');
            $table->dropForeign('vehicles_model_vehicle_id_foreign');
        });
        Schema::dropIfExists('vehicles');
    }
}
