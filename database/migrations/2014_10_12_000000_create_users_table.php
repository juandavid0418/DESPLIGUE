<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido');
            $table->BigInteger('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->BigInteger('cedula');
            $table->string('zona')->nullable();
            $table->string('email')->unique();
            $table->integer('estado')->default(0);
            $table->unsignedBigInteger('idRol');
            $table->foreign('idRol')->references('id')->on('rols')->onDelete('cascade'); 
            $table->unsignedBigInteger('idContrato')->nullable();
            $table->foreign('idContrato')->references('id')->on('contratos')->onDelete('cascade');
            $table->integer('ejecucion')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
