<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalvaRecehioTortasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salva_recehio_tortas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recheios_id');
            $table->foreign('recheios_id')->references('id')->on('recheios');
            $table->unsignedBigInteger('tortas_id');
            $table->foreign('tortas_id')->references('id')->on('tortas');
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
        Schema::dropIfExists('salva_recehio_tortas');
    }
}
