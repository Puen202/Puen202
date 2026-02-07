<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('map_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->foreignId('map_id')->constrained('maps')->cascadeOnDelete();
            $table->foreignId('machine_id')->constrained()->cascadeOnDelete();
            $table->float('x')->default(0);
            $table->float('y')->default(0);
            $table->float('w')->default(140);
            $table->float('h')->default(36);
            $table->float('rotation')->default(0);
            $table->timestamps();
            $table->unique(['map_id', 'machine_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('map_items');
    }
};
