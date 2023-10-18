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
        Schema::create('books_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_branch_id')->constrained('types_branches')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_info_id')->constrained('books_info')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('books_stocks');
    }
};
