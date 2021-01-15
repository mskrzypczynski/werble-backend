<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_reviews', function (Blueprint $table) {
            $table->id          ('event_review_id')->unique()->autoIncrement();
            $table->string      ('content')->nullable();
            $table->integer     ('rating')->nullable();
            $table->bigInteger  ('event_participant_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('event_participant_id')->references('event_participant_id')
                ->on('event_participants')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_reviews');
    }
}
