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
        Schema::create('orders_payments', function (Blueprint $table) {
            $table->id();
            $table->string('numbering');
            $table->integer('subtotal');
            $table->integer('postage')->nullable()->default(0);
            $table->integer('fee')->nullable()->default(0);
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_payments');
    }
};
