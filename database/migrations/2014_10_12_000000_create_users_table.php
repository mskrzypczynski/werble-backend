<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id      ('user_id')->autoIncrement()->unique();
            $table->string  ('login')->unique();
            $table->string  ('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string  ('password');
            $table->string  ('first_name')->nullable();
            $table->string  ('last_name')->nullable();
            $table->date    ('birth_date')->nullable();
            $table->string  ('description')->nullable();
            $table->decimal ('longitude',10,7)->nullable();
            $table->decimal  ('latitude',10,7)->nullable();
            $table->boolean ('is_admin');
            $table->boolean ('is_active');
            //$table->string  ('api_token')->unique();
            $table->softDeletes();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
