<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <style>
      trix-toolbar [data-trix-button-group="file-tools"] 
      {
        display: none;
      }
    </style>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
  </head>
  <body>
    
    @include('dashboard.layouts.header')

<div class="container-fluid">
  <div class="row">
    @include('dashboard.layouts.sidebar')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('container')
    </main>
  </div>
</div>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script src="/js/dashboard.js"></script>
    {{-- <script>
      // Initialize Google Maps
      function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
      });

      // Get the user's current location
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function (position) {
              const currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
              map.setCenter(currentLocation);
          });
        }
      }

      let marker; // Global variable to store the marker
      map.addListener('click', (event) => {
          const latLng = event.latLng;

          // If a marker already exists, remove it
          if (marker) {
              marker.setMap(null);
          }

          // Add a new marker at the clicked location
          marker = new google.maps.Marker({
              position: latLng,
              map: map,
              draggable: true,
              animation: google.maps.Animation.DROP
          });

          // Update input fields with latitude and longitude
          $('#latitude').val(latLng.lat());
          $('#longitude').val(latLng.lng());
      });

    </script>
    <!-- Initialize Google Maps -->
    <script>
      initMap();
    </script> --}}
  </body>  
</html>
