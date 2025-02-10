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
                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\TextInput::make('isbn_number')
                                    ->label('Nomor ISBN')
                                    ->placeholder('Masukkan ISBN (jika ada)')
                                    ->rule('regex:/^(97[89][\-\s]?)?\d{1,5}[\-\s]?\d{1,7}[\-\s]?\d{1,7}[\-\s]?[\dX]$/i')
                                    ->columnSpan(4),

                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Buku')
                                    ->placeholder('Masukkan judul buku')
                                    ->required()
                                    ->columnSpan(2)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                        if (($get('slug') ?? '') !== Str::slug($old)) {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    }),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->columnSpan(2),
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
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('language')
                                    ->label('Bahasa')
                                    ->placeholder('Contoh: Indonesia, Inggris')
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('publisher')
                                    ->label('Penerbit')
                                    ->placeholder('Masukkan nama penerbit')
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\DatePicker::make('publication_year')
                                    ->label('Tahun Terbit')
                                    ->placeholder('Pilih tahun terbit')
                                    ->format('Y')
                                    ->required()
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\FileUpload::make('cover')
                            ->label('Cover Buku')
                            ->maxSize(2048)
                            ->helperText('Ukuran maksimal 2MB, dan hanya menerima gambar')
                            ->acceptedFileTypes(['image/*'])
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('publisher')
                    ->label("Penerbit")
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_year')
                    ->label("Tahun Terbit")
                    ->date()
                    ->sortable(),
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
                    ->action(function ($record) {
                        BookResource::printCatalog($record);
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function printCatalog($data)
    {
        // Tentukan data yang ingin dicetak
        $title = $data->title;
        $author = $data->author;
        $publisher = $data->publisher;
        $publicationYear = $data->publication_year;
        $isbnNumber = $data->isbn_number;

        // Buat tampilan HTML untuk dicetak
        $html = "
            <html>
                <head>
                    <title>Katalog Buku</title>
                </head>
                <body>
                    <h1>Katalog Buku</h1>
                    <p><strong>Judul:</strong> {$title}</p>
                    <p><strong>Penulis:</strong> {$author}</p>
                    <p><strong>Penerbit:</strong> {$publisher}</p>
                    <p><strong>Tahun Terbit:</strong> {$publicationYear}</p>
                    <p><strong>ISBN:</strong> {$isbnNumber}</p>
                </body>
            </html>
        ";

        // Cetak tampilan HTML
        echo $html;
        echo "<script>window.print();</script>";
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
