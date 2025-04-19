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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_code')->unique();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('receive_date');
            $table->string('payment_status');
            $table->integer('total_receive_quantity');

            $table->string('discount_type')->nullable();
            $table->decimal('discount_value')->default(0);
            $table->decimal('total_discount')->default(0);
            $table->decimal('total_tax')->default(0);
            $table->decimal('total_shipping_cost')->default(0);
            $table->decimal('product_subtotal');
            $table->decimal('grand_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
