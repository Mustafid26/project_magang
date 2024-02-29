@extends('layouts.main')

@section('container')
{{-- skip --}}
<div class="container mt-4" style="display: none;">
    @if($posts->count())
    <section class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mb-3">
                @if(request('search'))
                        <h1>Semua Postingan "{{ request('search') }}"</h1>
                    @else
                        <h1>Postingan Terkini</h1>
                    @endif
                    <div class="card">
                    @if($posts[0]->image)
                    <div class="d-flex mb-2">
                        <img class="img-fluid rounded-top" src="{{ asset('storage/' . $posts[0]->image) }}" alt="">
                    </div>
                    @else
                    <img src="https://source.unsplash.com/750x250?{{ $posts[0]->category->slug }}"  class="img-fluid rounded-top mb-2" alt="...">
                    @endif
                    <span><small class="text-muted ms-2">{{ $posts[0]->created_at->diffForHumans() }}</small></span>
                    <h2 class="fw-bold ms-2 me-2"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-black">{{ $posts[0]->title }}</a></h2>
                    <p class="lead text-muted ms-2 me-2">{{ $posts[0]->excerpt }}</p>
                    @if(!empty($posts[0]->address))
                        <h5 class="ms-2">Info Lokasi :</h5>
                        <iframe width="auto" height="200" style="margin:1vh;" src="https://maps.google.com/maps?q={{$posts[0]->address}}&output=embed"></iframe>
                    @endif
                    <div class="card-footer d-flex align-items-center bg-light justify-content-between">
                        <div class="d-flex">
                            <form class="like-form" data-post="{{ $posts[0]->id }}" action="{{ route('likes.toggle', $posts[0]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn">
                                    <span class="count">{{ $posts[0]->likes()->count() }}</span>
                                    <i class="{{ auth()->check() && $posts[0]->isLikedBy(auth()->user()) ? 'fa-solid fa-thumbs-up' : 'fa-regular fa-thumbs-up' }}"></i>
                                </button>
                            </form>                   
                        </div>
                    </div>
                </div>
            </div>
            @if($randomPost)
            <div class="col-12 col-lg-4 mb-5">
                <h1>UMKM</h1>
                <div class="card ">
                @if($randomPost->image)
                <div class="d-flex mb-4">
                    <img class="img-fluid rounded-top" src="{{ asset('storage/' . $randomPost->image) }}" alt="">
                </div>
                @else
                <img src="https://source.unsplash.com/750x400?{{ $randomPost->category->slug }}"  class="img-fluid rounded-top" alt="...">
                @endif
                <span><small class="text-muted ms-2 me-2">{{ $randomPost->created_at->diffForHumans() }}</small></span>
                <h2 class="fw-bold ms-2 me-2">{{ $randomPost->title }}</h2>
                <p class="lead text-muted ms-2 me-2">{{ $randomPost->excerpt }}</p>
                @if(!empty($randomPost->address))
                    <h5 class="ms-2">Info Lokasi :</h5>
                    <iframe width="auto" height="200" style="margin:1vh;" src="https://maps.google.com/maps?q={{$randomPost->address}}&output=embed"></iframe>
                @endif
                  <div class="d-flex justify-content-end align-items-center me-2">
                    <a href="/posts/{{ $randomPost->slug }}" class="btn btn-outline-dark mb-4 ">Selengkapnya <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
                </div>
            @endif
            @if(request('search'))
                @if(count($searchResults) > 1)
                    <h1>Postingan Lainnya Terkait "{{ request('search') }}"</h1>
                @endif
            @else
                <h1>Postingan Lainnya</h1>
            @endif
            @foreach($posts->skip(1) as $post)
            <div class="col-12 col-lg-4 mb-5">
                <div class="card my-2 h-100" >
                    <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0,0,0,0.7)">
                        <a href="/posts?category=   {{ $post->category->slug }}" class="text-decoration-none text-white">
                            {{ $post->category->name }}
                        </a>
                    </div>
                    @if($post->image)  
                    <div class="d-flex mb-4">
                        <img class="img-fluid rounded-top" src="{{ asset('storage/' . $post->image) }}" alt="">
                    </div>
                    @else
                    <img src="https://source.unsplash.com/800x500?{{ $post->category->slug }}"  class="img-fluid rounded-top" alt="...">
                    @endif
                    <div class="card-body">
                        <span><small class="text-muted ms-2 me-2">{{ $post->created_at->diffForHumans() }}</small></span>
                        <h2 class="card-title fw-bold ms-2 me-2">{{ $post->title }}</h2>
                        <p class="card-text lead text-muted ms-2 me-2">{{ $post->excerpt }}</p>
                    </div>
                    @if(!empty($post->address))
                        <h5 class="ms-2">Info Lokasi :</h5>
                        <iframe width="auto" height="200" style="margin:1vh;" src="https://maps.google.com/maps?q={{$post->address}}&output=embed"></iframe>
                    @endif
                    <div class="card-footer d-flex align-items-center bg-light justify-content-between">
                        <div class="d-flex">
                            <form id="like-form" action="{{ route('likes.toggle', $post) }}" method="post">
                                @csrf
                                <button id="like-btn" class="btn" data-post="{{ $post->id }}">
                                    {{ $post->likes()->count() }} 
                                    <i class="{{ auth()->check() && $post->isLikedBy(auth()->user()) ? 'fa-regular fa-thumbs-up' : 'fa-regular fa-thumbs-down' }}"></i>
                                </button>
                            </form>                            
                        </div>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-outline-dark">Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>                    
                </div>
            </div>
            @endforeach
          </div>
        </div>
    </section>
    @else
    <p class="text-center fs-4">Postingan Tidak Ada</p>
    @endif
    <div class="container d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
