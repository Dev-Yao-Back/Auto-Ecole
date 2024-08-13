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
        Schema::create('auto_ecoles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'auto-école
            $table->string('address'); // Adresse
            $table->string('phone'); // Numéro de téléphone
            $table->string('email')->unique(); // Adresse email unique
            $table->string('logo')->nullable(); // Logo de l'auto-école
            $table->text('description')->nullable(); // Description de l'auto-école
            $table->unsignedBigInteger('commune')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_ecoles');
    }
};