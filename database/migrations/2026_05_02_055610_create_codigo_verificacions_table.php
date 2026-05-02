<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codigo_verificacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('codigo');
            $table->timestamp('expiracion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codigo_verificacions');
    }
};