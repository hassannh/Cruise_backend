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
        Schema::create('passage', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Cruise::class)->constrained('cruises')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Port::class)->constrained('ports')->cascadeOnDelete();         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passage');
    }
};
