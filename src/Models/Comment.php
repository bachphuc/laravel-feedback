<?php

namespace bachphuc\LaravelFeedback\Models;

class Comment extends ModelBase
{
    protected $table = 'dsoft_comments';
    protected $itemType = 'dsoft_comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'item_type', 'item_id', 'content', 'image',
    ];

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public static function getCommentsOf($item, $params = []){
        $length = isset($params['length']) ? (int) $params['length'] : 10;
        return Comment::where('item_type', $item->getType())
        ->where('item_id', $item->getId())
        ->orderBy('id', 'DESC')
        ->take($length)
        ->get();
    }

    public static function addComment($item, $params = [], $user = null){
        $insert = [
            'user_id' => user_id(),
            'item_type' => $item->getType(),
            'item_id' => $item->id,
            'content' => $params['content']
        ];

        return Comment::create($insert);
    }
}