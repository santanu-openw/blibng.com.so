<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');

            $table->uuid('order_id')->index();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');


            $table->string('week');
            $table->string('year');
            $table->string('month');
            $table->string('day');
            $table->string('hour');

            $table->string('car_numbers')->nullable();

            $table->string('client_notes')->nullable();
            $table->string('team_notes')->nullable();


            $table->boolean('completed')->default(false);
            $table->string('status')->nullable();

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
        Schema::dropIfExists('appointments');
    }
}
