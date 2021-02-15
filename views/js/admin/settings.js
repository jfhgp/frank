$(document).ready(function () {

    loadContact();
    loadWarehouseData();
    function loadContact() {
        $.ajax({
            url: '../modules/frank/ajax/contactDetailAjax.php',
            method: 'get',
            success: function(response){
                response = JSON.parse(response);
                if (response.status === 200) {
                    response = response.data.contactDetail;
                    if (response) {
                        document.getElementById('contact-person').value = response.name;
                        document.getElementById('contact-phone').value = response.mobile;
                        document.getElementById('contact-language').value = response.language;
                    }
                }
            }
        });
    }
    loadEmailVerificationSection();
    function loadEmailVerificationSection() {
        $.ajax({
            url: '../modules/frank/ajax/emailVerificationSectionAjax.php',
            method: 'get',
            success: function(response){
                response = JSON.parse(response)
                let html='';
                response.forEach(function (res) {
                    html +='<form method="post" class="resend-verification-form">';
                    html +='<div class="row">';
                    html +='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
                    html +='<label for="">Email</label>';
                    html +=`<input type="text" name="verification_email" value="${res.email}" class="form-control" disabled style="border: unset; background-color: white;">`;
                    html +='</div>';
                    html +='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">';
                    html +='<label for="">Role</label>';
                    html +=`<input type='text' name='verification_role' value='${res.role}' class='form-control' disabled style='border: unset; background-color: white;'>`;
                    html +='</div>';
                    html +='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">';
                    html +='<label for="">Company</label>';
                    html +='<input type="text" name="verification_role" value="" disabled style="border: unset; background-color: white;">';
                    html +='</div>';
                    html +='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">';
                    html +='<label for="">Status</label>';
                    html +='<input type="text" name="verification_role" value="" disabled style="border: unset; background-color: white;">';
                    html +='</div>';
                    html +='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
                    html +='<label for="" class="text-white">Status</label>';
                    html +='<button type="submit" name="btn_resend_verification" class="btn form-control email-address-resend-verification">Resend verification</button>';
                    html +='</div>';
                    html +='</div>';
                    html +='</form>';
                });
                // $('.container-email-address').append(html);
                // console.log(html);
                // console.log(response);
                // if (response.status === 'success') {
                //     $('.email-verification-section').html(response.html);
                // }
            }
        });
    }


    $('.upload-image-form').on('submit', function (event){
        event.preventDefault();
        let fd = new FormData();
        fd.append('file', $('#upload-image').prop('files')[0]);
        // console.log(fd);
        $.ajax({
            url: '../modules/frank/ajax/uploadImageAjax.php',
            method: 'POST',
            data: fd,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                // data = JSON.parse(data);
                console.log(data);
                // console.log("success");
                // console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    });

    document.getElementById('ctr-2-invoice').classList.remove('ctr-active');
    document.getElementById('ctr-3-warehouse').classList.remove('ctr-active');
    $('.account').on('click', function () {

        document.getElementById('ctr-1-account').classList.add('ctr-active');
        document.getElementById('ctr-2-invoice').classList.remove('ctr-active');
        document.getElementById('ctr-3-warehouse').classList.remove('ctr-active');
    });

    $('.invoice').on('click', function () {
        document.getElementById('ctr-2-invoice').classList.add('ctr-active');
        document.getElementById('ctr-1-account').classList.remove('ctr-active');
        document.getElementById('ctr-3-warehouse').classList.remove('ctr-active');
    });

    $('.warehouse').on('click', function () {
        document.getElementById('ctr-3-warehouse').classList.add('ctr-active');
        document.getElementById('ctr-1-account').classList.remove('ctr-active');
        document.getElementById('ctr-2-invoice').classList.remove('ctr-active');
    });

    $('.contact-details-form').on('submit', function (e){
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
                    loadContact();
                    $(".contact-details-form")[0].reset();
                    e.stopPropagation();
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: "User added successfully!"
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

    $('.update-email-address-form').on('submit', function (e){
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
                    loadEmailVerificationSection();
                    $(".update-email-address-form")[0].reset();
                    e.stopPropagation();
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: "Email updated successfully!"
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

    $('.resend-verification-form').on('submit', function (e){
        e.preventDefault();
        $form = $(this);

        $.ajax({
            url: '../modules/frank/ajax/postAjax.php',
            method: 'POST',
            data: $form.serialize(),
            success: function(response) {
                response = JSON.stringify(response);
                console.log(response.status);
                if (response.status === 200 || response.status === undefined) {
                    e.stopPropagation();
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: "Email sent for verification"
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

    $('.change-password-form').on('submit', function (e){
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
                    $(".change-password-form")[0].reset();
                    e.stopPropagation();
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: "Password changed successfully!"
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

    $('.delete-account-form').on('submit', function (e){
        e.preventDefault();
        $form = $(this);
        $.ajax({
            url: '../modules/frank/ajax/deleteAccountAjax.php',
            method: 'POST',
            data: $form.serialize(),
            success: function(response) {
                response = JSON.stringify(response);
                console.log(response.status);
                if (response.status === 200) {
                    e.stopPropagation();
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: "Email sent for verification"
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

    $('.add-warehouse-form').on('submit', function (e){
        e.preventDefault();
        $form = $(this);
        $.ajax({
            // url: '../modules/frank/ajax/postAjax.php',
            url: '../modules/frank/ajax/add_updateWarehouseAjax.php',
            method: 'POST',
            data: $form.serialize(),
            success: function(response) {
                response = JSON.parse(response);
                console.log(response.status);
                if (response.status === 200) {
                    $(".add-warehouse-form")[0].reset();
                    loadWarehouseData();
                    e.stopPropagation();
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: "Warehouse added successfully!"
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

    function loadWarehouseData(){
        $.ajax({
            url: '../modules/frank/ajax/showWarehouseAjax.php',
            method: 'get',
            success: function(response){
                response = JSON.parse(response)
                // console.log(response);
                if (response.status === 'success') {
                    $('.warehouse-table').html(response.html);
                    deleteWarehouse();
                    // updateWarehouse();
                    getWarehouseById();
                }
            }
        });
    }


    function deleteWarehouse() {
        $('.delete-warehouse').on('click', function (){
            if (confirm('Are you sure you want to delete warehouse?')) {
                let id = $(this).attr('data-id_warehouse');
                // console.log(id);
                $.ajax({
                    async: false,
                    url: '../modules/frank/ajax/deleteWarehouseAjax.php',
                    method: 'POST',
                    data: {warehouse_id: id},
                    success: function (response) {
                        console.log(response);
                        loadWarehouseData();
                    }
                });
            } else {
                return false;
            }
        });
    }

    function getWarehouseById() {
        $('.update-warehouse').on('click', function (){
            let id = $(this).attr('data-id_warehouse');
            $.ajax({
                async: false,
                url: '../modules/frank/ajax/getWarehouseByIdAjax.php',
                method: 'POST',
                data: { warehouse_id: id },
                success: function (response) {
                    response = JSON.parse(response);
                    response = response.data;
                    console.log(response);
                    getElementById('warehouse-name', response.name);
                    getElementById('warehouse-address', response.address);
                    getElementById('warehouse-lat', response.location.coordinates[1]);
                    getElementById('warehouse-lng', response.location.coordinates[0]);
                    getElementById('warehouse-city', response.city);
                    getElementById('warehouse-country', response.country);
                    getElementById('warehouse-id', response._id);
                }
            });
        });
    }

    function getElementById(id, value) {
        document.getElementById(id).value = value;
    }

    $('#warehouse-address').keyup(function(){
        $('#myModal').modal('show');
        // alert(123);
    })
    $('#dismiss-button').click(function(){
        // var address =  $('#pac-input').val();
        var address = addressArr[1] ? addressArr[0] + ' '+ addressArr[1] : addressArr[0];
        $('#warehouse-address').val(address);
        $('#warehouse-city').val(addressArr[2]);
        $('#warehouse-state').val(addressArr[4]);
        $('#warehouse-country').val(addressArr[5]);
        $('#warehouse-zip').val(addressArr[6]);
        console.log(addressArr);
    });

});


var addressArr = [];
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
                // document.getElementById(addressType).value = val;
                // console.log(i);
                addressArr[i] = val;
                // console.log(val);
            }
        }
        // place.address_components[i][componentForm[addressType]];
        // console.log('latitude ',marker.position.lat());
        // console.log('longitude ',marker.position.lng());
        document.getElementById('warehouse-lat').value = marker.position.lat();
        document.getElementById('warehouse-lng').value = marker.position.lng();
        // console.log(map)
        infowindow.open(map, marker);
    });

    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    function setupClickListener(id, types) {
        var radioButton = document.getElementById(id);
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