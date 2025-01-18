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
            $table->string('store')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('sku')->nullable();
            $table->string('slug')->nullable();
            $table->string('unit');
            $table->string('brand');
            $table->string('selling_type');
            $table->string('item_code')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->date('manufactured_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->string('discount_type')->nullable();
            $table->integer('discount_value')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('product_type')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
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
