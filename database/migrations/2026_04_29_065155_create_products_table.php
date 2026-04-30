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
            $table->id(); // 商品番号（products.id）
            $table->string('product_name'); // 商品名（products.product_name）
            $table->text('description'); // 商品説明（products.description）
            $table->integer('price'); // 料金（products.price）
            $table->integer('stock')->default(0);//在庫数
            $table->string('image')->nullable();//商品画像
            $table->timestamps(); // 作成日時・更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
