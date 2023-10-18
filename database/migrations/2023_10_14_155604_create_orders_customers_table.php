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
            $table->foreignId('type_branch_id')->constrained('types_branches')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('numbering')->unique();
            $table->string('name1');
            $table->string('name2');
            $table->string('university')->nullable();
            $table->string('grade')->nullable();
            $table->string('belong')->nullable();
            $table->string('email');
            $table->integer('total');
            $table->foreignId('type_receive_id')->constrained('types_receives')->cascadeOnUpdate()->cascadeOnDelete();
            $table->datetime('receive_date')->nullable();
            $table->foreignId('type_payment_id')->constrained('types_payments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->datetime('payment_due_date')->nullable();
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
