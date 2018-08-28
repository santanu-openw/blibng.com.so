<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_sizes', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');

            $table->string('name');
            $table->string('description')->nullable();

            $table->string('img_blank')->nullable();
            $table->string('img_active')->nullable();

            $table->string('m_operation', 1)->default("+");
            $table->float('m_price')->default(0);

            $table->integer('order')->default(0);

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
        Schema::dropIfExists('car_sizes');
    }
}
