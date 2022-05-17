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
        Schema::create('compra_detalles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('insumo_id')->unsigned();
            $table->bigInteger('compra_id')->unsigned();
            $table->string('cantidad');
            $table->string('precio');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('insumo_id')->references('id')->on('insumos')->onDelete("cascade");
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_detalles');
    }
};
