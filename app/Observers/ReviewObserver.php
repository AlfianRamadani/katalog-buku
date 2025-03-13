<?php

namespace App\Observers;

use App\Models\HistoryLoanBook;
use App\Models\Review;

class ReviewObserver
{
    public function created(Review $review)
    {
        HistoryLoanBook::where('id', $review->history_loan_book_id)
            ->update(['is_review' => 1]);
    }
}
