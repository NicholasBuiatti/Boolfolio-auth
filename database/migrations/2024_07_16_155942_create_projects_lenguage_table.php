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
        Schema::create('projects_lenguage', function (Blueprint $table) {
            $table->id();

            //VERSIONE BREVE CHE CAPISCE LARAVEL IN AUTOMATICO DA DOVE PESCARE
            $table->foreignId('project_id')->constrained();
            //VERSIONE ESTESA
            // $table->unsignedBigInteger('project_id');
            // $table->foreign('project_id')->references('id')->on('projects')

            $table->foreignId('language_id')->constrained();
            $table->primary(['project_id', 'language_id']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_lenguage');
    }
};
