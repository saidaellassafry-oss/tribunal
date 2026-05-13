<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('audiences', function (Blueprint $table) {

            $table->id();

            // 📁 relation dossier
            $table->foreignId('dossier_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            // $table->string('defenseur')->nullable();
$table->string('accuse')->nullable();
            // ⚖ info audience
            $table->string('titre');
            $table->string('tribunal')->nullable();
            $table->date('date_audience');
            $table->time('heure');
            $table->string('salle');

            $table->string('juge')->nullable();

            $table->string('status')->default('planifie');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audiences');
    }
};