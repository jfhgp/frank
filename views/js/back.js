/**
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
// This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

$(document).ready(function () {
    $('.registration-form').on('submit', function (e){
        e.preventDefault();
        $form = $(this);
        // console.log($form);
        $.ajax({
            url: '../modules/frank/registrationAjax.php',
            method: 'POST',
            data: $form.serialize(),
            success: function (response) {
                response = JSON.parse(response);
                if (response.status === 200) {
                    document.getElementById('p-body').classList.remove('active');
                    document.getElementById('confirmation').classList.add('active');
                    document.getElementById("mobile").value = document.getElementById('mobile-number').value;

                    document.getElementById('con-first-name').value = document.getElementById("first-name").value;
                    document.getElementById('con-last-name').value = document.getElementById("last-name").value;
                    document.getElementById('con-address-1').value = document.getElementById("address-1").value ;
                    document.getElementById('con-address-2').value = document.getElementById("address-2").value;
                    document.getElementById('con-address-3').value = document.getElementById("address-3").value;
                    document.getElementById('con-city').value = document.getElementById("city").value;
                    document.getElementById('con-zip-code').value = document.getElementById("postal-code").value;
                    document.getElementById('con-country').value = document.getElementById("country").value;
                    document.getElementById('con-country-code').value = document.getElementById("country-code").value;
                    document.getElementById('con-mobile').value = document.getElementById("mobile-number").value;
                    document.getElementById('con-stores').value = document.getElementById("number-of-stores").value;
                    document.getElementById('con-latitude').value = document.getElementById("latitude-id").value;
                    document.getElementById('con-longitude').value = document.getElementById("longitude-id").value;

                } else if (response.status === 300) {
                    console.log(response.status);
                } else {
                    console.log(response.status);
                }
            }
        });
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
          document.getElementById('latitude-id').value = marker.position.lat();
          document.getElementById('longitude-id').value = marker.position.lng();
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
$(document).ready(function(){
  $('#address-1').keyup(function(){
    $('#myModal').modal('show');
    // alert(123);
  }) 
  $('#dismiss-button').click(function(){
    // var address =  $('#pac-input').val();
    var address = addressArr[1] ? addressArr[0] + ' '+ addressArr[1] : addressArr[0]; 
    $('#address-1').val(address);
    $('#city').val(addressArr[2]);
    $('#FRANK_STORE_STATE').val(addressArr[4]);
    $('#country').val(addressArr[5]);
    $('#postal-code').val(addressArr[6]);
  // console.log(addressArr);  
  });
});