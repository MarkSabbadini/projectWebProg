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
        Schema::create('iscritto', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->string('cellulare');
            $table->string('email');
            $table->timestamps();

        });

        Schema::create('iscrizione', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_iscritto');
            $table->string('tipo_iscrizione');
            $table->string('tipo_evento');
            $table->timestamps();
        });

        Schema::create('indirizzo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indirizzo_residenza');
            $table->string('comune');
            $table->timestamps();
        });

        Schema::table('iscrizione', function (Blueprint $table) {
            $table->foreign('id_iscritto')->references('id')->on('iscritto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_tables');
    }
};
