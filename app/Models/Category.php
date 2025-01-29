<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'is_active'];
    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
