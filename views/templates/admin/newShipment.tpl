<div class="frank">
    <div class="container-header">
        <div class="frank-logo">
            <a href="#">Frank</a>
        </div>
        <div class="frank-shipping">
            <a href="{$shipping}" class="shipping-link">Shipping</a>
        </div>
        <div class="frank-returns">
            <a href="{$returns}" class="returns-link">Returns</a>
        </div>
        <div class="frank-chart">
            <a href="{$settings}"><i class="material-icons" id="settings">settings</i></a>
        </div>
        <div class="frank-settings">
            <a href="#"><i class="material-icons">assessment</i></a>
        </div>
    </div>
    <div class="container-fluid ctr">
        <div class="row">
            <div class="col-sm-11">
                <p>Create a shipping</p>
            </div>
            <div class="col-sm-1 text-lg-right">
                <a href="{$shipping}" style="color: #e07047; font-size: 24px">X</a>
            </div>
        </div>
        <br>
        <form method="post" class="new_shipment_form">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="" style="color: #e07047; ">Order number</label>
                        <input type="text" name="orderNumber">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <p>Item information</p>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Item name</label>
                    <input type="text" name="item_name">
                </div>
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Quantity</label>
                    <input type="text" name="quantity">
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <p>Package dimension</p>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-3 ">
                    <label for="" style="color: #9d9d9d;">Width</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="width" style="border-radius: 12px 0 0 12px!important;">
                        <span class="input-group-addon" style="border-radius: 0 12px 12px 0!important;">cm</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="" style="color: #9d9d9d;">Height</label>

                    <div class="input-group">
                        <input type="number" class="form-control" name="height" style="border-radius: 12px 0 0 12px!important;">
                        <span class="input-group-addon" style="border-radius: 0 12px 12px 0!important;">cm</span>
                    </div>

                </div>
                <div class="col-sm-3">
                    <label for="" style="color: #9d9d9d;">Depth</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="depth" style="border-radius: 12px 0 0 12px!important;">
                        <span class="input-group-addon" style="border-radius: 0 12px 12px 0!important;">cm</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="" style="color: #9d9d9d;">Weight</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="weight" style="border-radius: 12px 0 0 12px!important;">
                        <span class="input-group-addon" style="border-radius: 0 12px 12px 0!important;">kg</span>
                    </div>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <p>Return information</p>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <input type="checkbox" name="active" value="1" id="return-checkbox">
                    <label for="" style="color: #9d9d9d;">Can return</label>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <input type="number" id="can-return-input" name="can_return_input" style="height: 32px; display: none; ">
                </div>
            </div>
            </div>

            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <p>Contact information</p>
                </div>
            </div>
            </div>

            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Full name</label>
                    <input type="text" name="full_name">
                </div>
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Phone number</label>
                    <input type="text" name="phone_number">
                </div>
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Email</label>
                    <input type="text" name="email_address">
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d; ">Pickup date</label>
                    <input type="date" name="pickup_date" style="width: 200px;">
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <p>Delivery method</p>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-2">
                    <input type="radio" name="delivery_type" id="flex" value="Flex">
                    <label style="color: #9d9d9d;" for="">Flex</label>
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="delivery_type" value="Classic" id="standard">
                    <label for=""  style="color: #9d9d9d;">Classic</label>
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="delivery_type" value="Green" id="green">
                    <label for="" style="color: #9d9d9d;">Green</label>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Dropoff address</label>
                    <input type="text" name="dropoff_address" id="dropoff-address">

                    <input type="hidden" name="new-shipment-lat" id="new-shipment-lat">
                    <input type="hidden" name="new-shipment-lng" id="new-shipment-lng">
                    <input type="hidden" name="new-shipment-city" id="new-shipment-city">
                    <input type="hidden" name="new-shipment-state" id="new-shipment-state">
                    <input type="hidden" name="new-shipment-country" id="new-shipment-country">
                    <input type="hidden" name="new-shipment-zip" id="new-shipment-zip">
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-6">
                    <label style="color: #e07047; for="">Pickup address</label>
                    <select name="pickup_address" style="border-radius: 9px;">
                        {foreach $api_warehouses as $api_warehouse}
                            <option>{$api_warehouse['name']}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-sm-6">
                    <label style="color: #e07047; for="">Return address</label>
                    <select name="return_address" style="border-radius: 9px;">
                        {foreach $api_warehouses as $api_warehouse}
                            <option>{$api_warehouse['name']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <button type="submit" class="create-new-shipment-btn" name="create_new_shipping">Create</button>
                </div>
            </div>
            </div>
        </form>
    </div>
</div>


{*modal map --------------------------------------------------------------------------------------------------------------------------------------*}

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
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXXUe1UPwcYKHx8L3drP_vJks8zl9kla4&libraries=places&callback=initMap" type="text/javascript"></script>
