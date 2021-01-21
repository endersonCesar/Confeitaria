<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('status_pedidos');
    }
}
