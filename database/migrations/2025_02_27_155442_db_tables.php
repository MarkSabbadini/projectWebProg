<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    public function up(): void
    {
        Schema::create('utente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // relazione con users
            $table->string('nome');
            $table->string('cognome');
            $table->string('email')->unique();
            $table->string('cellulare')->nullable(); 
            $table->string('via')->nullable();
            $table->string('comune')->nullable();
            $table->string('provincia')->nullable();
            $table->string('nazione')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('edizione');
            $table->string('tipo');
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
            $table->integer('numero');
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
            $table->integer('goal_away');
            $table->dateTime('data');
            $table->timestamps();
        });

        // Aggiunta colonna role agli utenti
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('registered_user');
        });

        // RELAZIONI

        Schema::table('iscrizione', function (Blueprint $table) {
            $table->foreign('id_evento')->references('id')->on('evento')->onDelete('cascade');
            $table->foreign('id_utente')->references('id')->on('utente')->onDelete('cascade');
        });

        Schema::table('goal', function (Blueprint $table) {
            $table->foreign('id_marcatore')->references('id')->on('calciatore')->onDelete('cascade');
            $table->foreign('id_partita')->references('id')->on('partita')->onDelete('cascade');
        });

        Schema::table('partita', function (Blueprint $table) {
            $table->foreign('id_squadra_home')->references('id')->on('squadra')->onDelete('cascade');
            $table->foreign('id_squadra_away')->references('id')->on('squadra')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('iscrizione', function (Blueprint $table) {
            $table->dropForeign(['id_evento']);
            $table->dropForeign(['id_utente']);
        });

        Schema::table('goal', function (Blueprint $table) {
            $table->dropForeign(['id_marcatore']);
            $table->dropForeign(['id_partita']);
        });

        Schema::table('partita', function (Blueprint $table) {
            $table->dropForeign(['id_squadra_home']);
            $table->dropForeign(['id_squadra_away']);
        });

        Schema::table('utente', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::dropIfExists('goal');
        Schema::dropIfExists('partita');
        Schema::dropIfExists('calciatore');
        Schema::dropIfExists('squadra');
        Schema::dropIfExists('iscrizione');
        Schema::dropIfExists('evento');
        Schema::dropIfExists('utente');
    }
};
