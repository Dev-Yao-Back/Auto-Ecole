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
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
             $table->string('matricule');
            $table->string('name');
            $table->string('surname');
            $table->string('tel_number1');
            $table->string('tel_number2')->nullable();
            $table->string('tel_number3')->nullable();
            $table->string('sexe');
            $table->string('date_birth');
            $table->string('name_dad');
            $table->string('name_moom');
            $table->string('lib_subvention');
            $table->string('amont');
            $table->string('reste');
            $table->string('autre');
            $table->string('piece_rec');
            $table->string('piece_ver');
            $table->string('number_piece');
            $table->string('categorie_permis');
            $table->string('moyen_payement');
            $table->unsignedBigInteger('source_id');
            $table->foreign('source_id')->references('id')->on('sources');
            $table->unsignedBigInteger('subvention_id');
            $table->foreign('subvention_id')->references('id')->on('subventions');
            $table->unsignedBigInteger('piece_id');
            $table->foreign('piece_id')->references('id')->on('pieces');
            $table->unsignedBigInteger('statut_id');
            $table->foreign('statut_id')->references('id')->on('statuts');
            $table->boolean('is_visible')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
