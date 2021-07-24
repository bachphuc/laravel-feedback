<?php

namespace bachphuc\LaravelFeedback\Components;

use bachphuc\LaravelFeedback\Models\Review;

class RatingBar extends FeedbackBaseElement
{
    protected $viewPath = 'rating-bar';

    public function setItemAttribute($item){
        $review = Review::getReviewOf($item);
        $this->setAttribute('review', $review);
    }
}