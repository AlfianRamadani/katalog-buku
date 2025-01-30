<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use function Illuminate\Support\Facades\asset;

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
    public function getCoverUrlAttribute()
    {
        dd($this->cover);
        return $this->cover
            ? Storage::url($this->cover)
            : asset('img.jpeg');
    }
}
