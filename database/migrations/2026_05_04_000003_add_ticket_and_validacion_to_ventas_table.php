<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->string('ticket')->nullable()->after('total');
            $table->timestamp('validada_at')->nullable()->after('ticket');
            $table->foreignId('validada_por')->nullable()->after('validada_at')->constrained('usuarios')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('validada_por');
            $table->dropColumn(['ticket', 'validada_at']);
        });
    }
};
