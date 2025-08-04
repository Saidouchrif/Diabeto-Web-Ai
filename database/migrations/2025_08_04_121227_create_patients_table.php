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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('id_patient');
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->integer('age');
            $table->float('glucose');
            $table->float('bmi');
            $table->float('blood_pressure');
            $table->float('pedigree');
            $table->string('result');
            $table->unsignedBigInteger('id_medecin');
            $table->foreign('id_medecin')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
