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
        Schema::create('plates', function (Blueprint $table) {
            
            
            $table->id(); 

            $table->foreignId('restaurant_id')->constrained();

            $table->string('name', 50);
            $table->text('ingredients');
            $table->decimal('price');
            $table->text('image')->nullable();
            $table->boolean('visible')->default(false);
            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plates');
    }
};
