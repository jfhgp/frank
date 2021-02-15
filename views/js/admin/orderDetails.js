
$(document).ready(function (){
    let pickup = {
        lat: document.getElementById('pickup_lat').value,
        lng: document.getElementById('pickup_lng').value
    };
    let dropoff = {
        lat: document.getElementById('dropoff_lat').value,
        lng: document.getElementById('dropoff_lng').value
    };
    let order_status = document.getElementById('order-status').value;

    if (order_status === 'pending') {
        document.getElementById('order-placed-main').classList.add('tab-active');
        document.getElementById('order-placed-href').classList.add('tab-active');
    } else if (order_status === 'onmyway' || order_status === 'accepted') {
        document.getElementById('sent-with-main').classList.add('tab-active');
        document.getElementById('sent-with-href').classList.add('tab-active');
    } else if (order_status === 'picked') {
        document.getElementById('delivery-in-progress-main').classList.add('tab-active');
        document.getElementById('delivery-in-progress-href').classList.add('tab-active');
    } else if (order_status === 'delivered') {
        document.getElementById('delivered-main').classList.add('tab-active');
        document.getElementById('delivered-href').classList.add('tab-active');
    }


//    Cancel Order functionality
    $('.order-cancel').on('submit', function (event) {

        event.preventDefault();
        console.log('ggggg');
        $form = $(this);
        $.ajax({
            url: '../modules/frank/ajax/cancelOrderAjax.php',
            method: 'POST',
            data: $form.serialize(),
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                if (response.status === 200) {
                    event.stopPropagation();
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: "Order Cancelled Successfully!"
                    });
                }
            }
        });
    });

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
            label: "Dropoff",
            map: map
        }),
        markerB = new google.maps.Marker({
            position: pickup,
            title: "point B",
            label: "Pickup",
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
