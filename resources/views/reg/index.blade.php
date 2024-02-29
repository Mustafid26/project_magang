<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/owlcarousel/owl.carousel.min.css">
  <link rel="stylesheet" href="/owlcarousel/owl.theme.default.min.css">
  <link href='https://fonts.googleapis.com/css?family=Patua One' rel='stylesheet'>
  <title>SemarangInsight | {{ $title }}</title>
  <style>
    body{
      font-family: 'Patua One';
      background-image:url(image/Lawang.jpg);
      background-size:cover;
      background-repeat:no-repeat;
    }
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>
  <link href="/css/login.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
  <div class="card card-login m-auto" >
    <main class="form-signin w-100 m-auto mb-2">
      <a href="/">
        <img class="mb-12 logo" src="/image/logo.png" alt="">
      </a>
      <form action="/register" method="post">
        @csrf
        <h1 class="h3 mb-3 fw-normal text-center">Registrasi</h1>
        <div class="form-floating mb-2">
          <input type="text" name="name" class="form-control rounded @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name') }}" required>
          <label for="name">Nama Lengkap</label>

          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating mb-2">
          <input type="text" name="username" class="form-control rounded @error('username') is-invalid @enderror" id="username" placeholder="Username" value="{{ old('username') }}" required>
          <label for="username">Username</label>
          
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        </div>
        <div class="form-floating mb-2">
          <input type="email" name="email" class="form-control rounded @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}"  required>
          <label for="email">Alamat Email</label>

          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating mb-2">
          <input type="password" name="password" class="form-control rounded @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
          <label for="password">Kata Sandi</label>
          
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Daftar</button>
      </form>
      <small class="d-block text-center mt-3">Sudah Punya Akun?<a href="/login"> Login</a></small>
  </main>
  </div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
