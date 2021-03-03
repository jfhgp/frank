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


const deliveryAddress = document.querySelector('#delivery-address > div > section > div:nth-child(12) > div.col-md-6 > input');
const optional = document.querySelector("#delivery-address > div > section > div:nth-child(12) > div.col-md-3.form-control-comment");
optional.style.display = "none";
// console.log("name", deliveryAddress);

deliveryAddress.setAttribute("required", true);
// let address = document.querySelector('#delivery-address > div > section > div:nth-child(7)');
// address.style.display = 'block';
document.body.innerHTML += `

<!-- Modal for map -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="pac-card" id="pac-card">
      <div>
        <div id="title">
          Select Pickup Location
        </div>
        <div id="type-selector" class="pac-controls">
          <input type="radio" name="type" id="changetype-all" checked="checked">
          <label for="changetype-all">All</label>
        </div>
        <div id="strict-bounds-selector" class="pac-controls">
          <input type="checkbox" id="use-strict-bounds" value="">
          <label for="use-strict-bounds">Strict Bounds</label>
        </div>
      </div>
      <div id="pac-container">
        <input id="pac-input" type="text"
            placeholder="Enter a location">
      </div>
    </div>
    <div id="map"></div>
    <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="dismiss-button" class="btn btn-default" data-dismiss="modal">Select</button>
      </div>
    </div>
  </div>
</div>>
<!--Modal for Timeslot start-->
<div class="modal fade" id="myModali" role="dialog">';
<div class="modal-dialog">
    <!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
     
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Modal Header</h4>
</div>
<div class="modal-body"  >
<!--mbsc-schedule-wrapper mbsc-ios-->
<!--hookActionFrontControllerSetMedia-->
    <div mbsc-page class="demo-desktop-week-view">  
            <div id="demo-desktop-week-view" style="height: 370px"></div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>
<!--Modal for Timeslot End-->
<!--Modal for Timeslot-->

<div class="modal fade" id="time-slot-modal" tabindex="-1" role="dialog" aria-labelledby="time-slot-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="time-slot-modal-label">Information for your delivery </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div id="pac-container">
                <input id="map-address" type="text">
           </div>
           <div class="row">
               <div class="col-lg-4">
                    <ul class="pagination pagination-lg">
                        <li id="minus-disabled" class="page-item">
                            <a class="page-link" id="minus" href="#">&laquo;</a>
                        </li>
                        <li id="plus-disabled" class="page-item">
                            <a class="page-link" id="plus" href="#">&raquo;</a>
                        </li>
                    </ul>
               </div>
               <div class="col-lg-4">
                   <h4 id="date-increment"></h4>
               </div>
               <div class="col-md-4">
                <label for="">Jump to</label>
                <select name="time_slot_months" id="time-slot-months">
                    <option value="1">Jan</option>
                    <option value="2">Feb</option>
                    <option value="3">Mar</option>
                    <option value="4">Apr</option>
                    <option value="5">May</option>
                    <option value="6">Jun</option>
                    <option value="7">Jul</option>
                    <option value="8">Aug</option>
                    <option value="9">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
           </div>
           </div>
           <div class="row" id="dates-time-slot"></div>
<!--           <br>-->
<!--           <div class="row" id="slot-row-1"></div>-->
<!--           <br>-->
<!--           <div class="row" id="slot-row-2"></div>-->
<!--           <br>-->
<!--           <div class="row" id="slot-row-3"></div>-->
<!--           <br>-->
<!--           <div class="row" id="slot-row-4"></div>-->
<!--           <br>-->
<!--           <div class="row" id="slot-row-5"></div>-->
<!--           <br>-->
<!--           <div class="row" id="slot-row-6"></div>-->
<!--      </div>-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
`;


let mapApiScriptTag = document.createElement("script");
mapApiScriptTag.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBXXUe1UPwcYKHx8L3drP_vJks8zl9kla4&libraries=places&callback=initMap";
document.body.appendChild(mapApiScriptTag);

let addressArr = [];
let lat;
let lng;

