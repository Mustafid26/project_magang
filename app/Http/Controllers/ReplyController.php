<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Post $post, Comment $comment)
    {
        $this->validate($request, [
            'body' => 'required',
            'parent_id' => 'nullable|integer'
        ]);

        $reply = new Reply($request->all());
        $reply->user_id = auth()->id();
        $reply->post_id = $post->id;

        $comment->replies()->save($reply);

        return back();
    }

    public function destroy(Reply $reply, $slug)
    {
        Reply::destroy($reply->id);
        return redirect('/posts/' . $slug)->with('success', 'Berhasil Menghapus!');
    }
}
