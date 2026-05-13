<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('demandes', 'dossier_number')) {
            Schema::table('demandes', function (Blueprint $table) {
                $table->string('dossier_number')->nullable()->after('id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('demandes', 'dossier_number')) {
            Schema::table('demandes', function (Blueprint $table) {
                $table->dropColumn('dossier_number');
            });
        }
    }
};