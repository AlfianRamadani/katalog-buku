<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestBookResource\Pages;
use App\Filament\Resources\RequestBookResource\RelationManagers;
use App\Models\RequestBook;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestBookResource extends Resource
{
    protected static ?string $model = RequestBook::class;
    protected static ?string $navigationLabel = 'Request Buku';
    public static ?string $pluralModelLabel = 'Request Data Buku';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Pada Tanggal')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRequestBooks::route('/'),
            'create' => Pages\CreateRequestBook::route('/create'),
            'edit' => Pages\EditRequestBook::route('/{record}/edit'),
        ];
    }
}
