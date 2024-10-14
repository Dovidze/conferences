<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferenceRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('conference_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conference_id')->constrained()->onDelete('cascade'); // Priklauso konferencijai
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Registruojantis vartotojas
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conference_registrations');
    }
}
