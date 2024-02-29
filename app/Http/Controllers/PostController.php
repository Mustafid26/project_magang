<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Reply;

class PostController extends Controller

{
    public function index(){
        $randomPost = Post::whereHas('category', function ($query) {
            $query->where('slug', 'market');
        })->inRandomOrder()->first();
        
        $title = '';
        
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' Kategori ' . $category->name;
        }
        
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = '  Dibuat Oleh ' . $author->name;
        }
    
        $searchQuery = request('search');
        $searchResults = Post::search([
            'search' => $searchQuery,
            'category' => request('category'),
            'author' => request('author'),
        ])->get();
    
        $posts = Post::latest()
            ->search(request(['search', 'category', 'author']))
            ->paginate(10)
            ->withQueryString();
            
        $commentCounts = [];
        $replyCounts = [];
    
        foreach ($posts as $post) {
            $commentCounts[$post->id] = $post->comments->count();
            $replyCounts[$post->id] = [];
    
            foreach ($post->comments as $comment) {
                $replyCounts[$post->id][$comment->id] = $comment->replies->count();
            }
        }
        return view('posts',[
            'title' => 'Semua Post ' . $title,
            'active' => "post",
            'posts' => $posts,
            'randomPost' => $randomPost,
            'searchResults' => $searchResults,
            'count1' => $commentCounts,
            'count2' => $replyCounts
        ]);
    }
    
    public function authors(User $user)
    {
        return view('posts',[
            'title' => 'User Posts',
            'active' => "post",
            'posts' => $user->posts,
        ]);
    }

    public function show(Post $post){
        $commentCount = $post->comments->count();
        $replyCount = $post->replies->count();
        $replyCounts = [];
        foreach ($post->comments as $comment) {
            $replyCounts[$comment->id] = $comment->replies->count();
        }
        $slug = $post->slug;
        return view('post',[
            'title' => "Blog",
            'active' => "post",
            'post' => $post,
            'count1' => $commentCount,
            'count2' => $replyCount,
            'count3' => $replyCounts,
            'slug' => $slug,
        ]);
    }
}
