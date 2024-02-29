<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/owlcarousel/owl.theme.default.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Patua One' rel='stylesheet'>
    <title>SemarangInsight | {{ $title }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg d-flex fixed-top">
        <div class="container-fluid mb-lg-0">
            <a class="logo d-flex align-items-center" href="/">
              <img src="/image/logo.png" alt="" class="logo">
            </a>
            <form action="/posts" method="get" class="form">
              @if (request ('category'))
              <input type="hidden" name="category" value="{{ request('category') }}">
              @endif
              @if (request ('author'))
              <input type="hidden" name="category" value="{{ request('author') }}">
              @endif
              <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
            </form>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link {{ ($active === 'post') ? 'active' : ' ' }}"  href="/posts">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($active === 'kategori') ? 'active' : ' ' }}"  href="/about">Tentang</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Kategori</a>
                <ul class="dropdown-menu">
                @foreach($categories as $category)
                <li><a class="dropdown-item" href="/posts?category={{ $category->slug }}">{{ $category->name }}</a></li>
                @endforeach
                </ul>
              </li>
            </ul>
            <ul class="navbar-nav log me-auto ms-auto"> 
            @auth
            <li class="nav-item">
              <a href="/dashboard/posts/create" class="nav-link">
                <i class="bi bi-plus-square"></i>

              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle"  style="color:black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
              </a>
              <ul class="dropdown-menu drop-log text-center">
                <li><a class="dropdown-item disabled" href="#">{{ auth()->user()->name }}</a></li>
                <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window"></i> DashboardKu</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                  </form>
                </li>
              </ul>
            </li>
            @else
            <li class="nav-item">
              <a
                class="nav-link"
                href="/login"
              >
                <i class="fa-solid fa-right-to-bracket {{ ($active === 'login') ? 'active' : ' ' }}"></i> <span>Login</span>
              </a>
            </li>
            @endauth
            </ul>
          </div>
        </div>
    </nav>

    @yield('carousel')
    <div class="container konten my-5">
      @yield('container')
    </div>
    
    <footer class="bg-dark text-center text-white">
      <!-- Grid container -->
      <div class="container p-4 pb-0">
        <!-- Section: Social media -->
        <section class="mb-2">
          <!-- Facebook -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
            ><i class="fab fa-facebook-f"></i>
          </a>
          <!-- Twitter -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
            ><i class="fab fa-twitter"></i>
          </a>
          <!-- Google -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
            ><i class="fab fa-google"></i>
          </a>
          <!-- Instagram -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
            ><i class="fab fa-instagram"></i>
          </a>
          <!-- Linkedin -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
            ><i class="fab fa-linkedin-in"></i>
          </a>
          <!-- Github -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
            ><i class="fab fa-github"></i>
          </a>
        </section>
      </div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <a class="nav-link text-white" href="#">&copy; 2024 | Tim Udinus 1</a>
      </div>
    </footer>  
    <script src="/js/jquery.min.js"></script>
    <script>
      $('.like-form').on('submit', function(e) {
          e.preventDefault();
  
          var form = $(this);
          var post_id = form.data('post');
  
          $.ajax({
              url: form.attr('action'),
              method: form.attr('method'),
              data: form.serialize(),
              success: function(response) {
                  // Update jumlah like dan ikon thumbs-up/down
                  var likeBtn = form.find('.btn');
                  likeBtn.find('i').removeClass('fa-solid fa-thumbs-up fa-regular fa-thumbs-up').addClass(response.iconClass);
                  likeBtn.find('.count').text(response.likeCount);
              }
          });
      });
    </script>
    <script>
      const navEL = document.querySelector('.navbar');
      window.addEventListener('scroll', () =>{
        if(window.scrollY >= 56){
          navEL.classList.add('navbar-scrolled');
        }else if(window.scrollY < 56 ){
          navEL.classList.remove('navbar-scrolled');
        }
      });
    </script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/owlcarousel/owl.carousel.min.js"></script>
    <script>
      $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
          loop:true,
          margin:10,
          nav:true,
          autoplay:true,
          autoplayTimeout:3000,
          autoplayHoverPause:true,
          center: true,
          navText: [
              "<i class='fa fa-angle-left'></i>",
              "<i class='fa fa-angle-right'></i>"
          ],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:3
                }
            }
          });
      });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function(){
        if (window.innerWidth > 992) {

          document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){

            everyitem.addEventListener('mouseover', function(e){

              let el_link = this.querySelector('a[data-bs-toggle]');

              if(el_link != null){
                let nextEl = el_link.nextElementSibling;
                el_link.classList.add('show');
                nextEl.classList.add('show');
              }

            });
            everyitem.addEventListener('mouseleave', function(e){
              let el_link = this.querySelector('a[data-bs-toggle]');

              if(el_link != null){
                let nextEl = el_link.nextElementSibling;
                el_link.classList.remove('show');
                nextEl.classList.remove('show');
              }
            })
          });
        }
      }); 
    </script>
</body>
</html>