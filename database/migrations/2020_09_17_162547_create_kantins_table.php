<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKantinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_menu');
            $table->integer('harga');
            $table->integer('tipe')->unsigned()->nullable();
            $table->foreign('tipe')->references('id')->on('tipes');
            $table->string('gambar');
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
        Schema::dropIfExists('kantins');
    }
}