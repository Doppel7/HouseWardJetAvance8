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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipodoc_id')->unsigned()->default(1);
            $table->bigInteger('rol_id')->unsigned()->default(1);
            $table->string('documento')->default(1);
            $table->string('name');
            $table->string('celular')->default(1);
            $table->date('fechadenacimiento')->default('2022-03-23');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('estado')->default(1);
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->foreign('tipodoc_id')->references('id')->on('tipodocumentos')->onDelete("cascade");
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
