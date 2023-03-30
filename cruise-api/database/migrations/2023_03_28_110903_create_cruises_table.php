<?php

use App\Models\Parking;
use App\Models\Port;
use App\Models\Ship;
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
        Schema::create('cruises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Ship::class)->constrained('ships')->cascadOnDelete();
            $table->integer('price');
            $table->string('picture');
            $table->string('nights_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cruises');
    }
};
