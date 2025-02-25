<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactUsResource\Pages;
use App\Filament\Resources\ContactUsResource\RelationManagers;
use App\Models\ContactUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactUsResource extends Resource
{
    protected static ?string $model = ContactUs::class;

    protected static ?string $navigationLabel = 'Hubungi Kami';
    public static ?string $pluralModelLabel = ' Hubungi Kami';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    public static function canViewAny(): bool
    {
        return auth()->guard('web')->user()->isAdmin();
    }
    public static function getNavigationBadge(): ?string
    {
        return ContactUs::where('status', 'unread')->count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Nama Pengirim")
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label("Email Pengirim")
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label("Pesan Pengirim")
                    ->searchable(),
            ])

            ->filters([
                //
            ])
            ->actions([
                Action::make('Tandai Sudah Dibaca')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->hidden(fn($record) => $record->status == 'read')
                    ->action(function (ContactUs $contactUs, array $data): void {
                        $contactUs->status = 'read';
                        $contactUs->save();
                        Notification::make()
                            ->title('Pesan ditandai sebagai telah dibaca')
                            ->success()
                            ->send();
                    })
                // ->isHidden(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    BulkAction::make('Tandai sudah dibaca')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function (Collection $records): void {
                            $records->each(
                                function (Model $record) {
                                    $record->status = 'read';
                                    $record->save();
                                }
                            );
                            Notification::make()
                                ->title('Pesan ditandai sebagai telah dibaca')
                                ->success()
                                ->send();
                        }),
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
            'index' => Pages\ListContactUs::route('/'),
            'create' => Pages\CreateContactUs::route('/create'),
            'edit' => Pages\EditContactUs::route('/{record}/edit'),
        ];
    }
}
