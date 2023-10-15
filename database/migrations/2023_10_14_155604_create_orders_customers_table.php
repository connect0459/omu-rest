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
        Schema::create('orders_customers', function (Blueprint $table) {
            $table->id();
            $table->string('numbering', 13);
            $table->string('name1');
            $table->string('name2');
            $table->string('university')->nullable();
            $table->string('grade')->nullable();
            $table->string('belong')->nullable();
            $table->string('email');
            $table->string('receive_method');
            $table->date('receive_date')->nullable();
            $table->time('receive_time')->nullable();
            $table->text('notes')->nullable();
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_customers');
    }
};
