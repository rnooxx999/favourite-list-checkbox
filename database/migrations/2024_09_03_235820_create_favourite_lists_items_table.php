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
        Schema::create('favourite_lists_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_id')->constrained('favourite_user_lists')->onDelete('cascade');
            $table->foreignId('post_id');
            //->constrained('posts')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_lists_items');
    }
};