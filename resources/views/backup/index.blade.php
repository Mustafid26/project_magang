<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/owlcarousel/owl.carousel.min.css">
  <link rel="stylesheet" href="/owlcarousel/owl.theme.default.min.css">
  <link href='https://fonts.googleapis.com/css?family=Patua One' rel='stylesheet'>
  <title>SemarangInsight | {{ $title }}</title>
  <style>
    body{
      background-image:url(image/Lawang.jpg);
      background-size:cover;
      background-repeat:no-repeat;
      font-family: 'Patua One';
    }
  </style>
</head>
<body>
  <img src="image/logo.png" alt="">
  <div class="card col-12 col-lg-8 mb-3 ms-5 justify-content-center ">
    <div class="row justify-content-center">
      <div class="col-md-5">
          <main class="form-signin mb-2">
              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('loginError') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              
              <form action="/login" method="post">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please Login</h1>
                <div class="form-floating mb-2">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                  <label for="email">Email address</label>
  
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-floating mb-2">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                  <label for="password">Password</label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
              </form>
              <small class="d-block text-center mt-3"><a href="/register">Belum Punya Akun? </a></small>
          </main>
      </div>
  </div>
  </div>
  
</body>
</html>
