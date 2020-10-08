
setTimeout(
    function initialize() {

        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
        const locationInputs = document.getElementsByClassName("map-input");
        const autocompletes = [];
        const geocoder = new google.maps.Geocoder();
        for (let i = 0; i < locationInputs.length; i++) {

            const input = locationInputs[i];
            const fieldKey = input.id.replace("-input", "");
            const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

            const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || 47.6588;
            const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || -117.4260;
            const mapId = '65d9cecb5866ffd4';
            const mapOptions = {
                useStaticMap: false,
                center: {lat: latitude, lng: longitude},
                zoom: 13,
                mapId: mapId,
            }
            const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), mapOptions);

            const marker = new google.maps.Marker({
                map: map,
                position: {lat: latitude, lng: longitude},
            });

            marker.setVisible(isEdit);
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.key = fieldKey;
            autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
        }
        function geocodeLatLng(geocoder, map, location) {

            geocoder.geocode({ location: location }, (results, status) => {
                if (status === "OK") {
                    if (results[0]) {
                        map.setCenter(location);
                        document.getElementById("address-input").value = results[0].formatted_address;
                        document.getElementById('address-longitude').value = results[0].geometry.location.lng();
                        document.getElementById('address-latitude').value = results[0].geometry.location.lat();

                    } else {
                        window.alert("No results found");
                    }
                } else {
                    window.alert("Geocoder failed due to: " + status);
                }
            });
        }

        for (let i = 0; i < autocompletes.length; i++) {
            const input = autocompletes[i].input;
            const autocomplete = autocompletes[i].autocomplete;
            const map = autocompletes[i].map;
            const marker = autocompletes[i].marker;

            // move marker on click
            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng);
            });

            function placeMarker(location) {
                marker.setPosition(location)
                geocodeLatLng(geocoder, map, location);
            }

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                marker.setVisible(false);
                const place = autocomplete.getPlace();

                geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        const lat = results[0].geometry.location.lat();
                        const lng = results[0].geometry.location.lng();
                        setLocationCoordinates(autocomplete.key, lat, lng);
                    }
                });

                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    input.value = "";
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(12);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

            });
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
        }


    }, 1000);



google.maps.event.addDomListener(window, 'page:load', initialize);
