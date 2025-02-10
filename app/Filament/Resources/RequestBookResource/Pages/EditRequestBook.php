<?php

namespace App\Filament\Resources\RequestBookResource\Pages;

use App\Filament\Resources\RequestBookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestBook extends EditRecord
{
    protected static string $resource = RequestBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
