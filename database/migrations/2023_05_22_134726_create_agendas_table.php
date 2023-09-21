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
        
 Schema::create('agendas', function (Blueprint $table) {
    $table->id();
    $table->integer('estado')->default(0);
    $table->unsignedBigInteger('idContrato')->nullable();
    $table->foreign('idContrato')->references('id')->on('contratos')->onDelete('cascade');
    $table->date('fecha_inicio');
    $table->date('fecha_fin');
    $table->time('hora');
    $table->time('hora_fin');
    $table->unsignedBigInteger('id_pacientes');
    $table->foreign('id_pacientes')->references('id')->on('pacientes')->onDelete('cascade'); 
    $table->unsignedBigInteger('id_user');
    $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); 
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