</div>
{{-- skip --}}
<div class="container mt-4">
    @if($posts->count())
    <section class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mb-3">
                @if(request('search'))
                        <h1>Semua Postingan "{{ request('search') }}"</h1>
                    @else
                        <h1>Postingan Terkini</h1>
                    @endif
                    <div class="card">
                    @if($posts[0]->image)
                    <div class="d-flex mb-2">
                        <img class="img-fluid rounded-top" src="{{ asset('storage/' . $posts[0]->image) }}" alt="">
                    </div>
                    @else
                    <img src="https://source.unsplash.com/750x250?{{ $posts[0]->category->slug }}"  class="img-fluid rounded-top mb-2" alt="...">
                    @endif
                    <span><small class="text-muted ms-2">{{ $posts[0]->created_at->diffForHumans() }}</small></span>
                    <h2 class="fw-bold ms-2 me-2"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-black">{{ $posts[0]->title }}</a></h2>
                    <p class="lead text-muted ms-2 me-2">{{ $posts[0]->excerpt }}</p>
                    @if(!empty($posts[0]->address))
                        <h5 class="ms-2">Info Lokasi :</h5>
                        <iframe width="auto" height="200" style="margin:1vh;" src="https://maps.google.com/maps?q={{$posts[0]->address}}&output=embed"></iframe>
                    @endif
                    <div class="card-footer d-flex bg-light justify-content-between">
                        <div class="d-flex align-items-center">
                            <form class="like-form" data-post="{{ $posts[0]->id }}" action="{{ route('likes.toggle', $posts[0]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn">
                                    <span class="count">{{ $posts[0]->likes()->count() }}</span>
                                    <i class="{{ auth()->check() && $posts[0]->isLikedBy(auth()->user()) ? 'fa-solid fa-thumbs-up' : 'fa-regular fa-thumbs-up' }}"></i>
                                </button>
                            </form>
                            <span class=""><i class="fa-regular fa-comment"></i>
                                {{ $count1[$posts[0]->id] + array_sum($count2[$posts[0]->id]) }}
                            </span>             
                        </div>
                        <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-outline-dark ">Selengkapnya <i class="bi bi-arrow-right"></i></a>                    
                    </div>
                </div>
            </div>
            @if($randomPost)
            <div class="col-12 col-lg-4 mb-5">
                <h1>UMKM</h1>
                <div class="card ">
                @if($randomPost->image)
                <div class="d-flex mb-4">
                    <img class="img-fluid rounded-top" src="{{ asset('storage/' . $randomPost->image) }}" alt="">
                </div>
                @else
                <img src="https://source.unsplash.com/750x400?{{ $randomPost->category->slug }}"  class="img-fluid rounded-top" alt="...">
                @endif
                <span><small class="text-muted ms-2 me-2">{{ $randomPost->created_at->diffForHumans() }}</small></span>
                <h2 class="fw-bold ms-2 me-2">{{ $randomPost->title }}</h2>
                <p class="lead text-muted ms-2 me-2">{{ $randomPost->excerpt }}</p>
                @if(!empty($randomPost->address))
                    <h5 class="ms-2">Info Lokasi :</h5>
                    <iframe width="auto" height="200" style="margin:1vh;" src="https://maps.google.com/maps?q={{$randomPost->address}}&output=embed"></iframe>
                @endif
                  <div class="d-flex justify-content-end align-items-center me-2">
                    <a href="/posts/{{ $randomPost->slug }}" class="btn btn-outline-dark mb-4 ">Selengkapnya <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
                </div>
            @endif
            @if(request('search'))
                @if(count($searchResults) > 1)
                    <h1>Postingan Lainnya Terkait "{{ request('search') }}"</h1>
                @endif
            @else
                <h1>Postingan Lainnya</h1>
            @endif
            @foreach($posts->skip(1) as $post)
            <div class="col-12 col-lg-4 mb-5" data-post="{{ $post->id }}">
                <div class="card my-2 h-100" >
                    <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0,0,0,0.7)">
                        <a href="/posts?category=   {{ $post->category->slug }}" class="text-decoration-none text-white">
                            {{ $post->category->name }}
                        </a>
                    </div>
                    @if($post->image)  
                    <div class="d-flex mb-4">
                        <img class="img-fluid rounded-top" src="{{ asset('storage/' . $post->image) }}" alt="">
                    </div>
                    @else
                    <img src="https://source.unsplash.com/800x500?{{ $post->category->slug }}"  class="img-fluid rounded-top" alt="...">
                    @endif
                    <div class="card-body">
                        <span><small class="text-muted ms-2 me-2">{{ $post->created_at->diffForHumans() }}</small></span>
                        <h2 class="card-title fw-bold ms-2 me-2">{{ $post->title }}</h2>
                        <p class="card-text lead text-muted ms-2 me-2">{{ $post->excerpt }}</p>
                    </div>
                    @if(!empty($post->address))
                        <h5 class="ms-2">Info Lokasi :</h5>
                        <iframe width="auto" height="200" style="margin:1vh;" src="https://maps.google.com/maps?q={{$post->address}}&output=embed"></iframe>
                    @endif
                    <div class="card-footer d-flex align-items-center bg-light justify-content-between">
                        <div class="d-flex align-items-center">
                            <form class="like-form" data-post="{{ $post->id }}" action="{{ route('likes.toggle', $post) }}" method="post">
                                @csrf
                                <button type="submit" class="btn">
                                    <span class="count">{{ $post->likes()->count() }}</span>
                                    <i class="{{ auth()->check() && $post->isLikedBy(auth()->user()) ? 'fa-solid fa-thumbs-up' : 'fa-regular fa-thumbs-up' }}"></i>
                                </button>
                            </form>
                            <span class=""><i class="fa-regular fa-comment"></i>
                                {{ $count1[$post->id] + array_sum($count2[$post->id]) }}
                            </span>                                                    
                        </div>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-outline-dark">Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>                    
                </div>
            </div>
            @endforeach
          </div>
        </div>
    </section>
    @else
    <p class="text-center fs-4">Postingan Tidak Ada</p>
    @endif
    <div class="container d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
</div>
{{-- <script>
    $('#like-btn').on('click', function(e) {
    e.preventDefault();

    var post_id = $(this).data('post');
    var likeBtn = $(this);

    $.ajax({
        url: '/posts/' + post_id + '/likes',
        method: 'POST',
        data: {
            _token: $('input[name=_token]').val()
        },
    });
});
</script> --}}
@endsection
