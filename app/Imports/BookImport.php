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
     * Handle the image import process
     */
    private function handleImageImport($drawing): ?string
    {
        try {
            $imageContents = null;
            $extension = null;

            if ($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_clean();

                // Determine extension based on mime type
                $extension = match ($drawing->getMimeType()) {
                    MemoryDrawing::MIMETYPE_PNG => 'png',
                    MemoryDrawing::MIMETYPE_GIF => 'gif',
                    MemoryDrawing::MIMETYPE_JPEG => 'jpg',
                    default => null
                };
            } elseif ($drawing instanceof Drawing) {
                if (!$drawing->getPath()) {
                    return null;
                }

                if ($drawing->getIsURL()) {
                    $imageContents = file_get_contents($drawing->getPath());
                    $extension = pathinfo($drawing->getPath(), PATHINFO_EXTENSION);
                } else {
                    $imageContents = file_get_contents($drawing->getPath());
                    $extension = $drawing->getExtension();
                }
            }

            if (!$imageContents || !$extension) {
                return null;
            }

            // Generate a unique filename
            $filename = $this->storageDirectory . '/' . Str::uuid() . '.' . $extension;

            // Store the image
            Storage::disk('public')->put($filename, $imageContents);

            return $filename;
        } catch (\Exception $e) {
            // Log the error but don't halt the import
            Log::error('Failed to import image: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * @param array $row
     * @return Book|null
     */
    public function model(array $row)
    {
        // Validate required fields
        if (empty($row['title']) || empty($row['author'])) {
            return null;
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

    /**
     * @return \Closure
     */
    public function drawings()
    {
        return function ($worksheet) {
            foreach ($worksheet->getDrawingCollection() as $drawing) {
                // Get the cell coordinate where the image is placed
                $coordinate = $drawing->getCoordinates();

                // Process and store the image
                $imagePath = $this->handleImageImport($drawing);

                if ($imagePath) {
                    $this->drawings[$coordinate] = $imagePath;
                }
            }
        };
    }
}
