<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('theme')->default(1);
            $table->string('site_currency', 16)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
