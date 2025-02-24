<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestBook extends Model
{
    protected $table = 'request_book';
    protected $fillable = [
        'name',
        'ip',
        'user_agent'
    ];
}
