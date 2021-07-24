<?php

namespace bachphuc\LaravelFeedback\Models;

use bachphuc\LaravelFeedback\Models\ReviewItem;

class Review extends ModelBase
{
    protected $table = 'dsoft_reviews';
    protected $itemType = 'dsoft_review';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_type', 'item_id', 'total_rating', 'average_rating',
    ];

    public function items(){
        return $this->hasMany('\bachphuc\LaravelFeedback\Models\ReviewItem');
    }

    public static function getReviewOf($item){
        $review = Review::where('item_type', $item->getType())
        ->where('item_id', $item->getId())
        ->first();

        return $review;
    }

    public static function addReview($item, $params = [], $user = null){
        if(!$user){
            $user = auth()->user();
        }

        $review = self::getReviewOf($item);
        if(!$review){
            // create review for this item
            $review = Review::create([
                'item_type' => $item->getType(),
                'item_id' => $item->getId(),
                'total_ration' => 0,
                'average_rating' => 0,
            ]);
        }

        // each user allow rating only once
        $reviewItem = ReviewItem::where('review_id', $review->id)
        ->where('item_type', $item->getType())
        ->where('item_id', $item->getId())
        ->where('user_id', $user->id)
        ->first();

        if($reviewItem){
            // update content
            $reviewItem->update([
                'title' => isset($params['title']) ? $params['title'] : '', 
                'content' => isset($params['content']) ? $params['content'] : '', 
                'rating' => $params['rating'],
            ]);
        }
        else{
            $insert = [
                'review_id' => $review->id, 
                'user_id' => $user->id, 
                'item_type' => $item->getType(), 
                'item_id' => $item->getId(), 
                'title' => isset($params['title']) ? $params['title'] : '', 
                'content' => isset($params['content']) ? $params['content'] : '', 
                'rating' => $params['rating'],
            ];
    
            $reviewItem = ReviewItem::create($insert);
        }

        $review->updateStats();
        return $reviewItem;
    }

    public function updateStats(){
        $this->total_rating = ReviewItem::where('review_id', $this->id)
        ->count();
        
        if($this->total_rating == 0){
            $this->average_rating = 0;
        }
        else{
            $sum = ReviewItem::where('review_id', $this->id)
            ->sum('rating');
    
            $this->average_rating = round($sum / $this->total_rating, 2);
        }

        $this->save();
    }

    public static function getMyReview($item, $user = null){
        if(!$user){
            $user = auth()->user();
        }
        $reviewItem = ReviewItem::where('item_type', $item->getType())
        ->where('item_id', $item->getId())
        ->where('user_id', $user->id)
        ->first();

        return $reviewItem;
    }
}