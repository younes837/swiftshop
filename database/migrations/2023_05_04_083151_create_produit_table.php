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
        Schema::create('produit', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('photo');
            $table->string('description');
          
            $table->integer('stock');
            $table->integer('rating');
            $table->float('price');
            $table->unsignedBigInteger('categorie_id');
            $table
                ->foreign('categorie_id')
                ->on('categorie')
                ->references('id');
            $table->unsignedBigInteger('propriete_id');
            $table
                ->foreign('propriete_id')
                ->on('propriete')
                ->references('id');
            $table->unsignedBigInteger('brand_id');
            $table
                ->foreign('brand_id')
                ->on('brand')
                ->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit');
    }
};
