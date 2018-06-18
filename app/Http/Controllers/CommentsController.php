<?php

namespace App\Http\Controllers;

use Validator;
use App\Comment;
use App\Rules\AuthorCommentRule;
use App\Rules\AttachableCommentRule;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author' => [
                'required',
                new AuthorCommentRule()
            ],
            'comment' => 'required',
            'attachable_id' => 'required|integer',
            'attachable_type' => [
                'required',
                new AttachableCommentRule($request->attachable_id)
            ],
        ]);

        if ($validator->fails()) {
            return view('layout.components.errors')->withErrors($validator);
        }

    	$comment = new Comment($request->all());
        $author = trim($request->author);
        $comment->author = mb_convert_case($author, MB_CASE_TITLE, "UTF-8");
        $comment->save();

        return view('layout.components.comment', ['comment' => $comment]);
    }
}
