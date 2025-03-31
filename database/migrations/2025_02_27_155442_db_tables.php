<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('utente', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->text('email');
            $table->integer('cellulare');
            $table->string('via');
            $table->string('comune');
            $table->string('provincia');
            $table->string('nazione');
            $table->timestamps();
        });

        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('edizione');
            $table->string( 'tipo');
            $table->string('descrizione');
            $table->string('locandina_path');
            $table->timestamps();
        });

        Schema::create('iscrizione', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_utente');
            $table->unsignedBigInteger('id_evento');
            $table->string('ricevuta')->nullable();
            $table->timestamps();
        });

        Schema::create('squadra', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('calciatore', function (Blueprint $table) {
            $table->id();
            $table->string('nome_squadra');
            $table->string('nome');
            $table->string('cognome');
            $table->integer( 'numero');
            $table->string('ruolo');
            $table->timestamps();
        });

        Schema::create('goal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_marcatore');
            $table->unsignedBigInteger('id_partita');
            $table->integer('numero');
            $table->timestamps();
        });

        Schema::create('partita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_squadra_home');
            $table->unsignedBigInteger('id_squadra_away');
            $table->integer('goal_home');
            $table->integer( 'goal_away');
            $table->dateTime('data');
            $table->timestamps();
        });

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        // VINCOLI DI INTEGRITÀ REFERENZIALE

        Schema::table('iscrizione', function (Blueprint $table) {
            $table->foreign('id_evento')->references('id')->on('evento');
            $table->foreign('id_utente')->references('id')->on('utente');
        });

       // ************************* CHECK! onCascade mettere?
       // goal -> calciatore, partita
       Schema::table('goal', function (Blueprint $table) {
            $table->foreign('id_marcatore')->references('id')->on('calciatore');
            $table->foreign('id_partita')->references('id')->on('partita');
           
        });

        // partita -> squadra (se esiste la tabella 'squadra' con pk 'id'):
        Schema::table('partita', function (Blueprint $table) {
            $table->foreign('id_squadra_home')->references('id')->on('squadra');
            $table->foreign('id_squadra_away')->references('id')->on('squadra');
        
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
