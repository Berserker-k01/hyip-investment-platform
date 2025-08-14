<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('trx')->nullable();
            $table->string('type', 32)->nullable(); // deposit, withdraw, profit, transfer, etc.
            $table->decimal('amount', 20, 8)->default(0);
            $table->decimal('post_balance', 20, 8)->default(0);
            $table->string('currency', 16)->nullable();
            $table->unsignedTinyInteger('status')->default(1); // 1=success,0=pending,2=failed
            $table->text('details')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'trx']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
