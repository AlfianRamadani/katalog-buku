<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class TemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new BookExport(),
            new CategoryExport(),
        ];
    }
}

class BookExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Book::select(
            'title',
            'author',
            'category',
            'sub_category',
            'language',
            'cover',
            'publisher',
            'publication_year',
            'isbn_number',
            'description',
        )->get();
    }

    public function headings(): array
    {
        return [
            'title',
            'author',
            'category',
            'sub_category',
            'language',
            'cover',
            'publisher',
            'publication_year',
            'isbn_number',
            'description',
        ];
    }

    public function title(): string
    {
        return 'Buku';
    }
}

class CategoryExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Category::all();
    }

    public function headings(): array
    {
        return [
            'name',
            'is_active'
        ];
    }

    public function title(): string
    {
        return 'category';
    }
}
