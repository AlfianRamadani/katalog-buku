<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReview extends CreateRecord
{
    protected static string $resource = ReviewResource::class;
    public static ?string $title = 'Tambah Ulasan Buku';
    public static ?string $breadcrumb = 'Tambah Ulasan Buku';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
