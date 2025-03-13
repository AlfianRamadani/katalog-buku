<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use App\Models\Review;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateReview extends CreateRecord
{
    protected static string $model = Review::class;
    protected static string $resource = ReviewResource::class;
    public static ?string $title = 'Tambah Ulasan Buku';
    public static ?string $breadcrumb = 'Tambah Ulasan Buku';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
