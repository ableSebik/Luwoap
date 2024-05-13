<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prop_id')->constrained()->onDelete('cascade');
            $table->boolean('air_conditioning')->default(false);
            $table->boolean('room_service')->default(false);
            $table->boolean('balcony')->default(false);
            $table->boolean('gym')->default(false);
            $table->boolean('pool')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('wifi')->default(false);
            $table->boolean('double_bed')->default(false);
            $table->boolean('cctv')->default(false);
            $table->boolean('jacuzzi')->default(false);
            $table->boolean('security')->default(false);
            $table->boolean('telephone')->default(false);
            $table->boolean('alarm')->default(false);
            $table->boolean('garage')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
