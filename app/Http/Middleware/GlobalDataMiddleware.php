<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use App\Models\Category;
use View;
use Illuminate\Http\Request;

class GlobalDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $posts = Post::latest()->take(5)->get();
        $categories = Category::all();
        View::share([
            'posts' => $posts,
            'categories' => $categories,
        ]);
        return $next($request);
    }
}
