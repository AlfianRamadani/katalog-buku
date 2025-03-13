<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('edition')->nullable()->after('publisher');
            $table->string('city_publisher')->nullable()->after('edition');
            $table->string('total_page')->nullable()->after('city_publisher');
            $table->string('total_roman_page')->nullable()->after('total_page');
            $table->string('book_length')->nullable()->after('total_roman_page');
            $table->foreignId('dewey_decimal_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate()->after('book_length');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'edition',
                'city_publisher',
                'total_page',
                'total_roman_page',
                'book_length'
            ]);
            $table->dropForeign(['dewey_decimal_id']);
            $table->dropColumn('dewey_decimal_id');
        });
    }
};
