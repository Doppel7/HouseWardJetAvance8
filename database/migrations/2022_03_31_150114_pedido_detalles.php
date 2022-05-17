<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('pedido_id')->unsigned();
            $table->string('cantidad');
            $table->string('precio');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete("cascade");
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_detalles');
    }
};
