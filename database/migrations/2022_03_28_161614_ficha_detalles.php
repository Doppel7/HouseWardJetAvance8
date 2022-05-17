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
        Schema::create('ficha_detalles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ficha_id')->unsigned();
            $table->bigInteger('insumo_id')->unsigned();
            $table->integer('cantidad');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('insumo_id')->references('id')->on('insumos')->onDelete("cascade");
            $table->foreign('ficha_id')->references('id')->on('fichatecnicas')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ficha_detalles');
    }
};
