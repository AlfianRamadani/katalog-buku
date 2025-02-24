<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestBooks extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Buku Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Book::query()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('title')->label('Judul'),
                TextColumn::make('author')->label('Penulis'),
                TextColumn::make('category.name')->label('Kategori'),
                TextColumn::make('created_at')->label('Di tambahkan pada'),
            ]);
    }
}
