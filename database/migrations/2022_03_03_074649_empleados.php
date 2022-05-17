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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipodoc_id')->unsigned();
            $table->integer('documento');
            $table->string('nombre',30);
            $table->string('email',30);
            $table->string('direccion',30);
            $table->bigInteger('municipio')->unsigned();
            $table->date('fechadenacimiento');
            $table->integer('telefono');
            $table->integer('celular');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('tipodoc_id')->references('id')->on('tipodocumentos')->onDelete("cascade");
            $table->foreign('municipio')->references('id')->on('municipios')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
