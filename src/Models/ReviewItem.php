<?php

namespace bachphuc\LaravelFeedback\Models;

class ReviewItem extends ModelBase
{
    protected $table = 'dsoft_review_items';
    protected $itemType = 'dsoft_review_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'review_id', 'user_id', 'item_type', 'item_id', 'title', 'content', 'rating', 'image',
    ];

    public function review(){
        return $this->belongsTo('\bachphuc\LaravelFeedback\Models\Review', 'review_id');
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }
}