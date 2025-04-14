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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('operation');        // Operación
            $table->string('credit_bank');      // Banco del crédito
            $table->string('assignment');       // Persona asignada
            $table->string('customer_type');    // Tipo de cliente
            $table->string('customer_name');    // Nombre del cliente
            $table->text('description');        // Descripción
            $table->dateTime('alert_datetime'); // Fecha y hora de la alerta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
