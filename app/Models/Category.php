<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name' ];
    public function subCategory (){
        return $this->hasMany(subCategory::class);
    }
}
