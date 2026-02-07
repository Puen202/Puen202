<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->foreignId('zone_id')->constrained()->cascadeOnDelete();
            $table->string('name', 120);
            $table->string('hostname', 190)->nullable();
            $table->ipAddress('ip')->unique();
            $table->string('mac', 30)->nullable();
            $table->string('type', 50);
            $table->string('vendor', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('os', 100)->nullable();
            $table->string('department', 100)->index();
            $table->enum('status', ['activo', 'fuera_servicio', 'reserva', 'desconocido'])->default('desconocido');
            $table->enum('criticality', ['baja', 'media', 'alta'])->default('media');
            $table->text('notes')->nullable();
            $table->boolean('cannot_move')->default(false);
            $table->string('ip_locked_reason')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();

            $table->index('type');
            $table->index('zone_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
