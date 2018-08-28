<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');


            $table->string('name');
            $table->uuid('package_id')->index();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();


            $table->integer('number_of_free_washes')->nullable();


            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('offer_services', function (Blueprint $table) {
            $table->uuid('offer_id')->index();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');

            $table->uuid('service_id')->index();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_services');
        Schema::dropIfExists('offers');
    }
}
