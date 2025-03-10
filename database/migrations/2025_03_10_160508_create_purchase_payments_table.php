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
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade');
            $table->string('payment_method');
            $table->decimal('amount');
            $table->date('payment_date');
            $table->string('account_number_from')->nullable();
            $table->string('account_number_to')->nullable();
            $table->string('file')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_payments');
    }
};
