<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dewey_decimals', function (Blueprint $table) {
            $table->id();
            $table->decimal('code', 5, 1)->unique();
            $table->string('category');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dewey_decimals');
    }
};
