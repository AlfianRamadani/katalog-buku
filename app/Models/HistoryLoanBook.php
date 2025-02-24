<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryLoanBook extends Model
{
    protected $fillable = [
        'name',
        'member_id',
        'book_id',
        'information',
        'staff_id',
        'returned_at'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
