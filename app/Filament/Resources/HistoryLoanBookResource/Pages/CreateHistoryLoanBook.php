<?php

namespace App\Filament\Resources\HistoryLoanBookResource\Pages;

use App\Filament\Resources\HistoryLoanBookResource;
use App\Models\HistoryLoanBook;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateHistoryLoanBook extends CreateRecord
{
    protected static string $resource = HistoryLoanBookResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
