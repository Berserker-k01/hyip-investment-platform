<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('min_deposit', 20, 8)->default(0);
            $table->decimal('max_deposit', 20, 8)->default(0);
            $table->decimal('profit_rate', 10, 4)->default(0); // percentage or fixed depending on business rules
            $table->enum('profit_type', ['percent', 'fixed'])->default('percent');
            $table->integer('duration_days')->default(0);
            $table->unsignedTinyInteger('status')->default(1); // 1=active, 0=inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
