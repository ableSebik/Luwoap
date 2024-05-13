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
			$table->decimal('price', 10, 2); // Assuming price is a decimal with 10 digits in total and 2 decimal places
			$table->enum('currency', ['GHC', '$']);
			$table->string('ft_image')->nullable();
			$table->integer('bed');
			$table->integer('bath');
			$table->decimal('sq_ft', 10, 2)->nullable();
			$table->string('category');
			$table->longText('more_info');
			$table->string('location');
			$table->foreignID('user_id')->references('id')->on('users'); // Foreign key column to reference agents table
			$table->string('offer_type');
			$table->string('amenities')->nullable();
			$table->timestamps();

			// // Define the foreign key constraint
			// $table->foreign('agent_id')->references('id')->on('agents');
		});

		Schema::table('props', function (Blueprint $table) {
			// Add indexes for frequently queried columns
			$table->index(['price', 'category', 'location', 'user_id']); // Include agent_id in the index
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
