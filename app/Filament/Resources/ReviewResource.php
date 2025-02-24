<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\HistoryLoanBook;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('history_loan_book_id')
                    ->label('Nama Peminjam')
                    ->relationship('HistoryLoanBook', 'name', fn($query) => $query->where('status', 'returned'))
                    ->live()
                    ->afterStateUpdated(
                        fn($state, callable $set) =>
                        $set('book_id', \App\Models\HistoryLoanBook::find($state)?->book_id)
                    )
                    ->preload(),
                TextInput::make('descriptions')
                    ->label('Deskripsi')
                    ->placeholder('Masukkan deskripsi komentar')
                    ->required(),
                Select::make('rate')
                    ->label('Rating')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ])
                    ->required(),
                TextInput::make('book_id')->label('Id Buku')->readOnly()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('history_loan_book_id')
                    ->label('Nama Peminjam')
                    ->formatStateUsing(fn($state) => HistoryLoanBook::find($state)?->name ?? '-'),
                TextColumn::make('descriptions')
                    ->label('Deskripsi'),
                TextColumn::make('rate')
                    ->label('Rating')
                    ->formatStateUsing(fn($state) => $state . ' Bintang'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
