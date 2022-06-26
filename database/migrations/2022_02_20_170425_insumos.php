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
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->integer('cantidad')->default(0);
            $table->bigInteger('unidad_id')->unsigned();
            $table->bigInteger('categoria_id')->unsigned();
            $table->boolean('estado')->nullable()->default(1);
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categoriainsumos')->onDelete("cascade");
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos');
    }
};
