<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceFoodTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->integer('parent_category_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('sell_price')->nullable();
            $table->integer('stock_quentity')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('original_price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->text('thumbnail_url')->nullable();
            $table->jsonb('detail_info')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('product_review', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
            $table->jsonb('image_url')->nullable();
            $table->integer('like_number')->nullable();
            $table->text('title')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('view_comment', function (Blueprint $table) {
            $table->id();
            $table->integer('product_review_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('content')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
   
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->text('status')->nullable();
            $table->text('payment_method')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('price_at_purchase')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('number_of_item')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
        Schema::dropIfExists('product');
        Schema::dropIfExists('product_review');
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_detail');
        Schema::dropIfExists('cart');
    }
}
