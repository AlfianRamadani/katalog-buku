<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;


    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable =  [
        'title',
        'author',
        'category_id',
        'slug',
        'language',
        'cover',
        'publisher',
        'publication_year',
        'isbn_number',
        'status',
        'description',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    public function historyLoanBook()
    {
        return $this->hasMany(HistoryLoanBook::class);
    }
    public function getCoverAttribute($value)
    {
        return $value
            ? asset(Storage::url($value))
            : asset('img.jpeg');
    }
    public function deweyDecimal()
    {
        return $this->belongsTo(DeweyDecimal::class);
    }
}
