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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_customer_id')->constrained('orders_customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('numbering');
            $table->foreignId('type_order_state_id')->constrained('types_orders_states')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_info_id')->constrained('books_info')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('isbn', 13);
            $table->string('title');
            $table->integer('sale_price');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_items');
    }
};
