<?php

use App\Models\Cruise;
use App\Models\RoomType;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ship::class)->constrained('ships')->cascadeOnDelete();
            $table->foreignIdFor(Cruise::class)->constrained('cruises')->cascadeOnDelete();
            $table->foreignIdFor(RoomType::class)->constrained('room_types')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
