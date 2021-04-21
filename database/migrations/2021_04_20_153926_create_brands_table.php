<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('model_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('model_id')->references('id')->on('model_vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->dropForeign('brands_model_id_foreign');
        });
        Schema::dropIfExists('brands');
    }
}
