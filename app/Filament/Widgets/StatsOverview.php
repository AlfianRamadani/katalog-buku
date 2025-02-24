<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Category;
use App\Models\HistoryLoanBook;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{


    public static function canView(): bool
    {
        return true;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Book::count())->color('success'),
            Stat::make('Total Peminjaman Buku', HistoryLoanBook::where('status', 'not_returned')->count()),
            Stat::make('Total Kategori', Category::count()),
        ];
    }
}
