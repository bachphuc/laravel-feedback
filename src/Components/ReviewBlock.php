<?php

namespace bachphuc\LaravelFeedback\Components;
use bachphuc\LaravelFeedback\Models\Review;

class ReviewBlock extends FeedbackBaseElement
{
    protected $viewPath = 'review-block';

    public function setItemAttribute($item){
        $review = Review::getReviewOf($item);

        if(auth()->check()){
            $myReview = Review::getMyReview($item);
            if($myReview){
                $this->setAttribute('myReview', $myReview);
            }
        }
        $this->setAttribute('review', $review);
    }
}