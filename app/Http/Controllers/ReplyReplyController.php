<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyReplyController extends Controller
{
    public function store(Post $post, Comment $comment, Reply $reply, Request $request)
    {
        $reply = new Reply;
        $reply->body = $request->input('body');
        $reply->parent_id = $request->input('parent_id');
        $reply->comment_id = $request->input('comment_id');
        $reply->user_id = auth()->id(); // Pastikan baris ini ada
        $reply->post_id = $request->input('post_id'); // Pastikan baris ini ada
        $reply->save();

    return back();
    }
}
