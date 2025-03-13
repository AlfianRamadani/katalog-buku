<?php

namespace App\Filament\Resources\HistoryLoanBookResource\Pages;

use App\Filament\Resources\HistoryLoanBookResource;
use App\Models\HistoryLoanBook;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateHistoryLoanBook extends CreateRecord
{
    protected static string $resource = HistoryLoanBookResource::class;

    public static ?string $title = 'Tambah Data Peminjaman Buku';
    public static ?string $breadcrumb = 'Tambah Data Peminjaman Buku';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function handleRecordCreation(array $data): Model
    {
        $data['staff_id'] = Auth::id();
        return static::getModel()::create($data);
    }
}
