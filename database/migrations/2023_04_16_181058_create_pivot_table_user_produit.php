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
        Schema::create('user_produit', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('produit_id');
            $table
                ->foreign('produit_id')
                ->on('produit')
                ->references('id');
            $table->unsignedBigInteger('user_id');
            $table
                ->foreign('user_id')
                ->on('users')
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
        Schema::dropIfExists('pivot_table_user_produit');
    }
};
