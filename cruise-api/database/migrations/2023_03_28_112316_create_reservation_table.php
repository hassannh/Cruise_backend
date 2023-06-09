<?php

use App\Models\Cruise;
use App\Models\Parking;
use App\Models\User;
use App\Models\Room;
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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(Cruise::class)->constrained('cruises')->cascadeOnDelete();
            $table->foreignIdFor(Room::class)->constrained('rooms')->cascadeOnDelete();
            $table->foreignIdFor(Parking::class)->constrained('parkings')->cascadeOnDelete();
            $table->bigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
