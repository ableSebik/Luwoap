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
		Schema::create('props', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('price'); // Assuming price is a decimal with 10 digits in total and 2 decimal places
			$table->string('price_range'); // for only hostel property(not required field)
			$table->enum('period', ['yr', 'mth', 'day', 'sem', 'sqm']);
			$table->enum('currency', ['GHC', '$']);
			$table->string('ft_image')->nullable();
			$table->integer('bed');
			$table->integer('bath');
			$table->decimal('sqm', 10, 2)->nullable();
			$table->string('category');
			$table->longText('more_info');
			$table->string('location');
			$table->foreignID('user_id')->references('id')->on('users'); // Foreign key column to reference agents table
			$table->string('offer_type');
			$table->string('amenities')->nullable();
			$table->enum('status', ['live', 'hidden']);
			$table->timestamps();

			// // Define the foreign key constraint
			// $table->foreign('agent_id')->references('id')->on('agents');
		});
	}


	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::dropIfExists('props');
	}
};
