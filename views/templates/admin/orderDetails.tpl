<div class="frank">
    <div class="container-header">
        <div class="column-1">
            <a href="#" style="text-decoration: none; "><h1 style="color: #e07047; float: left; padding-left: 30px;">Frank</h1></a>
        </div>
        <div class="column-2">
            <a href="{$shipping}" class="shipping-link">Shipping</a>
        </div>
        <div class="column-3">
            <a href="{$returns}" class="returns-link">Returns</a>
        </div>
        <div class="column-4">
            <a href="#"><i class="material-icons" id="settings" style="float: right; margin-right: 30px; margin-top: 27px; color: #e07047">settings</i></a>
        </div>
        <div class="column-5">
            <a href="#"><i class="material-icons" style="float: right; margin-right: 20px; margin-top: 27px; color: #e07047">assessment</i></a>
        </div>
    </div>

    <div class="tab-mid-container">
        <a href="#" class="upload-file upload">Upload file</a>
        <a href="#" class="upload-icon upload"><i class="material-icons">system_update_alt</i></a>
        <button class="btn-new-shipment"><i class="material-icons" style="font-size: 14px; font-weight: bold;">add</i> New shipment</button>
    </div>
    <div class="detail-container">
        <div class="status-tab">
            <div id="active-tab" class="order-placed">
                1 <a href="#" id="a-active">Order placed</a>
                <p>{$get_order_by_id['createdAt']|date_format:"%m/%m/%Y"}</p>
            </div>
            <div class="sent-with">
                2 <a href="#">Sent with</a>
                <p>{$get_order_by_id['deliveryType']}</p>
            </div>
            <div class="delivery-in-progress">
                3 <a href="#">Delivery in progress</a>
                <p>{$get_order_by_id['pickupDate']|date_format:"%m/%m/%Y"}</p>
            </div>
            <div class="delivered">
                4 <a href="#">Delivered</a>
                <p>{$get_order_by_id['dropoff']['country']}</p>
            </div>
        </div>
        <div class="image-map">
            <div class="product-image">
                <img src="{$get_order_by_id['commodities'][0]['images'][0]}" alt=""">
            </div>
            <div class="order-map" id="map"></div>
            <input type="hidden" id="pickup_lat" value="{$get_order_by_id['pickup']['location'][1]}">
            <input type="hidden" id="pickup_lng" value="{$get_order_by_id['pickup']['location'][0]}">

            <input type="hidden" id="dropoff_lat" value="{$get_order_by_id['dropoff']['location'][1]}">
            <input type="hidden" id="dropoff_lng" value="{$get_order_by_id['dropoff']['location'][0]}">
        </div>
        <div class="product">
            <div class="product-name">
                <p>{$get_order_by_id['commodities'][0]['name']}</p>
                <p>{$get_order_by_id['commodities'][0]['quantity']}</p>
                <p>Order number: {$get_order_by_id['orderNumber']}</p>
            </div>
            <div class="information">
                <p>Your delivery information</p>
                <a href="#">Change</a>
            </div>
            <div class="change-address">
                <p>Won't be home?</p>
                <a href="#">Change</a>
            </div>
        </div>
        <div class="tracking-detail">
            <div class="order-number">
                Tracking number: {$get_order_by_id['orderNumber']}
            </div>
            <div class="time-slot">
                <p>{$get_order_by_id['pickupDate']|date_format:"%m/%m/%Y"}</p>
            </div>
            <div class="contact">
                <p>{$get_order_by_id['contact']['name']}</p>
                <p>{$get_order_by_id['contact']['number']}</p>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXXUe1UPwcYKHx8L3drP_vJks8zl9kla4&libraries=places&callback=initMap" type="text/javascript"></script>