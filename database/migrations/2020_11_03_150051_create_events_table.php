<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id          ('event_id')->unique()->autoIncrement();
            $table->string      ('name');
            $table->string      ('location')->nullable();
            $table->string      ('zip_code')->nullable();
            $table->string      ('street_name')->nullable();
            $table->string      ('house_number')->nullable();
            $table->double      ('longitude')->nullable();
            $table->double      ('latitude')->nullable();
            $table->string      ('description')->nullable();
            $table->dateTime    ('datetime');
            $table->boolean     ('is_active');
            $table->bigInteger  ('event_visibility_level_id')->unsigned();
            $table->bigInteger  ('event_status_id')->unsigned();
            $table->bigInteger  ('event_creator_id')->unsigned();
            $table->bigInteger  ('event_type_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('event_visibility_level_id')->references('user_id')->on('users');
            $table->foreign('event_status_id')->references('event_status_id')->on('event_statuses');
            $table->foreign('event_creator_id')->references('user_id')->on('users');
            $table->foreign('event_type_id')->references('event_type_id')->on('event_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
