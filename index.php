<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LOG IN</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
      .mapa {
        height: 400px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
    color:#2c7ff9;
    text-align: center;
      }
    </style>
  <!--   <script src="assets/js/index.js"></script> -->
</head>

<body>
    <section class="login-dark">
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container"><a class="navbar-brand" href="#">FORMULARIO REGISTRO DIW</a>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav me-auto"></ul>
                    <span class="navbar-text actions"> 
                      <a class="login" href="login.php">Log In</a>
                      <a class="btn btn-light action-button" role="button" href="signUp.php">Sign Up</a>
                    </span>
                </div>
            </div>
        </nav>
 
        
        <?php
      /**
       * get_image_location
       * Returns an array of latitude and longitude from the Image file
       * @param $image file path
       * @return multitype:array|boolean
       */
       function gps2Num($coordPart){
           $parts = explode('/', $coordPart);
           if(count($parts) <= 0)
           return 0;
           if(count($parts) == 1)
           return $parts[0];
           return floatval($parts[0]) / floatval($parts[1]);
       }
      function get_image_location($image = ''){
          $exif = exif_read_data($image, 0, true);
          if($exif && isset($exif['GPS'])){
              $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
              $GPSLatitude    = $exif['GPS']['GPSLatitude'];
              $GPSLongitudeRef= $exif['GPS']['GPSLongitudeRef'];
              $GPSLongitude   = $exif['GPS']['GPSLongitude'];

              $lat_degrees = count($GPSLatitude) > 0 ? gps2Num($GPSLatitude[0]) : 0;
              $lat_minutes = count($GPSLatitude) > 1 ? gps2Num($GPSLatitude[1]) : 0;
              $lat_seconds = count($GPSLatitude) > 2 ? gps2Num($GPSLatitude[2]) : 0;

              $lon_degrees = count($GPSLongitude) > 0 ? gps2Num($GPSLongitude[0]) : 0;
              $lon_minutes = count($GPSLongitude) > 1 ? gps2Num($GPSLongitude[1]) : 0;
              $lon_seconds = count($GPSLongitude) > 2 ? gps2Num($GPSLongitude[2]) : 0;

              $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
              $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;

              $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60*60)));
              $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60*60)));


              return array('latitude'=>$latitude, 'longitude'=>$longitude);
          }else{
              return false;
          }
      }

      $image = "assets/img/Zaragoza.JPG";
      $arr = get_image_location($image);
     ?>
     <script type="text/javascript">
       let lat = <?php echo $arr['latitude'] ?>;
       let long = <?php echo $arr['longitude'] ?>;
       let map, infoWindow;

       function initMap() {
         const pos ={ lat: lat, lng: long };
         map = new google.maps.Map(document.getElementById("map"), {
           center: pos,
           zoom: 15,
           mapId:'6ee088cb7f34e8fd',
         });
         const marker = new google.maps.Marker({
           position: pos,
           map: map,
         });

         infoWindow = new google.maps.InfoWindow();

         const locationButton = document.createElement("button");

         locationButton.textContent = "Mi ubicacion";
         locationButton.classList.add("custom-map-control-button");
         map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
         locationButton.addEventListener("click", () => {
           // Try HTML5 geolocation.
           if (navigator.geolocation) {
             navigator.geolocation.getCurrentPosition(
               (position) => {
                 const pos = {
                   lat: position.coords.latitude,
                   lng: position.coords.longitude,
                 };

                 infoWindow.setPosition(pos);
                 infoWindow.setContent("Estas aqui.");
                 infoWindow.open(map);
                 map.setCenter(pos);
               },
               () => {
                 handleLocationError(true, infoWindow, map.getCenter());
               }
             );
           } else {
             // Browser doesn't support Geolocation
             handleLocationError(false, infoWindow, map.getCenter());
           }
         });
       }

       function handleLocationError(browserHasGeolocation, infoWindow, pos) {
         infoWindow.setPosition(pos);
         infoWindow.setContent(
           browserHasGeolocation
             ? "Error: The Geolocation service failed."
             : "Error: Your browser doesn't support geolocation."
         );
         infoWindow.open(map);
       }
     </script>


            
            <div class="illustration">
              <p>PROYECTO DIW</p>
              <h2 class="visually">Aplicacion de lo que vamos aprendiendo en la asignatura</h2>
            </div>
            <div class="container">
            <div class="mapa" id="map">
              <h3>Mi Google Maps Api</h3>
                <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABT2q4eMXmdc_cozmKVGE22ScaZXZb7OE&callback=initMap&libraries=&v=weekly" async></script>
            </div>
          </div>
        
    </section>
    
    
</body>
</html>