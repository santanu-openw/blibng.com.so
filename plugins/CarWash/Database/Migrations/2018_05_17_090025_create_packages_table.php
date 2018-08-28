<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');

            $table->string('name');
            $table->text('description')->nullable();


            $table->tinyInteger('number_of_washes_per_week')->default(1);

            $table->string('m_operation', 1)->default("+");
            $table->float('m_price')->default(0);

            $table->integer('order')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('package_services', function (Blueprint $table) {
            $table->uuid('package_id')->index();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

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
        Schema::dropIfExists('package_services');
        Schema::dropIfExists('packages');
    }
}
