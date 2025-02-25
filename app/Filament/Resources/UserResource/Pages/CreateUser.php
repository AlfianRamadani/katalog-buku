<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    public static ?string $title = 'Tambah Akun';
    public static ?string $breadcrumb = 'Tambah Akun';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
