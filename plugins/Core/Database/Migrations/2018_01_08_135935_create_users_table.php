<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->uuid('id')->unique();
            $table->primary('id');

            $table->string('user_id')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->text('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('password');


            $table->string('phone_number')->unique()->nullable();
            $table->string('mobile_number')->unique()->nullable();

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('code_postal')->nullable();

            $table->string('position')->nullable();
            $table->text('bio')->nullable();

            $table->enum('gender', ['Men', 'Women'])->nullable();
            $table->enum('lang', ['en', 'fr', 'ar'])->nullable();

            $table->date('birth_date')->nullable();

            $table->boolean('status')->default(true);
            $table->boolean('banned')->default(false);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
