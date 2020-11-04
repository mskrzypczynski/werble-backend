<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_friends', function (Blueprint $table) {
            $table->id          ('friendship_id')->unique()->autoIncrement();
            $table->bigInteger  ('user_id')->unsigned();
            $table->bigInteger  ('friend_id')->unsigned();
            $table->bigInteger  ('friendship_status_id')->unsigned();
            $table->softDeletes();

            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('friend_id')->references('user_id')->on('users');
            $table->foreign('friendship_status_id')->references('friendship_status_id')->on('friendship_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_friends');
    }
}
