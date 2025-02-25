<?php

namespace App\Filament\Resources\HistoryLoanBookResource\Pages;

use App\Filament\Resources\HistoryLoanBookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryLoanBook extends EditRecord
{
    protected static string $resource = HistoryLoanBookResource::class;
    public static ?string $title = 'Ubah Data Peminjaman Buku';
    public static ?string $breadcrumb = 'Ubah Data Peminjaman Buku';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
