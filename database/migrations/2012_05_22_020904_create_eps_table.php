<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eps', function (Blueprint $table) {
            $table->id();
            $table->string('eps');
            $table->string('direccion');
            $table->BigInteger('telefonogeneral');
            $table->BigInteger('telefonoprincipal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eps');
    }
};
