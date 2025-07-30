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
    Schema::create('product_photos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('products_id')->constrained()->onDelete('cascade');
        $table->string('photo'); // chemin de la photo
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_photos');
    }
};
