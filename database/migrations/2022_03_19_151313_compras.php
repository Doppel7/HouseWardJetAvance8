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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('proveedor_id')->unsigned();
            $table->string('factura')->unique();
            $table->string('total');
            $table->date('fecha');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
};
