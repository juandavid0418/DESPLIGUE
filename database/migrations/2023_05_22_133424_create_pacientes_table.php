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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo');
            $table->BigInteger('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->BigInteger('documento');
            $table->integer('estado')->default(0);
            $table->unsignedBigInteger('idContrato')->nullable();
            $table->foreign('idContrato')->references('id')->on('contratos')->onDelete('cascade');
            $table->integer('ejecucion')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
