<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');

            $table->string('name');
            $table->text('description');

            $table->integer('period_days')->default(1);

            $table->string('m_operation', 1)->default("+");
            $table->float('m_price')->default(0);

            $table->integer('order')->default(0);

            $table->string('img_blank')->nullable();
            $table->string('img_active')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('package_plans', function (Blueprint $table) {
            $table->uuid('package_id')->index();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            $table->uuid('plan_id')->index();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_plans');
        Schema::dropIfExists('plans');
    }
}
