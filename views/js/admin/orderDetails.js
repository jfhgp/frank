
$(document).ready(function (){
    let pickup = {
        lat: document.getElementById('pickup_lat').value,
        lng: document.getElementById('pickup_lng').value
    };
    let dropoff = {
        lat: document.getElementById('dropoff_lat').value,
        lng: document.getElementById('dropoff_lng').value
    };

    document.getElementById('active-tab').classList.add('tab-active');
    document.getElementById('a-active').classList.add('tab-active');
});

function initMap() {
    let dropoff = new google.maps.LatLng(parseFloat(document.getElementById('pickup_lat').value), parseFloat(document.getElementById('pickup_lng').value)),
        pickup = new google.maps.LatLng(parseFloat(document.getElementById('dropoff_lat').value), parseFloat(document.getElementById('dropoff_lng').value)),
        myOptions = {
            zoom: 7,
            center: dropoff
        },
        map = new google.maps.Map(document.getElementById('map'), myOptions),
        // Instantiate a directions service.
        directionsService = new google.maps.DirectionsService,
        directionsDisplay = new google.maps.DirectionsRenderer({
            map: map
        }),
        markerA = new google.maps.Marker({
            position: dropoff,
            title: "point A",
            label: "A",
            map: map
        }),
        markerB = new google.maps.Marker({
            position: pickup,
            title: "point B",
            label: "B",
            map: map
        });

    // get route from A to B
    calculateAndDisplayRoute(directionsService, directionsDisplay, dropoff, pickup);

}
function calculateAndDisplayRoute(directionsService, directionsDisplay, dropoff, pickup) {
    directionsService.route({
        origin: dropoff,
        destination: pickup,
        avoidTolls: true,
        avoidHighways: false,
        travelMode: google.maps.TravelMode.DRIVING
    }, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

initMap();

// document.addEventListener('DOMContentLoaded', () => {
//     let pickup = {
//         lat: parseFloat(document.getElementById('pickup_lat').value),
//         lng: parseFloat(document.getElementById('pickup_lng').value)
//     };
//     let dropoff = {
//         lat: parseFloat(document.getElementById('dropoff_lat').value),
//         lng: parseFloat(document.getElementById('dropoff_lng').value)
//     };
//     let s = document.createElement('script');
//     document.head.appendChild(s);
//     s.addEventListener('load', () => {
//         // console.log(dropoff);
//         console.log('Script has loaded');
//         let map = new google.maps.Map(document.getElementById('map'),
//             {
//                 center: dropoff,
//                 zoom: 16,
//                 mapTypeId: google.maps.MapTypeId.ROADMAP
//             });
//     });
//     s.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBXXUe1UPwcYKHx8L3drP_vJks8zl9kla4&libraries=places&callback=initMap'
// });
