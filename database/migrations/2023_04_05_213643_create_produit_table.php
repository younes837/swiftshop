<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('photo');
            $table->string('description');
            $table->string('brand');
            $table->integer('stock');
            $table->integer('rating');
            $table->float('price');
            $table->unsignedBigInteger('categorie_id');
            $table
                ->foreign('categorie_id')
                ->on('categorie')
                ->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit');
    }
};
