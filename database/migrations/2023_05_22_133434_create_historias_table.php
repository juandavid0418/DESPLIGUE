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
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
            $table->string('diagnostico');
            $table->string('signosvitales');
            $table->string('antecedentesalergicos');
            $table->string('evolucion');
            $table->string('tratamiento');
             $table->unsignedBigInteger('pacientes_id');
            $table->foreign('pacientes_id')->references('id')->on('pacientes')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historias');
    }
};
