<?php

namespace App\Filament\Resources\HistoryLoanBookResource\Pages;

use App\Filament\Resources\HistoryLoanBookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryLoanBook extends EditRecord
{
    protected static string $resource = HistoryLoanBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
