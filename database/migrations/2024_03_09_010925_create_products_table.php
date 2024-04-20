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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('stock');
            $table->double('price');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

        });

        Schema::table('products', function (Blueprint $table) {
                     $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');

        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_category_id_foreign');
        });

        Schema::dropIfExists('products');
    }

};
