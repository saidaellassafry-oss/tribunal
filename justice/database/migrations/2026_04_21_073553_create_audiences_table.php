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

            $table->string('titre');
            $table->string('tribunal');
            $table->string('salle');
            $table->date('date_audience');
            $table->time('heure');

            $table->string('juge')->nullable();

            $table->enum('status', ['planifie', 'terminee', 'reportee'])
                  ->default('planifie');

            $table->text('remarque')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audiences');
    }
};