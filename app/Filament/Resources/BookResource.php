<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationLabel = 'Buku';
    public static ?string $pluralModelLabel = 'Data Buku';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Buku')
                    ->description('Masukkan detail informasi tentang buku.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Buku')
                            ->placeholder('Masukkan judul buku')
                            ->required(),

                        Forms\Components\TextInput::make('author')
                            ->label('Penulis')
                            ->placeholder('Nama penulis buku')
                            ->required(),

                        Forms\Components\Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('sub_category')
                            ->label('Sub Kategori')
                            ->placeholder('Masukkan sub kategori'),

                        Forms\Components\TextInput::make('language')
                            ->label('Bahasa')
                            ->placeholder('Contoh: Indonesia, Inggris')
                            ->required(),

                        Forms\Components\FileUpload::make('cover_url')
                            ->label('Cover Buku')
                            ->maxSize(2048)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('publisher')
                            ->label('Penerbit')
                            ->placeholder('Masukkan nama penerbit')
                            ->required(),

                        Forms\Components\DatePicker::make('publication_year')
                            ->label('Tahun Terbit')
                            ->placeholder('Pilih tahun terbit')
                            ->format('Y')
                            ->required(),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Status Publikasi')
                            ->helperText('Tandai jika buku telah dipublikasikan')
                            ->default(true),

                        Forms\Components\TextInput::make('isbn_number')
                            ->label('Nomor ISBN')
                            ->placeholder('Masukkan ISBN (jika ada)')
                            ->numeric(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Masukkan deskripsi singkat tentang buku')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('publisher')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_year')
                    ->date()
                    ->sortable(),
                ImageColumn::make('cover'),
                Tables\Columns\TextColumn::make('isbn_number')
                    ->searchable(),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
