<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryLoanBookResource\Pages;
use App\Filament\Resources\HistoryLoanBookResource\RelationManagers;
use App\Models\HistoryLoanBook;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class HistoryLoanBookResource extends Resource
{
    protected static ?string $model = HistoryLoanBook::class;
    protected static ?string $navigationLabel = 'Peminjaman Buku';
    public static ?string $pluralModelLabel = 'Proses Peminjaman Buku';
    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';
    public static function getNavigationBadge(): ?string
    {
        return HistoryLoanBook::where('status', 'not_returned')->count();
    }



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
                        Forms\Components\Textarea::make('information')
                            ->label('Informasi Tambahan')
                            ->placeholder('Tambahkan catatan atau informasi lainnya')
                            ->rows(3)
                            ->nullable(),
                        Forms\Components\DatePicker::make('returned_at')
                            ->label('Tanggal Pengembalian')
                            ->placeholder('Pilih tanggal pengembalian')
                            ->nullable()
                            ->locale('id')
                            ->minDate(now()),

                        Forms\Components\TextInput::make('staff_id')
                            ->label('Petugas')
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
                // Tables\Columns\TextColumn::make('book.title')
                //     ->label('Judul Buku')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('information')
                    ->label('Informasi')
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('staff.name')
                    ->label('Nama Petugas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->color(function ($state) {
                        return $state !== 'returned' ? 'danger' : 'success';
                    })
                    ->formatStateUsing(function ($state) {
                        return $state === 'returned' ? 'Sudah Dikembalikan' : 'Belum Dikembalikan';
                    })
                    ->badge(),
                Tables\Columns\TextColumn::make('returned_at')
                    ->label('Dikembalikan Pada')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()->slideOver()->icon('heroicon-s-eye')->color('success'),
                    Tables\Actions\EditAction::make()->color('warning')->icon('heroicon-s-pencil'),
                    Action::make('Action')
                        ->label('Dikembalikan/Belum Dikembalikan')
                        ->icon('heroicon-s-check-circle')
                        ->form([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'returned' => 'Sudah Dikembalikan',
                                    'not_returned' => 'Belum Dikembalikan',
                                ])
                        ])
                        ->action(function (HistoryLoanBook $historyLoanBook, array $data): void {
                            $historyLoanBook->status = $data['status'];
                            $historyLoanBook->save();

                            if ($data['status'] == 'returned') {
                                Notification::make()
                                    ->title('Buku Telah Dikembalikan')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Buku Belum Dikembalikan')
                                    ->success()
                                    ->send();
                            }
                        }),
                ])
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
