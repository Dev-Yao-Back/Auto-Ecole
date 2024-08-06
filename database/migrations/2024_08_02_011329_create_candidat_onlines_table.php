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
        Schema::create('candidat_onlines', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();  // Matricule unique pour chaque candidat
            $table->string('name');
            $table->string('surname');
            $table->string('email')->nullable();;  // Email pour les notifications
            $table->string('tel_number1')->nullable();
            $table->string('sexe')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('commune_residence')->nullable();
            $table->unsignedBigInteger('categorie_permis_id');
            $table->foreign('categorie_permis_id')->references('id')->on('categories');
            $table->unsignedBigInteger('subvention_id')->nullable();
            $table->foreign('subvention_id')->references('id')->on('subventions');
            $table->string('moyen_payement')->nullable();
            $table->string('promo_code')->nullable(); // Code promo peut être facultatif
            $table->string('name_dad')->nullable();;
            $table->string('name_mom')->nullable();;
            $table->string('number_piece')->nullable();  // Numéro de la pièce d'identité
            $table->string('type_piece')->nullable();   // Type de la pièce d'identité
            $table->string('libelle')->nullable();
            $table->timestamps();

            // Clés étrangères et relations

            $table->foreignId('piece_id')->nullable()->constrained('pieces')->onDelete('set null');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidat_onlines');
    }
};