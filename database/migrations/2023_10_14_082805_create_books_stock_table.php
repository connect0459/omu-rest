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
        Schema::create('books_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('books_info_id')->unique()->constrained('books_info')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('branch');
            $table->string('isbn', 13);
            $table->integer('stock')->default(0);
            $table->integer('order')->default(0);
            $table->integer('sold')->default(0);
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_stock');
    }
};
