<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('prop_id')->constrained('props')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
            $table->text('comment');
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->timestamps();

            // Indexes for performance
            $table->index('user_id');
            $table->index('prop_id');
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
