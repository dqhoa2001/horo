function initMap() {
  const myLatlng = {
    lng: 138.253,
    lat: 36.205,
  };
  let geocoder = new google.maps.Geocoder();

  const map = new google.maps.Map(document.getElementById('map'), {
    center: new google.maps.LatLng(myLatlng.lat, myLatlng.lng),
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  });

  let marker = new google.maps.Marker({
    position: myLatlng,
    map,
    title: 'here',
  });

  // const setPosition = (currentPosition) => {
  //     myLatlng.lng = currentPosition.coords.longitude;
  //     myLatlng.lat = currentPosition.coords.latitude;
  // };

  // if (lng != undefined && lat != undefined) {
  //     myLatlng.lng = lng;
  //     myLatlng.lat = lat;
  // } else {
  //     if (navigator.geolocation) {
  //         navigator.geolocation.getCurrentPosition(setPosition);
  //     } else {
  //         myLatlng.lng = 138.252924;
  //         myLatlng.lat = 36.204824;
  //     }
  // }

  map.addListener('center_changed', () => {
    var lng = document.getElementById('map-longitude');
    var lat = document.getElementById('map-latitude');
    var inputLng = document.getElementById('lng');
    var inputLat = document.getElementById('lat');
    lng.value = map.getCenter().lng();
    lat.value = map.getCenter().lat();
    inputLng.value = map.getCenter().lng();
    inputLat.value = map.getCenter().lat();
  });

  function clear() {
    marker.setMap(null);
  }

  function geocode(request) {
    clear();
    var mapCity = document.getElementById('map-city');
    geocoder
      .geocode(request)
      .then(result => {
        const { results } = result;
        mapCity.value = results[0].formatted_address;
        console.log(mapCity.value);
        map.setCenter(results[0].geometry.location);
        marker.setPosition(results[0].geometry.location);
        marker.setMap(map);
        response.innerText = JSON.stringify(result, null, 2);
        return results;
      })
      .catch(e => {
        console.log(
          'Geocode was not successful for the following reason: ' + e
        );
      });
  }

  document.getElementById('searchMapBtn').addEventListener('click', e => {
    let address = document.getElementById('searchMapInput').value;
    geocode({ address: address });
  });
}

const loadMap = new Promise((resolve, reject) => {
  setTimeout(() => {
    initMap();
  }, 1000);
});

window.loadMap = loadMap;
