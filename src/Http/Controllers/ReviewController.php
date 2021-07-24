<?php

namespace bachphuc\LaravelFeedback\Http\Controllers;

use Illuminate\Http\Request;
use bachphuc\LaravelFeedback\Models\Review;

class ReviewController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'item_type' => 'required',
            'item_id' => 'required',
        ]);

        $params = $request->all();
        $item = model_item($params['item_type'], $params['item_id']);
        if(!$item) {
            abort(404);
        }

        $comments = Review::getCommentsOf($item, $params);

        if($request->ajax()){
            return view('feedback::comments.comment-list', ['comments' => $comments]);
        }
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'item_type' => 'required',
            'item_id' => 'required',
            'rating' => 'required'
        ]);

        $item = model_item($data['item_type'], $data['item_id']);
        if(!$item){
            abort(404);
        }
        $review = Review::addReview($item, $data);
        $review->uploadPhoto();

        if(is_request_json()){
            return [
                'status' => true,
                'comment' => $review,
                'message' => 'Submit review successfully'
            ];
        }
        
        if($request->ajax()){
            return view('feedback::reviews.entry', ['review' => $review]);
        }

        return redirect()->to($item->getHref());        
    }
}