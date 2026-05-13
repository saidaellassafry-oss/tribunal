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
    Schema::table('demandes', function (Blueprint $table) {
        $table->string('full_name')->nullable();
        $table->string('phone')->nullable();
        $table->string('cin')->nullable();
        $table->string('address')->nullable();
        $table->string('city')->nullable();
        $table->string('priority')->default('normal');
    });
}
};
