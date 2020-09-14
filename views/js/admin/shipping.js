// Tabs
let detail_page_pickup_map = {
    lat: 24.8840067,
    lng: 67.1606157
};

let detail_dropoff_page_map = {
    lat: 24.9104189,
    lng: 67.1226082
};


$(document).ready(function (){
    // let res = {};
    // $.ajax({
    //     async: false,
    //     'url': '../modules/frank/pencil_ajax.php',
    //     method: 'get',
    //     success: function (response) {
    //         response = JSON.parse(response);
    //         res = response.data;
    //     }
    // });
    // let output = '';
    // res.map((e) => {
    //     console.log(e);
    //     output =
    //         `
    //         <tr>
    //           <td scope="col">${e.orderNumber}</td>
    //           <td scope="col">${e.contact.name}</td>
    //           <td scope="col"></td>
    //           <td scope="col">${e.pickupDate}</td>
    //           <td scope="col">${e.dropoff.country}</td>
    //           <td scope="col"><a href="#" data-target="detail" data-id="{$api_frank['_id']}" class="pencil"><i class="material-icons" style="font-size: 20px">create</i></a></td>
    //         </tr>
    //         `;
    // });
    // console.log(output);

    document.getElementById('tab-btn1').addEventListener('click', function (){
        showPanel(0, '#dee3e8');
    });

    document.getElementById('tab-btn2').addEventListener('click', function (){
        showPanel(1, '#dee3e8');
    });

    document.getElementById('tab-btn3').addEventListener('click', function (){
        showPanel(2, '#dee3e8');
    });

    let tabButtons = document.querySelectorAll('.tabs .buttonContainer button');

    let tabPanels = document.querySelectorAll('.tabs .tabPanel');

    function showPanel(panelIndex, colorCode) {
        tabButtons.forEach(function(node){
            node.style.backgroundColor = "";
            node.style.color = "";
        });
        // tabButtons[panelIndex].style.backgroundColor = colorCode;
        tabButtons[panelIndex].style.color = '#ee6931';

        tabPanels.forEach(function(node){
            node.style.display = 'none';
        });

        tabPanels[panelIndex].style.display = 'block';
        tabPanels[panelIndex].style.backgroundColor = colorCode;
    }

    showPanel(0, '#dee3e8');

    // Searching -------------------------------------------------------------------------------------------------------------------------------------------------------

    $("#txt-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#search-pending tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#txt-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#search-shipped tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#txt-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#search-cancelled tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Searching End ........................................................................................................................................................
    // Shipping Section Start
    // $('.shipping-link').on('click', function (){
    //     document.getElementById('tab-container-new-shipment-close-id').classList.remove('tab-container-new-shipment-toggle');
    //     document.getElementById('contact-detail-id').classList.remove('contact-detail-toggle');
    //     document.getElementById('upload-csv').classList.remove('upload-container');
    //
    //     document.getElementById('tab-container-new-shipment-toggle-id').classList.add('tab-container-new-shipment-toggle');
    // });
    // Shipping Section End
    // Pencil ...............................................................................................................................................................

    $('.pencil').on('click', function (){
        let page = $(this).attr('data-target');
        let id = $(this).attr('data-id');
        // console.log(id);
        $.ajax({
            async: false,
            url: '../modules/frank/pencil_ajax.php',
            method: 'POST',
            data: {_id: id},
            success: function (response) {
                console.log(response);
            }
        });
        // $('.main-tab-active').removeClass('main-tab-active');
        // document.getElementById(page).classList.add('main-tab-active');


    });

    $('.btn-new-shipment').on('click', function (){
        document.getElementById('tab-container-new-shipment-toggle-id').classList.remove('tab-container-new-shipment-toggle');
        document.getElementById('tab-container-new-shipment-close-id').classList.add('tab-container-new-shipment-toggle');
    });

    $('.new-shipment-cancel-btn').on('click', function (){
        document.getElementById('tab-container-new-shipment-close-id').classList.remove('tab-container-new-shipment-toggle');
        document.getElementById('tab-container-new-shipment-toggle-id').classList.add('tab-container-new-shipment-toggle');
    });
    // document.getElementById('tab-container-new-shipment-toggle-id').classList.remove('tab-container-new-shipment-toggle');
    document.getElementById('upload-csv').classList.remove('upload-container');
    $('.upload').on('click', function (){
        document.getElementById('tab-container-new-shipment-toggle-id').classList.remove('tab-container-new-shipment-toggle');
        document.getElementById('upload-csv').classList.add('upload-container');
    });

    $('.upload-cancel-btn').on('click', function (){
        document.getElementById('upload-csv').classList.remove('upload-container');
        document.getElementById('tab-container-new-shipment-toggle-id').classList.add('tab-container-new-shipment-toggle');
    });

    $('#return-checkbox').change(function(){
        $('#can-return-input').toggle();
    })

    $('#settings').on('click', function (){
        document.getElementById('tab-container-new-shipment-close-id').classList.remove('tab-container-new-shipment-toggle');
        document.getElementById('tab-container-new-shipment-toggle-id').classList.remove('tab-container-new-shipment-toggle');
        document.getElementById('contact-detail-id').classList.add('contact-detail-toggle');
    });

    $('#account').on('click', function (){
        document.getElementById('col-1-invoice-id').classList.remove('col-1-active');
        document.getElementById('col-1-warehouse-id').classList.remove('col-1-active');
        document.getElementById('col-1-account-id').classList.add('col-1-active');

        document.getElementById('invoice').classList.remove('select');
        document.getElementById('warehouse').classList.remove('select');
        document.getElementById('account').classList.add('select');
    });

    $('#invoice').on('click', function (){
        document.getElementById('col-1-account-id').classList.remove('col-1-active');
        document.getElementById('col-1-warehouse-id').classList.remove('col-1-active');
        document.getElementById('col-1-invoice-id').classList.add('col-1-active');

        document.getElementById('account').classList.remove('select');
        document.getElementById('warehouse').classList.remove('select');
        document.getElementById('invoice').classList.add('select');
    });

    $('#warehouse').on('click', function (){
        document.getElementById('col-1-account-id').classList.remove('col-1-active');
        document.getElementById('col-1-invoice-id').classList.remove('col-1-active');
        document.getElementById('col-1-warehouse-id').classList.add('col-1-active');

        document.getElementById('account').classList.remove('select');
        document.getElementById('invoice').classList.remove('select');
        document.getElementById('warehouse').classList.add('select');
    });

    // Email verification ajax

    // $('.form-email-verification').on('submit', function(event){
    //     event.preventDefault();
    //     $form = $(this);
    //     $.ajax({
    //         url: '../modules/frank/emailVerificationAjax.php',
    //         method: 'POST',
    //         data: $form.serialize(),
    //         success: function (response) {
    //             // response = JSON.parse(response);
    //             console.log(response);
    //             // let alert = $('.status');
    //             // alert.addClass('alert');
    //             // alert.removeClass('alert-danger');
    //             // alert.addClass('alert-success');
    //             // alert.html(response.message);
    //         }
    //     });
    // });

    // map ----------------------------------------------------------------------------------------------------------------------------------------

    $('#dropoff_address').keyup(function(){
        $('#myModal').modal('show');
    })
    $('#dismiss-button').click(function(){
        // var address =  $('#pac-input').val();
        var address = addressArr[1] ? addressArr[0] + ' '+ addressArr[1] : addressArr[0];
        $('#dropoff_address').val(address);
        // $('#dropoff_address').val(addressArr[1]);
        $('#new-shipment-city').val(addressArr[4]);
        $('#new-shipment-state').val(addressArr[7]);
        $('#new-shipment-country').val(addressArr[8]);
        $('#new-shipment-zip').val(addressArr[9]);
        console.log(addressArr);
    });

    $('#warehouse-address').keyup(function(){
        $('#myModal').modal('show');
    })
    $('#dismiss-button').click(function(){
        // var address =  $('#pac-input').val();
        var address = addressArr[1] ? addressArr[0] + ' '+ addressArr[1] : addressArr[0];
        $('#warehouse-address').val(address);
        // $('#dropoff_address').val(addressArr[1]);
        $('#warehouse-city').val(addressArr[4]);
        $('#warehouse-state').val(addressArr[7]);
        $('#warehouse-country').val(addressArr[8]);
        $('#warehouse-zip').val(addressArr[9]);
        console.log(addressArr);
    });

});

// map ----------------------------------------------------------------------------------------------------------------------------------------
//detail-page-map

let addressArr = [];

function initMap() {
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -33.8688, lng: 151.2195},
        zoom: 13
    });

    // detail page map...............................................................................................................
    let map1 = new google.maps.Map(document.getElementById('detail-page-map'), {
        zoom: 14,
        center: detail_dropoff_page_map
    });
    let marker1 = new google.maps.Marker({
        position: detail_page_pickup_map,
        map: map1,
        title: 'Frank'
    });

    let marker2 = new google.maps.Marker({
        position: detail_dropoff_page_map,
        map: map1,
        title: 'Frank'
    });

    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');
    var types = document.getElementById('type-selector');
    var strictBounds = document.getElementById('strict-bounds-selector');

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

    var autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);

    // Set the data fields to return when the user selects a place.
    autocomplete.setFields(
        ['address_components', 'geometry', 'icon', 'name']);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
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

        var address = '';
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
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];

                addressArr[i] = val;
                // console.log(val);
            }
        }
        document.getElementById('warehouse-lat').value = marker.position.lat();
        document.getElementById('warehouse-lng').value = marker.position.lng();

        document.getElementById('new-shipment-lat').value = marker.position.lat();
        document.getElementById('new-shipment-lng').value = marker.position.lng();
        // console.log(map)
        infowindow.open(map, marker);
    });

    function setupClickListener(id, types) {
        var radioButton = document.getElementById(id);
        radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
        });
    }

    setupClickListener('changetype-all', []);

    document.getElementById('use-strict-bounds')
        .addEventListener('click', function() {
            console.log('Checkbox clicked! New state=' + this.checked);
            autocomplete.setOptions({strictBounds: this.checked});
        });
}
