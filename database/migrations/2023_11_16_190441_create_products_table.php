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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('title');
            $table->text('home_description')->nullable();
            $table->string('home_image')->nullable();
            $table->json('gallery_image');
            $table->text('benefits');
            $table->text('description');
            $table->string('size');
            $table->text('key_featured');
            $table->text('featured_ingredients');
            $table->double('price');
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
