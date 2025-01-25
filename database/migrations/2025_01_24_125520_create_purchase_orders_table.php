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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('purchase_date');
            $table->tinyInteger('status')->nullable();
            $table->double('discount')->nullable();
            $table->double('shipping_cost')->nullable();
            $table->string('code')->nullable();
            $table->double('tax')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('reference')->nullable();
            $table->string('account_number')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('payment_note')->nullable();
            $table->string('discount_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
