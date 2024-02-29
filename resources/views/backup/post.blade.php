@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center mb-5" style="margin-top:15vh;">
        <div class="col-md-8 d-block">
            <a href="/posts" class="btn "><i class="bi bi-arrow-left"></i></a>
            <h1 class="mb-3">{{ $post->title }}</h1>
            <p>By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none" > {{ $post->author->name }} </a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
            @if($post->image)
            <div style="max-height: 350px; overflow:hidden;">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="...">
            </div>
            @else
            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="card-img-top mt-4" alt="...">
            @endif

            <article class="my-3 fs-5">
                {!!  $post->body  !!}
            </article>
            @if(!empty($post->address))
                <h5 class="ms-2">Info Lokasi :</h5>
                <iframe width="auto" height="200" style="margin:1vh;" src="https://maps.google.com/maps?q={{$post->address}}&output=embed"></iframe>
            @endif

            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Komentar (2)</h5>
                        @if (auth()->check())
                        <form action="/posts/{{ $post->slug }}/store" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="comment" class="form-label">Tulis Komentar</label>
                                <textarea name="body" class="form-control" id="comment" rows="3"></textarea>
                                
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            
                        </form>
                        @endif
                        @foreach ($post->comments as $comment)
                        <div class="container mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <img src="avatar.jpg" alt="User Avatar" class="img-fluid rounded-circle">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                            <small class="text-muted">2 menit lalu</small>
                                        </div>
                                    </div>
                                    <p class="mt-3">{{ $comment->body }}</p>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-link">Balas</button>
                                    </div>
                                    @foreach ($comment->replies as $reply)
                                    <div style="margin-left:15vh;">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <img src="avatar.jpg" alt="User Avatar" class="img-fluid rounded-circle">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $reply->user->name }}</h6>
                                            
                                        </div>
                                    </div>
                                    <p class="mt-3">{{ $reply->body }}</p>
                                    </div>
                                @endforeach
                                @if (auth()->check())
                                    <form action="/posts/{{ $post->slug }}/comments/{{ $comment->id }}/replies" method="POST" style="margin-left: 40px;">
                                        @csrf
                                        <textarea name="body" required></textarea>
                                        <button type="submit">Balas Komentar</button>
                                    </form>
                                @endif 
                                    <div class="d-flex justify-content-between">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{-- @foreach ($post->comments as $comment)
                        <ul class="list-group list-group-flush mt-4">
                            <li class="list-group-item">
                                <strong>{{ $comment->user->name }} - {{ $comment->body }}</strong>
                                <small><a href="">Reply</a></small>
                                @foreach ($comment->replies as $reply)
                                    <p style="margin-left: 40px;">{{ $reply->user->name }} - {{ $reply->body }}</p>
                                @endforeach

                                @if (auth()->check())
                                    <form action="/posts/{{ $post->slug }}/comments/{{ $comment->id }}/replies" method="POST" style="margin-left: 40px;">
                                        @csrf
                                        <textarea name="body" required></textarea>
                                        <button type="submit">Balas Komentar</button>
                                    </form>
                                @endif 
                            </li>
                        </ul>
                        @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            {{-- <h5 class="ms-2">Komentar :</h5>
            @foreach ($post->comments as $comment)
                <p>{{ $comment->user->name }} - {{ $comment->body }}</p>
                @foreach ($comment->replies as $reply)
                    <p style="margin-left: 40px;">{{ $reply->user->name }} - {{ $reply->body }}</p>
                @endforeach

                @if (auth()->check())
                    <form action="/posts/{{ $post->slug }}/comments/{{ $comment->id }}/replies" method="POST" style="margin-left: 40px;">
                        @csrf
                        <textarea name="body" required></textarea>
                        <button type="submit">Balas Komentar</button>
                    </form>
                @endif
            @endforeach
            @if(auth()->check())
            <form action="/posts/{{ $post->slug }}/store" method="POST">
                @csrf
                <textarea name="body" required></textarea>
                <button type="submit">Kirim Komentar</button>
            </form>
            @endif
        </div>
    </div>
</div> --}}







@endsection