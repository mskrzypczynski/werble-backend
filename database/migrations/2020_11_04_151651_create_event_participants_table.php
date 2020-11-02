<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id          ('event_participant_id')->unique()->autoIncrement();
            $table->boolean     ('is_creator');
            $table->bigInteger  ('user_id')->unsigned();
            $table->bigInteger  ('event_id')->unsigned();
            $table->bigInteger  ('participant_status_id')->unsigned();

            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('participant_status_id')->references('participant_status_id')->on('participant_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_participants');
    }
}
