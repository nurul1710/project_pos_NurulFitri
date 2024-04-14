<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->double('total');
            $table->timestamps();
        });

Schema::table('orders',function(Blueprint $table){
            $table->foreign('customer_id')->references('id')->on('customers')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('orders_customer_id_foreign');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->dropIndex('orders_customer_id_foreign');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->dropIndex('orders_user_id_foreign');
        });

        Schema::dropIfExists('orders');
    }

};
