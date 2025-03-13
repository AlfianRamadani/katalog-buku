<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;

use Filament\Forms;
use Illuminate\Support\Str;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Button;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationLabel = 'Buku';
    public static ?string $pluralModelLabel = 'Data Buku';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes()->orderBy('created_at', 'desc');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Buku')
                    ->description('Masukkan detail informasi tentang buku.')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('isbn_number')
                                    ->label('Nomor ISBN')
                                    ->placeholder('Masukkan ISBN (jika ada)')
                                    ->rule('regex:/^(97[89][\-\s]?)?\d{1,5}[\-\s]?\d{1,7}[\-\s]?\d{1,7}[\-\s]?[\dX]$/i')
                                    ->columnSpan(3),

                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Buku')
                                    ->placeholder('Masukkan judul buku')
                                    ->required()
                                    ->columnSpan(3)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                        if (($get('slug') ?? '') !== Str::slug($old)) {
                                            return;
                                        }
                                        $set('slug', Str::slug($state));
                                    }),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->readOnly()
                                    ->columnSpan(3),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('author')
                                    ->label('Penulis')
                                    ->placeholder('Nama penulis buku')
                                    ->required()
                                    ->columnSpan(2),

                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nama Kategori')
                                            ->required(),
                                    ])
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('publisher')
                                    ->label('Penerbit')
                                    ->placeholder('Masukkan nama penerbit')
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\Select::make('publication_year')
                                    ->label('Tahun Terbit')
                                    ->options(array_combine(range(date('Y'), 1900), range(date('Y'), 1900)))
                                    ->searchable()
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\Select::make('language')
                                    ->label('Bahasa')
                                    ->options([
                                        'Indonesia' => 'Bahasa Indonesia',
                                        'Inggris' => 'Bahasa Inggris',
                                        'Spanyol' => 'Bahasa Spanyol',
                                        'Prancis' => 'Bahasa Prancis',
                                        'Jerman' => 'Bahasa Jerman',
                                        'Mandarin' => 'Bahasa Mandarin',
                                        'Jepang' => 'Bahasa Jepang',
                                        'Korea' => 'Bahasa Korea',
                                        'Arab' => 'Bahasa Arab',
                                        'Portugis' => 'Bahasa Portugis',
                                        'Rusia' => 'Bahasa Rusia',
                                        'Italia' => 'Bahasa Italia',
                                        'Belanda' => 'Bahasa Belanda',
                                        'Swedia' => 'Bahasa Swedia',
                                        'Norwegia' => 'Bahasa Norwegia',
                                        'Denmark' => 'Bahasa Denmark',
                                        'Finlandia' => 'Bahasa Finlandia',
                                        'Polandia' => 'Bahasa Polandia',
                                        'Ceko' => 'Bahasa Ceko',
                                        'Hungaria' => 'Bahasa Hungaria',
                                        'Yunani' => 'Bahasa Yunani',
                                        'Turki' => 'Bahasa Turki',
                                        'Vietnam' => 'Bahasa Vietnam',
                                        'Thailand' => 'Bahasa Thailand',
                                        'Filipina' => 'Bahasa Filipina',
                                        'Malaysia' => 'Bahasa Malaysia',
                                    ])
                                    ->searchable()
                                    ->placeholder('Contoh: Indonesia, Inggris')
                                    ->required()
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('edition')
                                    ->label('Edisi')
                                    ->placeholder('Masukkan edisi buku')
                                    ->nullable()
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('city_publisher')
                                    ->label('Kota Penerbit')
                                    ->placeholder('Masukkan kota penerbit')
                                    ->nullable()
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('total_page')
                                    ->label('Jumlah Halaman')
                                    ->placeholder('Masukkan total halaman')
                                    ->numeric()
                                    ->nullable()
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('total_roman_page')
                                    ->label('Jumlah Halaman Romawi')
                                    ->placeholder('Masukkan jumlah halaman romawi')
                                    ->numeric()
                                    ->nullable()
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('book_length')
                                    ->label('Panjang Buku')
                                    ->placeholder('Masukkan panjang buku dalam cm')
                                    ->nullable()
                                    ->columnSpan(1),

                                Forms\Components\Select::make('dewey_decimal_id')
                                    ->label('Klasifikasi Desimal Dewey')
                                    ->relationship('deweyDecimal', 'category')
                                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->category} - {$record->code}")
                                    ->searchable()
                                    ->preload()
                                    ->nullable()
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\FileUpload::make('cover')
                            ->label('Cover Buku')
                            ->optimize('webp')
                            ->afterStateHydrated(function ($record, $set) {
                                if ($record) {
                                    $originalPicture = $record->getRawOriginal('cover');
                                    $set('cover', [$originalPicture]);
                                }
                            })
                            ->maxSize(2048)
                            ->helperText('Ukuran maksimal 2MB, dan hanya menerima gambar')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'])
                            ->columnSpanFull()
                            ->image()
                            ->resize(50),

                        Forms\Components\TextInput::make('stock')
                            ->label('Stok Buku')
                            ->placeholder('Masukkan jumlah stok buku')
                            ->type('number')
                            ->required()
                            ->columnSpan(2),

                        Forms\Components\Select::make('status')
                            ->label('Status Buku')
                            ->options([
                                'available' => 'Tersedia',
                                'not_available' => 'Tidak Tersedia',
                            ])
                            ->default('available')
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Masukkan deskripsi singkat tentang buku')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }




    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label("Judul Buku")
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->label("Penulis")
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Kategori'),
                TextColumn::make('stock')
                    ->label('Stok Buku'),
                Tables\Columns\TextColumn::make('publisher')
                    ->label("Penerbit")
                    ->searchable(),

                ImageColumn::make('cover')
                    ->label("Cover Buku"),
                Tables\Columns\TextColumn::make('isbn_number')
                    ->label("ISBN")
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Cetak Katalog')
                    ->label('Cetak Katalog')
                    ->url(fn($record) => route('print.catalog', ['id' => $record->id]), shouldOpenInNewTab: true),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function fetchBookData($data)
    {
        $isbn = $data->isbn_number;
        $response = Http::get("https://www.googleapis.com/books/v1/volumes?q={$isbn}&key=" . config('key.google_api_key'));

        if ($response->successful()) {
            // Lakukan sesuatu dengan data dari API, misalnya update form fields
            $bookData = $response->json();
            // $this->update([
            //     'title' => $bookData['title'],
            //     'author' => $bookData['author'],
            //     // Sesuaikan dengan data yang kamu butuhkan
            // ]);
            dd($bookData);
        } else {
            // Tangani error jika API tidak merespons dengan baik
            session()->flash('error', 'Gagal mengambil data buku.');
        }
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
