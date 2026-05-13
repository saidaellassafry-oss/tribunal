<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossiers', function (Blueprint $table) {
            // On ajoute les colonnes après le champ 'client'
            // nullable() permet de ne pas casser tes anciens dossiers déjà existants
            $table->string('numero_dossier')->nullable()->after('client');
            $table->string('type_affaire')->nullable()->after('numero_dossier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dossiers', function (Blueprint $table) {
            // Au cas où on veut annuler la migration
            $table->dropColumn(['numero_dossier', 'type_affaire']);
        });
    }
};