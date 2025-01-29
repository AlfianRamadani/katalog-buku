<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable =  [
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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
