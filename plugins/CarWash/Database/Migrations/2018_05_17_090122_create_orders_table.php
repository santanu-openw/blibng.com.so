<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');

            $table->string('bill_number')->nullable();
            $table->string('price')->nullable();
            $table->string('paid_price')->nullable();


            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();


            $table->string('payment_reference')->nullable();


            $table->enum('status', ['Pending', 'Not Paid', 'Paid'])->default('Pending');

            $table->uuid('customer_id')->index();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');

            $table->uuid('package_id')->index()->nullable();
            $table->foreign('package_id')->references('id')->on('packages');

            $table->uuid('plan_id')->index()->nullable();
            $table->foreign('plan_id')->references('id')->on('plans');

            $table->uuid('car_size_id')->index()->nullable();
            $table->foreign('car_size_id')->references('id')->on('car_sizes');





            $table->uuid('offer_id')->index()->nullable();
            $table->foreign('offer_id')->references('id')->on('offers');


            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_services', function (Blueprint $table) {
            $table->uuid('order_id')->index()->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->uuid('service_id')->index()->nullable();
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
        Schema::dropIfExists('order_services');
        Schema::dropIfExists('orders');
    }
}
