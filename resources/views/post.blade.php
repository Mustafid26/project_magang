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
            <img src="https://source.unsplash.com/1200x400?{{ $post->category->slug }}" class="card-img-top mt-4" alt="...">
            @endif

            <article class="my-3 fs-5">
                {     $post->body  !!}
            </article>
            @if(!empty($post->address))
                <h5 class="ms-2">Info Lokasi :</h5>
                <iframe width="auto" height="200" style="margin:1vh;" src="https://maps.google.com/maps?q={{$post->address}}&output=embed"></iframe>
            @endif
            @include('comment')
        </div>
    </div>
</div>
@endsection
