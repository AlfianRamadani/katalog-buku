<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use App\Imports\BookImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Log;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Action::make('importProducts')
                ->label('Import Product')
                ->icon('heroicon-s-arrow-down-tray')
                ->color('danger')
                ->form([
                    FileUpload::make('attachment')
                        ->label('Upload Template Product')
                ])
                ->action(function (array $data) {
                    $file = public_path('storage/' . $data['attachment']);
                    try {
                        Excel::import(new BookImport, $file);
                        Notification::make()
                            ->title('Product imported')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Log::error('error import book data:' . $e->getMessage());
                        Notification::make()
                            ->title('Product failed to import')
                            ->danger()
                            ->send();
                    }
                }),
            Action::make("Download Data")
                ->label('Download Data')
                ->url(route('download-template'))
                ->color('success'),
            CreateAction::make(),
        ];
    }
}
