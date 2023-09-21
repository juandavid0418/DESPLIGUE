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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('Nro_Contrato');
             $table->unsignedBigInteger('idEps');
            $table->foreign('idEps')->references('id')->on('eps')->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('estado')->nullable();
            $table->text('razon_cancelacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
