<?php

namespace App\Imports;

use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

class BookImport implements ToModel, WithHeadingRow, WithMultipleSheets, SkipsEmptyRows, WithDrawings
{
    private array $drawings = [];
    private string $imageColumn = 'cover';
    private string $storageDirectory = 'books/covers';

    public function sheets(): array
    {
        return [
            'Buku' => $this
        ];
    }

    /**
     * @param array $row
     * @return Book|null
     */
    public function model(array $row)
    {
        $spreadsheet = IOFactory::load($row['cover']);
        $sheet = $spreadsheet->getActiveSheet();

        // **📌 Ambil semua gambar di Excel**
        $drawings = $sheet->getDrawingCollection();
        $images = [];

        foreach ($drawings as $drawing) {
            if ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\Drawing) {
                $imageExtension = pathinfo($drawing->getPath(), PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $imageExtension;
                $imageContents = file_get_contents($drawing->getPath());

                // **📌 Simpan gambar ke storage**
                Storage::disk('public')->put("uploads/$imageName", $imageContents);
                $images[$drawing->getCoordinates()] = "uploads/$imageName";
            }
        }


        $bookData = [
            'title' => $row['title'],
            'author' => $row['author'],
            'category' => $row['category'] ?? null,
            'sub_category' => $row['sub_category'] ?? null,
            'language' => $row['language'] ?? null,
            'publisher' => $row['publisher'] ?? null,
            'publication_year' => $row['publication_year'] ?? null,
            'isbn_number' => $row['isbn_number'] ?? null,
            'description' => $row['description'] ?? null,
        ];

        // Check if there's an image for this row
        if (isset($this->drawings[$row['cover']])) {
            $bookData['cover'] = $this->drawings[$row['cover']];
        }

        // Update existing record or create new one
        $existingBook = Book::where('isbn_number', $row['isbn_number'])
            ->orWhere('title', $row['title'])
            ->first();

        if ($existingBook) {
            $existingBook->update($bookData);
            return $existingBook;
        }

        return new Book($bookData);
    }
}
