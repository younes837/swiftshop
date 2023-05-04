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
        Schema::create('produit_commande', function (Blueprint $table) {
            $table->id();
       

            $table->unsignedBigInteger('produit_id');
            $table
                ->foreign('produit_id')
                ->on('produit')
                ->references('id');
            $table->unsignedBigInteger('commande_id');
            $table
                ->foreign('commande_id')
                ->on('commande')
                ->references('id');
            $table->integer('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_table_produit_commande');
    }
};
