<?php

use App\Models\Book;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_loan_books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('member_id')->nullable();
            $table->foreignIdFor(Book::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['returned', 'not_returned'])->default('not_returned');
            $table->text('information')->nullable();
            $table->datetime('returned_at')->nullable();
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_loan_book');
        Schema::dropIfExists('history_loan_book');
    }
};
