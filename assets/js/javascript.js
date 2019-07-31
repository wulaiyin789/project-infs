
    
    // Password Validation
    var password = document.getElementById("InputPassword");
    var retype_password = document.getElementById("RetypePassword");

    password.onchange = checkPassword;
    retype_password.onkeyup = checkPassword;

    function checkPassword(){
        if(password.value !== retype_password.value) {
            retype_password.setCustomValidity("Passwords Don't Match");
        } else {
            retype_password.setCustomValidity('');
        }
    }

    // Google Map
    var map;
    var infoWindow;

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -27.4698, lng: 153.0251},
              zoom: 6
        });

        infoWindow = new google.maps.InfoWindow;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Your are here!');
                infoWindow.open(map);
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
            } else {
              // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                                      'Error: The Geolocation service failed.' :
                                      'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
            }



        // map = new google.maps.Map(
        //     document.getElementById('map'), {center: brisbane, zoom: 15});

        // var request = {
        //     query: 'Brisbane City',
        //     fields: ['name', 'geometry'],
        // };

        // service = new google.maps.places.PlacesService(map);

        // service.findPlaceFromQuery(request, function(results, status) {
        //     if (status === google.maps.places.PlacesServiceStatus.OK) {
        //         for (var i = 0; i < results.length; i++) {
        //             createMarker(results[i]);
        //         }

        //         map.setCenter(results[0].geometry.location);
        //     }
        // });
    }

    // function createMarker(place) {
    //     var marker = new google.maps.Marker({
    //         map: map,
    //         position: place.geometry.location
    //     });

    //     google.maps.event.addListener(marker, 'click', function() {
    //         infoWindow.setContent(place.name);
    //         infoWindow.open(map, this);
    //     });
    // }
