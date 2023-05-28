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
        Schema::create('commande', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('total');
          
            $table->unsignedBigInteger('etat_id');
            $table
                ->foreign('etat_id')
                ->on('etat')
                ->references('id');
            $table->unsignedBigInteger('user_id');
            $table
                ->foreign('user_id')
                ->on('users')
                ->references('id');
            $table->string('ville');
            $table->string('adress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande');
    }
};
