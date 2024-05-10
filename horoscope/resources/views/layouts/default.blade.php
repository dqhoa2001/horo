<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    @yield('content')
    {{-- <script>
        const loadMap = new Promise((resolve, reject) => {
            setTimeout(() => {
                initMap();
            }, 1000);
        });

        function initMap() {
            const myLatlng = {
                lat: 36.204824,
                lng: 138.252924
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: myLatlng,
            });
            const marker = new google.maps.Marker({
                position: myLatlng,
                map,
                title: "Click to zoom",
            });
            // map.addListener("click", (mapsMouseEvent) => {
            //     let position = mapsMouseEvent.latLng.toJSON();
            //     let lngDisplay = document.getElementById('lng-display');
            //     let latDisplay = document.getElementById('lat-display');
            //     lngDisplay.value = position.lng;
            //     latDisplay.value = position.lat;
            //     let lng = document.getElementById('lng');
            //     let lat = document.getElementById('lat');
            //     lng.value = position.lng;
            //     lat.value = position.lat;
            //     // document.querySelectorAll('input[name="longitude"]').value() = position.lng;
            //     // document.querySelectorAll('input[name="latitude"]').value() = position.lat;
            // });

            map.addListener('center_changed', () => {
                map.panTo(marker.getPosition() as google.maps.LatLng);
            })
        }

        window.loadMap = loadMap;
    </script> --}}
</body>

</html>
