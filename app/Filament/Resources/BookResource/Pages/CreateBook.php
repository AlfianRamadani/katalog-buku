<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;

    public static ?string $title = 'Tambah Data Buku';
    public static ?string $breadcrumb = 'Tambah Data Buku';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
