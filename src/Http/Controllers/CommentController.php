<?php

namespace bachphuc\LaravelFeedback\Http\Controllers;

use Illuminate\Http\Request;
use bachphuc\LaravelFeedback\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'item_type' => 'required',
            'item_id' => 'required'
        ]);

        $params = $request->all();
        $item = model_item($params['item_type'], $params['item_id']);
        if(!$item) {
            abort(404);
        }

        $comments = Comment::getCommentsOf($item, $params);

        if($request->ajax()){
            return view('feedback::comments.comment-list', ['comments' => $comments]);
        }
    }

    public function store(Request $request){
        $data = $request->validate([
            'content' => 'required',
            'item_type' => 'required',
            'item_id' => 'required'
        ]);

        $item = model_item($data['item_type'], $data['item_id']);
        if(!$item){
            abort(404);
        }
        $comment = Comment::addComment($item, $data);
        $comment->uploadPhoto();

        if(is_request_json()){
            return [
                'status' => true,
                'comment' => $comment,
                'message' => 'Added comment successfully'
            ];
        }
        
        if($request->ajax()){
            return view('feedback::comments.entry', ['comment' => $comment]);
        }

        return redirect()->to($item->getHref());        
    }
}