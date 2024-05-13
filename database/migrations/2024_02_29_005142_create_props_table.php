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
        Schema::create('props', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price', 10, 2); // Assuming price is a decimal with 10 digits in total and 2 decimal places
            $table->string('image')->nullable();
            $table->integer('beds');
            $table->integer('baths');
            $table->integer('sq_ft');
            $table->string('home_type');
            $table->integer('year_built');
            $table->decimal('price_per_sqft', 10, 2); // Assuming price/sqft is a decimal with 10 digits in total and 2 decimal places
            $table->text('more_info')->nullable();
            $table->string('location');
            $table->string('agent_name');
            $table->string('prop_type')->default('hostel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('props');
    }
};
