<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;


class Dashboard extends BaseDashboard
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Dashboard';
    // protected static ?string $pluralModelLabel = 'Halaman Dashboard';
    protected static string $view = 'filament.pages.custom-dashboard';
    protected static ?string $title = 'Halaman Dashboard';
}
