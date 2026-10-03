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
        Schema::create('formation__formateurs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('formation_id')->unsigned();
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->bigInteger('formateur_id')->unsigned();
            $table->foreign('formateur_id')->references('id')->on('formateurs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation__formateurs');
    }
};