function initMap() {
    const componentForm = {
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

    autocomplete.addListener('place_changed', function () {
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
        //console.log('longitude ',marker.position.lng());
        // console.log(addressArr[0])
        lat = marker.position.lat();
        lng = marker.position.lng();

        infowindow.open(map, marker);
    });

    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    function setupClickListener(id, types) {
        let radioButton = document.getElementById(id);
        radioButton.addEventListener('click', function () {
            autocomplete.setTypes(types);
        });
    }

    setupClickListener('changetype-all', []);
    // setupClickListener('changetype-address', ['address']);
    // setupClickListener('changetype-establishment', ['establishment']);
    // setupClickListener('changetype-geocode', ['geocode']);

    document.getElementById('use-strict-bounds')
        .addEventListener('click', function () {
            // console.log('Checkbox clicked! New state=' + this.checked);
            autocomplete.setOptions({strictBounds: this.checked});
        });
}

$(document).ready(function () {

    let add_six_Days = 5;
    let year = new Date().getFullYear();
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    const dayName = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    console.log(dayName[1]);

    datesTimeSlot(new Date().getMonth() + 1, new Date().getDate());

    function datesTimeSlot(selectedMonth, selectedDate) {


        let monthName = monthNames[selectedMonth - 1];

        let remaining_days = (daysInMonth(selectedMonth, year)) - selectedDate;
        let getDaysInMonth = daysInMonth(selectedMonth, year);

        if (remaining_days >= 6) {

            // Click to increase dates
            let clickCount = 0;
            let totalClicked = 0;
            $("#plus").click(function () {

                $('#dates-time-slot').empty();
                document.getElementById('minus-disabled').classList.remove('disabled');
                clickCount += 5;
                totalClicked += 1;
                let remainingDaysCounter = getDaysInMonth - clickCount;
                if (remainingDaysCounter > add_six_Days) {
                    let increaseDate = selectedDate + clickCount;
                    $('#date-increment').text(increaseDate + '-' + (increaseDate + add_six_Days) + ' ' + monthName + ' ' + year);
                    for (let i = 0; i <= add_six_Days; i++) {
                        $("#dates-time-slot").append('<div class= "col-md-2">' + parseInt(increaseDate + i) + '</div>');
                    }
                } else {

                    let increaseDate = selectedDate + clickCount;

                    let add_remaining_days = getDaysInMonth - selectedDate - clickCount;
                    $('#date-increment').text(increaseDate + '-' + daysInMonth(selectedMonth, year) + ' ' + monthName + ' ' + year);

                    for (let i = 0; i <= add_remaining_days; i++) {
                        $("#dates-time-slot").append('<div class= "col-md-2">' + parseInt(increaseDate + i) + '</div>');
                    }
                    document.getElementById('plus-disabled').classList.add('disabled');
                }

                // console.log(totalClicked);
            });


            // By default
            $('#date-increment').text(selectedDate + '-' + (selectedDate + add_six_Days) + ' ' + monthName + ' ' + year);

            for (let i = 0; i <= add_six_Days; i++) {
                $("#dates-time-slot").append('<div class= "col-md-2">' + parseInt(selectedDate + i) + '</div>');
                for (let j = 0; j < 6; j++) {
                    $("#slot-row-1").append('<div class= "col-md-2"> Slot-' + (j + 1) + '</div>');
                }
                // $("#slot-row-1").append('<div class= "col-md-2"> Slot-' + (i + 1) + '</div>');
                // $("#slot-row-2").append('<div class= "col-md-2"> Slot-' + (1 + i) + '</div>');
                // $("#slot-row-3").append('<div class= "col-md-2"> Slot-' + (1 + i) + '</div>');
                // $("#slot-row-4").append('<div class= "col-md-2"> Slot-' + (1 + i) + '</div>');
                // $("#slot-row-5").append('<div class= "col-md-2"> Slot-' + (1 + i) + '</div>');
                // $("#slot-row-6").append('<div class= "col-md-2"> Slot-' + (1 + i) + '</div>');
            }

        } else {
            $('#date-increment').text(selectedDate + '-' + remaining_days + ' ' + monthName + ' ' + year);

            for (let i = 1; i < remaining_days; i++) {
                $("#dates-time-slot").append('<div class= "col-md-2">' + parseInt(selectedDate + i) + '</div>');
            }
        }
    }

    if (window.location.href.includes("/order")) {

        $('#myModal').ready(function () {
            $('[name="address1"]').keyup(function () {
                $('#myModal').modal('show');
                // $('#time-slot-modal').modal('show');
            })
            $('#dismiss-button').click(function () {

                document.getElementById('map-address').value = document.getElementById('pac-input').value;
                // console.log(input_address);
                let latLng = lat + "," + lng;
                let address = addressArr[1] ? addressArr[0] + ' ' + addressArr[1] : addressArr[0];
                $('[name="address1"]').val(address);
                $('[name="city"]').val(addressArr[2] ? addressArr[2] : '');
                $('[name="id_state"]').val(addressArr[4] ? addressArr[4] : 0);
                $('[name="postcode"]').val(addressArr[6] ? addressArr[6] : '');
                // $('[name="id_country"]').val(addressArr[5] ? addressArr[5] : 0);
                $('[name="address2"]').val(latLng);
                $('#myModali').modal('show');
            });
        });
    }

    // Time slot section with Ajax
    let frank_id;
    let frank_token;
    let time_slot_get_res;

    $.ajax({
        async: false,
        url: '../modules/frank/ajax/variableAjax.php',
        method: 'get',
        success: function (response) {
            response = JSON.parse(response);
            frank_id = response.frank_id;
            frank_token = response.frank_token;
            // console.log(response);
        }
    });

    // $.ajax({
    //     async: false,
    //     url: 'timeslots/all',
    //     method: 'get',
    //     timeout: 0,
    //     headers: {
    //         Authorization: 'Bearer ' + frank_token
    //     },
    //     success: function (response) {
    //         if (response.status === 200) {
    //             time_slot_get_res = response.data;
    //         } else {
    //             time_slot_get_res = 'Something went wrong';
    //         }
    //     }
    // });
    // console.log(time_slot_get_res);

    let settings = {
        "url": "timeslots/find",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json"
        },
        "data": JSON.stringify({"startDate": "07-10-2020", "endDate": "07-30-2020", "location": [0, 0]}),
    };

    $.ajax(settings).done(function (response) {
        console.log(response.data);
        response = response.data['15-7-2020'];
        response.map(function (value) {
            console.log(value);
        });
        // console.log(response);

    });
});

function daysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
}


var inst = mobiscroll.eventcalendar('#demo-desktop-week-view', {
    locale: mobiscroll.localeEn,
    theme: 'ios',                           // Specify theme like: theme: 'ios' or omit setting to use default
    themeVariant: 'light',                  // More info about themeVariant: https://docs.mobiscroll.com/5-0-4/javascript/eventcalendar#opt-themeVariant
    view: {                                 // More info about view: https://docs.mobiscroll.com/5-0-4/javascript/eventcalendar#opt-view
        schedule: {type: 'week'}
    },
    onEventClick: function (event, inst) {  // More info about onEventClick: https://docs.mobiscroll.com/5-0-4/javascript/eventcalendar#event-onEventClick
        mobiscroll.toast({

            message: event.event.title
        });
    }
});

var arr = [

    {
        start: "2021-02-08T08:00:00.000Z",
        end:   "2021-02-08T10:00:00.000Z",
        title: "Felex",
        color: "#0c2087"
    },
    {
        start: "2021-02-08T08:00:00.000Z",
        end:   "2021-02-08T10:00:00.000Z",
        title: "Classic",
        color: "#fa7700"
    },
    {
        start: "2021-02-08T08:00:00.000Z",
        end:   "2021-02-08T10:00:00.000Z",
        title: "Green",
        color: "#033904"
    },

     {start: "2021-02-03T06:00:00.000Z", end: "2021-02-03T07:00:00.000Z", title: "Product team mtg.", color: "#913aa7"},
     {
         start: "2021-02-03T12:00:00.000Z",
         end: "2021-02-03T13:00:00.000Z",
         title: "General orientation",
         color: "#35bb5a"
     },
     {start: "2021-02-03T17:00:00.000Z", end: "2021-02-03T18:00:00.000Z", title: "Clever Conference", color: "#a71111"},
         {
         start: "2021-02-04T06:00:00.000Z",
         end: "2021-02-04T07:00:00.000Z",
         title: "Green box to post office",
         color: "#0048ff"
     },
     {
         start: "2021-02-04T06:00:00.000Z",
         end: "2021-02-04T07:00:00.000Z",
         title: "Green box to post office",
         color: "#6e7f29"
     },

         {
             start: "2021-02-04T06:00:00.000Z",
             end: "2021-02-04T07:00:00.000Z",
             title: "Green box to post office",
             color: "#ff0000"
         },
     {
         start: "2021-02-02T07:45:00.000Z",
         end: "2021-02-02T09:00:00.000Z",
         title: "Quick mtg. with Martin",
         color: "#de3d83"
     },
     {start: "2021-02-08T08:30:00.000Z", end: "2021-02-08T09:30:00.000Z", title: "Product team mtg.", color: "#f67944"},
     {start: "2021-02-08T10:00:00.000Z", end: "2021-02-08T10:45:00.000Z", title: "Stakeholder mtg.", color: "#a144f6"},
     {start: "2021-02-08T12:00:00.000Z", end: "2021-02-08T12:45:00.000Z", title: "Lunch @ Butcher's", color: "#00aabb"},
     {recurring: {repeat: "yearly", month: 2, day: 14}, allDay: true, title: "Dexter BD", color: "#37bbe4"},
     {recurring: {repeat: "yearly", month: 2, day: 25}, allDay: true, title: "Luke BD", color: "#37bbe4"},
     {recurring: {repeat: "weekly", weekDays: "WE"}, allDay: true, title: "Employment (Semi-weekly)", color: "#228c73"},
     {
         start: "2021-02-09T23:00:00.000Z",
         end: "2021-02-14T23:00:00.000Z",
         allDay: true,
         title: "Sam OFF",
         color: "#ca4747"
     },
     {

         start: "2021-02-17T23:00:00.000Z",
         end: "2021-02-28T23:00:00.000Z",
         allDay: true,
         title: "Europe tour",
         color: "#56ca70"
     },
     {
         start: "2021-02-06T23:00:00.000Z",
         end: "2021-02-24T23:00:00.000Z",
         allDay: true,
         title: "Dean OFF",
         color: "#99ff33"
     },
     {
         start: "2021-03-04T23:00:00.000Z",
         end: "2021-03-13T23:00:00.000Z",
         allDay: true,
         title: "Mike OFF",
         color: "#e7b300"
     },
     {
         start: "2021-05-06T23:00:00.000Z",
         end: "2021-05-15T23:00:00.000Z",
         allDay: true,
         title: "John OFF",
         color: "#669900"
     },
     {
         start: "2021-05-31T23:00:00.000Z",
         end: "2021-06-10T23:00:00.000Z",
         allDay: true,
         title: "Carol OFF",
         color: "#6699ff"
     },
     {
         start: "2021-07-01T23:00:00.000Z",
         end: "2021-07-16T23:00:00.000Z",
         allDay: true,
         title: "Jason OFF",
         color: "#cc9900"
     },
     {
         start: "2021-08-05T23:00:00.000Z",
         end: "2021-08-13T23:00:00.000Z",
         allDay: true,
         title: "Ashley OFF",
         color: "#339966"
     },
     {
         start: "2021-09-09T23:00:00.000Z",
         end: "2021-09-19T23:00:00.000Z",
         allDay: true,
         title: "Marisol OFF",
         color: "#8701a9"
     },
     {
         start: "2021-09-30T23:00:00.000Z",
         end: "2021-10-11T23:00:00.000Z",
         allDay: true,
         title: "Sharon OFF",
         color: "#cc6699"
     },
     {recurring: {repeat: "yearly", month: 12, day: 25}, allDay: true, title: "Christmas Day", color: "#ff0066"},
     {recurring: {repeat: "yearly", month: 1, day: 1}, allDay: true, title: "New Year's day", color: "#99ccff"},
     {recurring: {repeat: "yearly", month: 11, day: 2}, allDay: true, title: "April Fool's Day", color: "#ff6666"},
    {
             recurring: {repeat: "yearly", month: 3, day: 22},
             allDay: true,
             title: "File Form 720 for the third quarter",
             color: "#147ea6"
         },
         {
             recurring: {repeat: "yearly", month: 12, day: 18},
             allDay: true,
             title: "File Form 730 and pay tax on wagers accepted during September",
             color: "#a73a4e"
         },
         {
             recurring: {repeat: "yearly", month: 9, day: 22},
             allDay: true,
             title: "File Form 2290 and pay the tax for vehicles first used during September",
             color: "#218e0d"
         },
         {
             recurring: {repeat: "yearly", month: 8, day: 23},
             allDay: true,
             title: "File Form 941 for the third quarter",
             color: "#a67914"
         },
         {
             recurring: {repeat: "yearly", month: 6, day: 9},
             allDay: true,
             title: "Deposit FUTA owed through Sep if more than $500",
             color: "#3c0707"
         },
         {
             recurring: {repeat: "yearly", month: 4, day: 16},
             allDay: true,
             title: "Deposit payroll tax for payments on Nov 21-24 if the semiweekly deposit rule applies",
             color: "#14a618"
         },
         {
             recurring: {repeat: "yearly", month: 3, day: 15},
             allDay: true,
             title: "File Form 730 and pay tax on wagers accepted during October",
             color: "#722ac1"
         },
         {
             recurring: {repeat: "yearly", month: 2, day: 5},
             allDay: true,
             title: "File Form 2290 and pay the tax for vehicles first used during October",
             color: "#256069"
    }
];
var abc=[{}];
for(let i=1;i<=7;i++){
    abc = [
        {
            start: "2021-02-0"+i+"T08:00:00.000Z",
            end:   "2021-02-0"+i+"T10:00:00.000Z",
            title: "Felex",
            color: "#0c2087"
        },
        {
            start: "2021-02-0"+i+"T08:00:00.000Z",
            end:   "2021-02-0"+i+"T10:00:00.000Z",
            title: "Classic",
            color: "#fa7700"
        },
        {
            start: "2021-02-0"+i+"T08:00:00.000Z",
            end:   "2021-02-0"+i+"T10:00:00.000Z",
            title: "Green",
            color: "#033904"
        }

    ]

    arr.push(abc);
}

mobiscroll.util.http.getJson('https://trial.mobiscroll.com/events/?vers=5', function (events) {
    inst.setEvents(arr);
}, 'jsonp');
// time slot js end