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
        Schema::create('utente', function (Blueprint $table) {
            $table -> id();
            $table -> string('nome');
            $table -> string('cognome');
            $table -> text('email');
            $table -> integer('cellulare');
            $table -> string('via');
            $table -> integer('civico');
            $table -> string('comune');
            $table -> string('provincia');
            $table -> string('nazione');
            $table -> timestamps();
       });

       Schema::create('evento', function (Blueprint $table) {
        $table -> id();
        $table -> string('nome');
        $table -> string('descrizione');
        $table -> integer('edizione');
        $table -> string('path_locandina');
        $table -> timestamps();
   });

       Schema::create('iscrizione', function (Blueprint $table) {
        $table -> id();
        $table -> unsignedBigInteger('id_utente');
        $table -> unsignedBigInteger('id_evento');
        $table -> timestamps();
        });

        // VINCOLI DI INTEGRITÀ REFERENZIALE

        Schema::table('iscrizione', function(Blueprint $table){
            $table->foreign('id_evento')->references('id')->on('evento');
            $table->foreign('id_utente')->references('id')->on('utente');
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
