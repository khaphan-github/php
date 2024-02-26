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
            $table->morphs('name');
            $table->string('icon');
            $table->integer('parent_categor_id')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });

        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->integer('sell_price');
            $table->integer('stock_quentity');
            $table->integer('category_id');
            $table->integer('original_price');
            $table->integer('discount_price');
            $table->text('thumbnail_url');
            $table->jsonb('detail_info');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });

        Schema::create('product_review', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('rating');
            $table->text('comment');
            $table->jsonb('image_url');
            $table->integer('like_number');
            $table->text('title');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });

        Schema::create('view_comment', function (Blueprint $table) {
            $table->id();
            $table->integer('product_review_id');
            $table->integer('user_id');
            $table->text('content');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
   
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('status');
            $table->text('payment_method');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('price_at_purchase');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id');
            $table->integer('product_id');
            $table->integer('number_of_item');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
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
