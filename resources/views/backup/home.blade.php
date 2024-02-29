@extends('layouts.main')
 
@section('carousel')
<div class="carousel-container">
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="semarang animated animatedFadeInUp fadeInUp text-center">
      <img class="img-fluid" src="image/image 1.png" alt="" srcset="" width="50%">
      <img class="img-fluid" src="image/logo.png" alt="" srcset="" width="50%">
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image/Lawang_Sewu_in_Semarang_City.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="image/Lawang_Sewu_in_Semarang_City.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="image/Lawang_Sewu_in_Semarang_City.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
@endsection

@section('container')
{{-- <div class="container" style="margin-top: 40%;">
  <h1>News</h1>
    <div class="owl-carousel owl-theme">
      @foreach($posts as $post)
        <div class="card">
            @if($post->image)
                <div style="position: relative; overflow:hidden;">
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="...">
                </div>
            @else
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="...">
            @endif
            <div class="card-body d-flex flex-column">
                <h3 class="card-title"><a href="/posts/{{ $post->slug }}" class="text-decoration-none text-black">{{ $post->title }}</a></h3>
                <p>
                    <small class="text-body-secondary">
                        Dibuat Oleh <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>
                    </small>
                    <br>
                    Kategori <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a>
                </p>
                <p class="card-text">{{ $post->excerpt }}</p>
                <a href="/posts/{{ $post->slug }}" class="btn btn-primary text-decoration-none mb-2">Read More</a>
                <p class="card-text"><small class="text-body-secondary">{{ $post->created_at->diffForHumans() }}</small></p>
            </div>
        </div>
      @endforeach
    </div>
</div> --}}
<section id="slider" class="pt-5">
  <div class="container">
    <h1 class="text-center"><b>Info Terkini</b></h1>
	  <div class="slider">
      <div class="owl-carousel">
          @foreach($posts as $post)
					<div class="slider-card">
            <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0,0,0,0.7)">
              <a href="/posts?category=   {{ $post->category->slug }}" class="text-decoration-none text-white">
                  {{ $post->category->name }}
              </a>
            </div>
            @if($post->image)
						<div class="d-flex justify-content-center align-items-center mb-3">
							<img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="...">
						</div>
            @else
            <div class="d-flex justify-content-center align-items-center mb-3">
              <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="...">
            </div>
            @endif
            <div class="d-flex justify-content-center align-items-center p-2 me-2">
              <h5 class="mb-0 text-center"><b>    
               <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-black">{{ $post->title }}</a>
              </b></h5>
            </div>
            <div class="text-center">
              <small class="text-body-secondary">{{ $post->created_at->diffForHumans() }}</small>
            </div>
						<p class="text-center"> 
              <small class="text-body-secondary">
                <b>Dibuat Oleh <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>
                <br>
                Kategori <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a>
                </b>  
              </small>
            </p>
            <p class="text-center text-black p-2 me-2">{{ $post->excerpt }}</p>
            <div class="d-flex flex-column p-2">
              <a href="/posts/{{ $post->slug }}" class="btn btn-primary text-decoration-none mb-2">Read More</a>
            </div>
					</div>
          @endforeach
				</div>
			</div>
  </div>
</section>
{{-- next content --}}
</div>
@endsection
 