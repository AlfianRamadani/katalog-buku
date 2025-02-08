<?php

use App\Models\Category;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('language')->nullable();
            $table->text('cover')->nullable();
            $table->text('slug')->nullable();
            $table->enum('status', ['available', 'not_available'])->default('available');
            $table->string('publisher')->nullable();
            $table->string('publication_year')->nullable();
            $table->string('isbn_number')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
