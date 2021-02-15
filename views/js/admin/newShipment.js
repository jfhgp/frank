$(document).ready(function () {

    $('#return-checkbox').change(function(){
        $('#can-return-input').toggle();
    });

    $('.new_shipment_form').on('submit', function (e){
        e.preventDefault();
        $form = $(this);
        $.ajax({
            url: '../modules/frank/ajax/postAjax.php',
            method: 'POST',
            data: $form.serialize(),
            success: function(response) {
                response = JSON.parse(response);
                console.log(response.status);
                if (response.status === 200) {
                    $(".new_shipment_form")[0].reset();
                    e.stopPropagation();
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: "New Shipment added successfully!"
                    });
                } else {
                    e.stopPropagation();
                    return $.growl.error({
                        title: "",
                        size: "large",
                        message: "Some thing went wrong"
                    });
                }
            },
        });

    });


    $('#dropoff-address').keyup(function(){
        $('#myModal').modal('show');
        // alert(123);
    })
    $('#dismiss-button').click(function(){
        let address = addressArr[1] ? addressArr[0] + ' '+ addressArr[1] : addressArr[0];
        $('#dropoff-address').val(address);
        $('#new-shipment-city').val(addressArr[2]);
        $('#new-shipment-state').val(addressArr[4]);
        $('#new-shipment-country').val(addressArr[5]);
        $('#new-shipment-zip').val(addressArr[6]);
        // console.log(addressArr);
    });
});


let addressArr = [];
function initMap() {
    let componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
    let map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -33.8688, lng: 151.2195},
        zoom: 13
    });
    let card = document.getElementById('pac-card');
    let input = document.getElementById('pac-input');
    let types = document.getElementById('type-selector');
    let strictBounds = document.getElementById('strict-bounds-selector');

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

    let autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);

    // Set the data fields to return when the user selects a place.
    autocomplete.setFields(
        ['address_components', 'geometry', 'icon', 'name']);

    let infowindow = new google.maps.InfoWindow();
    let infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    let marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        let place = autocomplete.getPlace();
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        let address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindowContent.children['place-icon'].src = place.icon;
        infowindowContent.children['place-name'].textContent = place.name;
        infowindowContent.children['place-address'].textContent = address;
        // console.log("place address " + place.address_components);
        // console.log(place.address_components[2].types[0]);
        for (let i = 0; i < place.address_components.length; i++) {
            let addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                let val = place.address_components[i][componentForm[addressType]];
                // document.getElementById(addressType).value = val;
                // console.log(i);
                addressArr[i] = val;
                // console.log(val);
            }
        }
        // place.address_components[i][componentForm[addressType]];
        // console.log('latitude ',marker.position.lat());
        // console.log('longitude ',marker.position.lng());
        document.getElementById('new-shipment-lat').value = marker.position.lat();
        document.getElementById('new-shipment-lng').value = marker.position.lng();
        // console.log(map)
        infowindow.open(map, marker);
    });

    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    function setupClickListener(id, types) {
        let radioButton = document.getElementById(id);
        radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
        });
    }

    setupClickListener('changetype-all', []);
    // setupClickListener('changetype-address', ['address']);
    // setupClickListener('changetype-establishment', ['establishment']);
    // setupClickListener('changetype-geocode', ['geocode']);

    document.getElementById('use-strict-bounds')
        .addEventListener('click', function() {
            console.log('Checkbox clicked! New state=' + this.checked);
            autocomplete.setOptions({strictBounds: this.checked});
        });
}