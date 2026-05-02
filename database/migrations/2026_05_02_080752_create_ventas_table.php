<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            // Relación con usuario (comprador)
            $table->foreignId('usuario_id')
                  ->constrained('usuarios')
                  ->onDelete('cascade');

            // Relación con producto
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            // Ticket (imagen privada)
            $table->string('ticket');

            // Estado de validación
            $table->boolean('validada')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};