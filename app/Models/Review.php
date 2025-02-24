<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'history_loan_book_id',
        'descriptions',
        'rate',
        'book_id'
    ];
    public function HistoryLoanBook()
    {
        return $this->belongsTo(HistoryLoanBook::class);
    }
}
