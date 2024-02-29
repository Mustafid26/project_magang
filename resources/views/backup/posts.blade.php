@extends('layouts.main')

@section('container')
<div class="container mt-4">
    <h1 class="text-center">{{ $title }}</h1>
    @if($posts->count())
    <div class="card mb-3">
        @if($posts[0]->image)
        <div style="max-height: 350px; overflow:hidden;">
            <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top" alt="...">
        </div>
        @else
        <img src="https://source.unsplash.com/500x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="...">
        @endif
        <div class="card-body text-center">
          <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-black">{{ $posts[0]->title }}</a></h3>
          <p>
            <small class="text-body-secondary">
                <div class="container d-flex justify-content-center">
                    Dibuat Oleh <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> 
                </div>
                    Kategori <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a>
            </small>
        </p>

          <p class="card-text">{{ $posts[0]->excerpt }}</p>
          <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-primary text-decoration-none mb-2">Read More</a>
          <p class="card-text"><small class="text-body-secondary">{{ $posts[0]->created_at->diffForHumans() }}</small></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0,0,0,0.7)">
                        <a href="/posts?category=   {{ $post->category->slug }}" class="text-decoration-none text-white">
                            {{ $post->category->name }}
                        </a>
                    </div>
                    @if($post->image)     
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="...">
                    @else
                    <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2"><a href="/posts/{{ $post->slug }}" class="text-decoration-none text-black">{{ $post->title }}</a></h5>
                        <p class="mb-2">
                        Dibuat Oleh <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> 
                        </p>
                        <p class="mb-4">
                            {{  $post->excerpt  }}
                        </p>
                        <a href="/posts/{{ $post->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
    <p class="text-center fs-4">Postingan Tidak Ada</p>
    @endif

    <div class="container d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
    <section class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mb-5">
              <div class="d-flex mb-4">
                <img class="img-fluid" src="bootstrap5-plain-assets/images/blue-400-horizontal.png" alt="">
              </div>
              <span><small class="text-muted">10 jun 2021 19:40</small></span>
              <h2 class="fw-bold">Lorem ipsum dolor sit amet consectutar domor at elis</h2>
              <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
              <a class="d-flex align-items-center" href="#">
                <span>Read More</span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </span>
              </a>
            </div>
            <div class="col-12 col-lg-4 mb-5">
              <div class="d-flex mb-4">
                <img class="img-fluid" src="bootstrap5-plain-assets/images/blue-400-horizontal.png" alt="">
              </div>
              <span><small class="text-muted">10 jun 2021 19:40</small></span>
              <h2 class="fw-bold">Lorem ipsum dolor</h2>
              <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <a class="d-flex align-items-center" href="#">
                <span>Read More</span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </span>
              </a>
            </div>
            <div class="col-12 col-lg-4 mb-5">
              <div class="d-flex mb-4">
                <img class="img-fluid" src="bootstrap5-plain-assets/images/blue-400-horizontal.png" alt="">
              </div>
              <span><small class="text-muted">10 jun 2021 19:40</small></span>
              <h2 class="fw-bold">Lorem ipsum dolor</h2>
              <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <a class="d-flex align-items-center" href="#">
                <span>Read More</span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </span>
              </a>
            </div>
            <div class="col-12 col-lg-4 mb-5">
              <div class="d-flex mb-4">
                <img class="img-fluid" src="bootstrap5-plain-assets/images/blue-400-horizontal.png" alt="">
              </div>
              <span><small class="text-muted">10 jun 2021 19:40</small></span>
              <h2 class="fw-bold">Lorem ipsum dolor</h2>
              <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <a class="d-flex align-items-center" href="#">
                <span>Read More</span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </span>
              </a>
            </div>
            <div class="col-12 col-lg-4 mb-5">
              <div class="d-flex mb-4">
                <img class="img-fluid" src="bootstrap5-plain-assets/images/blue-400-horizontal.png" alt="">
              </div>
              <span><small class="text-muted">10 jun 2021 19:40</small></span>
              <h2 class="fw-bold">Lorem ipsum dolor</h2>
              <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <a class="d-flex align-items-center" href="#">
                <span>Read More</span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </span>
              </a>
            </div>
          </div>
        </div>
      </section>
</div>
@endsection