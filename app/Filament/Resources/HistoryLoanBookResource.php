<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryLoanBookResource\Pages;
use App\Filament\Resources\HistoryLoanBookResource\RelationManagers;
use App\Models\HistoryLoanBook;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoryLoanBookResource extends Resource
{
    protected static ?string $model = HistoryLoanBook::class;
    protected static ?string $navigationLabel = 'Peminjaman Buku';
    public static ?string $pluralModelLabel = 'Proses Peminjaman Buku';
    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Section::make('Informasi Peminjaman')
                    ->description('Masukkan detail peminjaman buku.')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Peminjam')
                                    ->placeholder('Masukkan nama peminjam')
                                    ->nullable(),
                                Forms\Components\TextInput::make('member_id')
                                    ->label('ID Anggota')
                                    ->placeholder('Masukkan ID Anggota')
                                    ->nullable(),
                            ]),

                        Forms\Components\Select::make('book_id')
                            ->label('Buku')
                            ->relationship('book', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\DatePicker::make('deadline')
                            ->label('Batas Pengembalian')
                            ->placeholder('Pilih tanggal batas pengembalian')
                            ->nullable(),

                        Forms\Components\Textarea::make('information')
                            ->label('Informasi Tambahan')
                            ->placeholder('Tambahkan catatan atau informasi lainnya')
                            ->rows(3)
                            ->nullable(),

                        Forms\Components\Select::make('staff_id')
                            ->label('Petugas')
                            ->options(User::pluck('name', 'id')->toArray())
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nama')
                ->searchable(),
            Tables\Columns\TextColumn::make('member_id')
                ->label('ID Anggota')
                ->searchable(),
            Tables\Columns\TextColumn::make('book.title')
                ->label('Judul Buku')
                ->sortable(),
            Tables\Columns\TextColumn::make('deadline')
                ->label('Tenggat Waktu')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('information')
                ->label('Informasi')
                ->limit(50)
                ->wrap(),
            Tables\Columns\TextColumn::make('staff.name')
                ->label('Nama Petugas')
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat Pada')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([
            // Tambahkan filter jika diperlukan
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
            'index' => Pages\ListHistoryLoanBooks::route('/'),
            'create' => Pages\CreateHistoryLoanBook::route('/create'),
            'edit' => Pages\EditHistoryLoanBook::route('/{record}/edit'),
        ];
    }
}
