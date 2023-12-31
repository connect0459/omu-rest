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
        Schema::create('books_info', function (Blueprint $table) {
            $table->id();
            // $table->string('isbn', 13);
            $table->bigInteger('isbn');
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('type_genre_id')->constrained('types_genres')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('list_price');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_info');
    }
};
