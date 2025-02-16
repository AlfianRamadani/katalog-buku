<?php

namespace App\Filament\Resources\HistoryLoanBookResource\Pages;

use App\Filament\Resources\HistoryLoanBookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHistoryLoanBook extends CreateRecord
{
    protected static string $resource = HistoryLoanBookResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}

