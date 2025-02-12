<?php

use App\Models\Book;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Book::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('descriptions');
            $table->timestamps();
            $table->enum('rate', [1, 2, 3, 4, 5]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
