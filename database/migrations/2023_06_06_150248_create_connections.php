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
        Schema::create('connections', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_ID');
            $table->unsignedBigInteger('ingredient_ID');
            $table->float('quantity_of_ingredient',5,2);
            $table->string('measure_of_ingredient');
            $table->timestamps();

            $table->foreign('meal_ID')->references('id')->on('meals')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('ingredient_ID')->references('id')->on('ingredients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
