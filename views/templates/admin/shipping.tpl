<div class="container-header">
    <a href="#" style="text-decoration: none; "><h1 style="color: #e07047; float: left; padding-left: 30px;">Frank</h1></a>
    <a href="{$shipping}" class="shipping-link active">Shipping</a>
    <a href="{$returns}" class="returns-link">Returns</a>

    <a href="#"><i class="material-icons" id="settings" style="float: right; margin-right: 30px; margin-top: 27px; color: #e07047">settings</i></a>
    <a href="#"><i class="material-icons" style="float: right; margin-right: 20px; margin-top: 27px; color: #e07047">assessment</i></a>
</div>

<div class="tab-container tab-container-new-shipment-toggle" id="tab-container-new-shipment-toggle-id">
    <button style="float: left" class="btn-search"><i class="material-icons" id="material-icon">search</i></button>
    <input type="text" id="txt-search" placeholder="name, tracking number, address.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'name, tracking number, address..'" class="input-search">

    <a href="#" class="upload-file upload">Upload file</a>
    <a href="#" class="upload-icon upload"><i class="material-icons">system_update_alt</i></a>

    <button class="btn-new-shipment"><i class="material-icons" style="font-size: 14px; font-weight: bold;">add</i> New shipment</button>

    <div class="tabs">
        <div class="buttonContainer">
            <button id="tab-btn1">Pending</button>
            <button id="tab-btn2">Shipped</button>
            <button id="tab-btn3">Cancelled</button>
        </div>
        <div  id="main" class="main-tab main-tab-active">
            <div class="tabPanel">
                <table class="tabPanelTable">
                    <thead>
                    <tr>
                        <th scope="col">Tracking number</th>
                        <th scope="col">Recipients</th>
                        <th scope="col">Transporters</th>
                        <th scope="col">Delivery dates</th>
                        <th scope="col">Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="search-pending">
                    {foreach $api_franks as $api_frank}
                        {if $api_frank['status'] === 'pending'}
                            <tr>
                                <td scope="col">{$api_frank['orderNumber']}</td>
                                <td scope="col">{$api_frank['contact']['name']}</td>
                                <td scope="col">{$api_frank['transporter']['firstName']}</td>
                                <td scope="col">{$api_frank['pickupDate']|date_format:"%m/%d/%Y"}</td>
                                <td scope="col">{$api_frank['dropoff']['country']}</td>
                                <td scope="col"><a href="{$orderDetails}" data-target="detail" data-id="{$api_frank['_id']}" class="pencil"><i class="material-icons" style="font-size: 20px">create</i></a></td>
                            </tr>
                        {/if}
                    {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="tabPanel">
                <table class="tabPanelTable">
                    <thead>
                    <tr>
                        <th scope="col">Tracking number</th>
                        <th scope="col">Recipients</th>
                        <th scope="col">Transporters</th>
                        <th scope="col">Delivery dates</th>
                        <th scope="col">Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="search-shipped">
                    {foreach $api_franks as $api_frank}
                        {if $api_frank['status'] === 'delivered'}
                            <tr>
                                <td scope="col">{$api_frank['orderNumber']}</td>
                                <td scope="col">{$api_frank['contact']['name']}</td>
                                <td scope="col">{$api_frank['transporter']['firstName']}</td>
                                <td scope="col">{$api_frank['pickupDate']|date_format:"%m/%m/%Y"}</td>
                                <td scope="col">{$api_frank['dropoff']['country']}</td>
                                <td scope="col"><a href="#"><i class="material-icons" style="font-size: 20px">create</i></a></td>
                            </tr>
                        {/if}
                    {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="tabPanel">
                <table class="tabPanelTable">
                    <thead>
                    <tr>
                        <th scope="col">Tracking number</th>
                        <th scope="col">Recipients</th>
                        <th scope="col">Transporters</th>
                        <th scope="col">Delivery dates</th>
                        <th scope="col">Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="search-cancelled">
                    {foreach $api_franks as $api_frank}
                        {if $api_frank['status'] === 'cancelled'}
                            <tr>
                                <td scope="col">{$api_frank['orderNumber']}</td>
                                <td scope="col">{$api_frank['contact']['name']}</td>
                                <td scope="col">{$api_frank['transporter']['firstName']}</td>
                                <td scope="col">{$api_frank['pickupDate']|date_format:"%m/%m/%Y"}</td>
                                <td scope="col">{$api_frank['dropoff']['country']}</td>
                                <td scope="col"><a href="#"><i class="material-icons" style="font-size: 20px">create</i></a></td>
                            </tr>
                        {/if}
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>

{*        <div  id="detail" style="margin-top: 30px" class="main-tab">*}
{*            {foreach $api_franks as $api_frank}*}
{*                {if $api_frank['_id'] == $pencil_id}*}
{*                    <ul class="wizard">*}
{*                        <li><a href="#">1 Order placed {$api_frank['createdAt']|date_format:"%m/%m/%Y"}</a></li>*}
{*                        <li><a href="#">2 Sent with</a></li>*}
{*                        <li><a href="#">3 Delivery in progress</a></li>*}
{*                        <li><a href="#">4 Delivered {$api_frank['dropoff']['country']}</a></li>*}
{*                    </ul>*}

{*                    <div class="column">*}
{*                        <div class="commodities_image">*}
{*                            <img src="{$api_frank['commodities'][0]['images'][0]}" alt="">*}
{*                        </div>*}

{*                        <div class="commodities_name">*}
{*                            <p>{$api_frank['commodities'][0]['name']}</p>*}
{*                            <p>Quantity: {$api_frank['commodities'][0]['quantity']}</p>*}
{*                            <hr>*}
{*                            <p>Order number: {$api_frank['orderNumber']}</p>*}
{*                            <div class="tracking_number">*}
{*                                <p>Tracking number: {$api_frank['orderNumber']}</p>*}
{*                            </div>*}
{*                        </div>*}
{*                    </div>*}

{*                    <input type="hidden" id="pickup-lat" value="{$api_frank['pickup']['location'][1]}">*}
{*                    <input type="hidden" id="pickup-lng" value="{$api_frank['pickup']['location'][0]}">*}
{*                    <input type="hidden" id="dropoff-lat" value="{$api_frank['dropoff']['location'][1]}">*}
{*                    <input type="hidden" id="dropoff-lng" value="{$api_frank['dropoff']['location'][0]}">*}
{*                    <div class="column-map">*}
{*                        <div id="detail-page-map">*}

{*                        </div>*}

{*                        <div class="blow-map-col">*}
{*                            <div class="delivery-information">*}
{*                                <p>Your delivery information</p>*}
{*                                <a href="#">change</a>*}
{*                            </div>*}

{*                            <div class="not-home">*}
{*                                <p>Won't be home</p>*}
{*                                <a href="#">change</a>*}
{*                            </div>*}
{*                        </div>*}
{*                    </div>*}
{*                {/if}*}
{*            {/foreach}*}
{*        </div>*}
        <button class="btn-support"><i class="material-icons" style="font-size: 11px;">help_outline</i> Support</button>
    </div>

    </div>
</div>

<div class="new-shipment-page" id="tab-container-new-shipment-close-id">
    <div class="new-shipment-box">
        <button style="float: right; margin-right: 25px; margin-top: 25px; color: #e07047; border: unset; background-color: white; font-size: 30px; " class="new-shipment-cancel-btn">X</button>
        <p style="padding: 20px 10px 10px 20px; font-weight: bold; color: #e07047;">Create a shipping</p>
        <form action="" method="post">
            <label for="order number" style="padding: 10px 10px 0 22px; color: #e07047; font-weight: bold;">Order number</label>
            <br>
            <input type="text" name="orderNumber" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 285px;">
            <p style="padding: 0 10px 0 20px; font-weight: bold; color: #e07047; margin-top: 4px;">Item information</p>
            <label for="item name" style="padding-left: 25px; color: #9d9d9d; font-weight: bold;">Item name</label>
            <label for="quantity" style="padding-left: 250px; color: #9d9d9d; font-weight: bold;">Quantity</label>
            <br>
            <input type="text" name="item_name" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 290px">

            <input type="text" name="quantity" style=" margin: 10px 10px 10px 10px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 290px">

            <br>
            <p style="padding: 0 10px 0 20px; font-weight: bold; color: #e07047; margin-top: 4px;">Package dimensions</p>
            <label for="width" style="padding-left: 25px; color: #9d9d9d; font-weight: bold;">Width</label>
            <label for="height" style="padding-left: 120px; color: #9d9d9d; font-weight: bold;">height</label>
            <label for="depth" style="padding-left: 120px; color: #9d9d9d; font-weight: bold;">Depth</label>
            <label for="weight" style="padding-left: 120px; color: #9d9d9d; font-weight: bold;">Weight</label>
            <br>
            <input type="text" name="width" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 0 0 9px; height: 24px; width: 100px">
            <button style="height: 31px; margin-left: -15px; border-radius: 0 9px 9px 0; border: 2px solid #dee3e8;">cm</button>

            <input type="text" name="height" style=" margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 0 0 9px; height: 24px; width: 100px">
            <button style="height: 31px; margin-left: -15px; border-radius: 0 9px 9px 0; border: 2px solid #dee3e8;">cm</button>

            <input type="text" name="depth" style=" margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 0 0 9px; height: 24px; width: 100px">
            <button style="height: 31px; margin-left: -15px; border-radius: 0 9px 9px 0; border: 2px solid #dee3e8;">cm</button>

            <input type="text" name="weight" style=" margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 0 0 9px; height: 24px; width: 100px">
            <button style="height: 31px; margin-left: -16px; border-radius: 0 9px 9px 0; border: 2px solid #dee3e8;">kg</button>

            <br><br>
            <p style="padding: 0 10px 0 20px; font-weight: bold; color: #e07047; margin-top: 4px;">Return information</p>
            <input type="checkbox" name="Active" value="1" id="return-checkbox" style="margin-left: 20px;">
            <label style="color: #9d9d9d; ">Can return</label>
            <br>
            <input type="number" id="can-return-input" name="can_return_input" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 290px; display: none">
            <br>
            <p style="padding: 0 10px 0 20px; font-weight: bold; color: #e07047; margin-top: 4px;">Contact information</p>

            <label for="full name" style="padding-left: 25px; color: #9d9d9d; font-weight: bold;">Full name</label>
            <label for="phone number" style="padding-left: 178px; color: #9d9d9d; font-weight: bold;">Phone number</label>
            <label for="email" style="padding-left: 150px; color: #9d9d9d; font-weight: bold;">Email</label>
            <br>
            <input type="text" name="full_name" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 200px">
            <input type="text" name="phone_number" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 200px">
            <input type="text" name="email_address" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 200px">
            <br>
            <label for="order number" style="padding-left: 25px; color: #9d9d9d; font-weight: bold;">Pickup date</label>
            <br>
            <input type="date" name="pickup_date" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 200px">
            <p style="padding: 0 10px 0 20px; font-weight: bold; color: #e07047; margin-top: 4px;">Delivery method</p>

            <input type="radio" name="delivery_type" id="flex" value="flex" style="margin-left: 20px;">
            <label style="color: #9d9d9d; ">Flex</label>
            <input type="radio" name="delivery_type" value="standard" id="standard" style="margin-left: 20px">
            <label style="color: #9d9d9d; ">Standard</label>
            <input type="radio" name="delivery_type" value="green" id="green" style="margin-left: 20px">
            <label style="color: #9d9d9d; ">Green</label>

            <br><br>
            <label for="dropoff_address" style="padding: 10px 10px 0 22px; color: #e07047; font-weight: bold;">Dropoff address</label>
            <br>
            <input type="text" name="dropoff_address" id="dropoff_address"  style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 250px">
            <input type="hidden" name="new-shipment-lat" id="new-shipment-lat">
            <input type="hidden" name="new-shipment-lng" id="new-shipment-lng">

            <input type="hidden" name="new-shipment-city" id="new-shipment-city">
            <input type="hidden" name="new-shipment-state" id="new-shipment-state">
            <input type="hidden" name="new-shipment-country" id="new-shipment-country">
            <input type="hidden" name="new-shipment-zip" id="new-shipment-zip">
            <br>
            <label for="pickup_address" style="padding: 10px 10px 0 22px; color: #e07047; font-weight: bold;">Pickup address</label>
            <label for="return_address" style="padding: 10px 10px 0 250px; color: #e07047; font-weight: bold;">Return address</label>
            <br>
            <select name="pickup_address" style="margin: 10px 10px 10px 20px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 322px">
                {foreach $api_warehouses as $api_warehouse}
                    <option>{$api_warehouse['name']}</option>
                {/foreach}
            </select>
            <select name="return_address" style="margin: 10px 10px 10px 23px; border: 2px solid #dee3e8; border-radius: 9px 9px 9px 9px; height: 24px; width: 322px">
                {foreach $api_warehouses as $api_warehouse}
                    <option>{$api_warehouse['name']}</option>
                {/foreach}
            </select>
            <br>

            <button type="submit" name="create_new_shipping" style="float: right; margin-right: 30px; border-radius: 25px; padding: 10px 60px 10px 60px; border: 3px solid #e07047; background-color: white; color: #e07047; font-weight: bold">Create</button>
        </form>
    </div>
</div>

<div class="contact-detail" id="contact-detail-id">
    <div class="row">
        <div class="col-1-account col-1-active" id="col-1-account-id">
            <div class="contact-details-box">
                <p>Contact detail</p>
                <form id="contact-detail-form" action="" method="post">
                    <label for="" style="margin-left: 22px">Contact person</label>
                    <label for="" style="margin-left: 96px">Phone</label>
                    <label for="" style="margin-left: 144px">Language</label>
                    <br>
                    <input type="text" name="contact_person" class="update-contact-detail">
                    <input type="text" name="phone" class="update-contact-detail">
                    <input type="text" name="language" class="update-contact-detail">

                    <button class="btn-contact-save" name="btn_contact_save" type="submit">Save</button>
                </form>
            </div>
            <div class="email-address-box">
                <p>Email address</p>

                <label for="" style="margin-left: 22px">Email</label>
                <label for="" style="margin-left: 240px">Role</label>
                <label for="" style="margin-left: 45px">Company</label>
                <label for="" style="margin-left: 110px">Status</label>
                <br>

                {foreach $api_email_addresses as $api_email_address}
                    <form action="" method="post" class="form-email-verification">
                        <input type="text" name="verification_email" value="{$api_email_address['email']}" style="width: 245px; color: #9d9d9d;">
                        <input type="text" name="verification_role" value="{$api_email_address['role']}" style="width: 40px; color: #9d9d9d;">
                        <input type="text" disabled aria-multiline="true" value="--" style="width: 140px; color: #9d9d9d;">
                        <input type="text" disabled value="{($api_email_address['verified']) ? 'Verified' : 'Unverified'}" style="width: 60px; color: #9d9d9d;">
                        <button type="submit" name="btn_resend_verification" class="btn-resend-verification">Resend verification</button>
                    </form>
                {/foreach}


                <form action="" method="post">
                    <label for="add_new_email_address" style="margin-left: 22px">Add new email address</label>
                    <label for="add_new_role" style="margin-left: 186px">Add new role</label>
                    <br>
                    <input type="email" name="add_new_email_address" value="" style="width: 300px; color: #9d9d9d; border: 1px solid #9d9d9d; height: 25px; border-radius: 9px 9px 9px 9px;">
                    <input type="text" name="add_new_role" value="" style="width: 300px; color: #9d9d9d; border: 1px solid #9d9d9d; height: 25px; border-radius: 9px 9px 9px 9px;">
                    <button type="submit" class="btn-add" name="update_email_address">Add</button>
                </form>
            </div>
            <div class="password-box">
                <p>Change password</p>

                <form action="" method="post">
                    <label for="" style="margin-left: 22px">Current password</label>
                    <label for="" style="margin-left: 74px">New password</label>
                    <label for="" style="margin-left: 91px">Confirm password</label>
                    <br>
                    <input type="password" name="current_password">
                    <input type="password" name="new_password">
                    <input type="password" name="confirm_password">

                    <button type="submit" name="change_password" class="btn-contact-save">Save</button>
                </form>
            </div>
            <div class="delete-account-box">
                <p>Delete account</p>
                <div style="float: left; margin-top: 5px;">
                    <span class="material-icons" style="color: #e07047; margin-left: 17px; margin-top: 1px;">info</span>
                </div>
                <div style="float: left;">
                    <p style="color: #9d9d9d; padding-left: 6px; padding-top: 0; ">
                        Once you request your account to be deleted you have until November 29. 2020 to keep this account
                    </p>
                </div>

                <div style="width: 500px; float: left">
                    <p style="margin-left: 25px; padding-top: 0; padding-left: 0; color: #9d9d9d;">Please note:</p>
                    <ul style="margin-left: 25px; color: #9d9d9d;  padding-top: 0; font-weight: bold;">
                        <li>You will not be able to create shipping anymore</li>
                        <li>All you account data will be permanently removed in 6 months</li>
                        <li>We recommend you to export you data before deleting this account</li>
                    </ul>
                </div>
                <form action="" method="post">
                    <div style="float: left; width: 300px; margin-top: 35px;">
                        <button type="submit" name="btn_delete_account" class="btn-delete-account" style="">Delete account</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="col-1-invoice-id" class="col-1-invoice">
            <div class="billing-information">
                <p style="color: #e07047; padding: 20px 0 0 20px; font-weight: bold;">Billing information</p>
                <div class="credit-card">
                    <p style="margin-left: 10px; margin-top: 10px; float: left">This account is billed to a Visa card ending in 0123</p>
                    <form action="">
                        <button class="remove-credit-card-btn">Remove credit card</button>
                    </form>
                    <form action="">
                        <button class="change-credit-card-btn">Change credit card</button>
                    </form>

                </div>
            </div>
            <div class="invoices">
                <div>
                    <p style="color: #e07047; padding: 20px 0 0 20px; font-weight: bold; float: left;">Invoices</p>
                    <i class="material-icons" style="font-size: 30px; color: #e07047; float: left; padding-top: 32px; padding-left: 620px; ">system_update_alt</i>
                    <p style="color: #e07047; padding: 30px 0 0 10px; font-weight: bold; float: left;">Download all</p>
                </div>
                <table class="invoices-table">
                    <tbody class="invoices-tbody">
                    <tr>
                        <td scope="col">January 2021</td>
                        <td scope="col" style="padding-left: 400px;">$ 670.08</td>
                        <td scope="col" style="padding-left: 180px;">Paid</td>
                        <td scope="col" style="padding-left: 20px;"><a href="#"><i class="material-icons" style="font-size: 15px; color: grey;">system_update_alt</i></a></td>
                    </tr>
                    <tr>
                        <td scope="col">January 2021</td>
                        <td scope="col" style="padding-left: 400px;">$ 670.08</td>
                        <td scope="col" style="padding-left: 180px;">Paid</td>
                        <td scope="col" style="padding-left: 20px;"><a href="#"><i class="material-icons" style="font-size: 15px; color: grey;">system_update_alt</i></a></td>
                    </tr>
                    <tr>
                        <td scope="col">January 2021</td>
                        <td scope="col" style="padding-left: 400px;">$ 670.08</td>
                        <td scope="col" style="padding-left: 180px;">Paid</td>
                        <td scope="col" style="padding-left: 20px;"><a href="#"><i class="material-icons" style="font-size: 15px; color: grey;">system_update_alt</i></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-1-warehouse" id="col-1-warehouse-id">
            <div class="warehouse">
                <p style="color: #e07047; padding: 20px 0 0 20px; font-weight: bold;">Warehouse</p>

                <form action="" method="post">
                    <label style="padding-left: 19px; color: #e07047; font-weight: bold;" for="">Warehouse name</label>
                    <label style="padding-left: 266px; color: #e07047; font-weight: bold;" for="">Warehouse address</label>
                    <br>
                    <input type="text" class="add-new-warehouse-input" name="warehouse_name">
                    <input type="text" class="add-new-warehouse-input" name="warehouse_address" id="warehouse-address">

{*                    hidden*}
                    <input type="hidden" name="warehouse_lat" id="warehouse-lat">
                    <input type="hidden" name="warehouse_lng" id="warehouse-lng">

                    <input type="hidden" name="warehouse_city" id="warehouse-city">
                    <input type="hidden" name="warehouse_state" id="warehouse-state">
                    <input type="hidden" name="warehouse_country" id="warehouse-country">
                    <input type="hidden" name="warehouse_zip" id="warehouse-zip">

{*                    hidden-end*}

                    <button type="submit" class="add-new-warehouse-btn" name="add_new_warehouse_btn">Add</button>
                </form>
                <p style="color: #e07047; padding: 20px 0 0 20px; font-weight: bold;">Warehouse available</p>
                <div>
                    <table class="warehouse-table">
                        <tbody class="warehouse-tbody">
                        {foreach $api_warehouses as $api_warehouse}
                            <tr>
                                <td scope="col" style="width: 165px;">{$api_warehouse['name']}</td>
                                <td scope="col" style="padding-left: 60px; width: 250px; ">{$api_warehouse['address']}</td>
                                <td scope="col" style="padding-left: 100px;"><a style="text-decoration: none" href="#"><i class="material-icons" style="font-size: 15px; color: grey;">create</i></a></td>
                                <td scope="col" style="padding-left: 20px;"><a href="#"><i class="material-icons" style="font-size: 15px; color: grey;">delete</i></a></td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="account-invoice-warehouse-box">
                <ul>
                    <li style="padding-top: 35px"><a href="#" class="select" id="account">ACCOUNT</a></li>
                    <li><a href="#" id="invoice">INVOICE</a></li>
                    <li><a href="#" id="warehouse">WAREHOUSE</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="upload-csv" class="upload-box upload-container">
    <button style="float: right; margin-right: 25px; margin-top: 25px; color: #e07047; border: unset; background-color: white; font-size: 30px; " class="upload-cancel-btn">X</button>
    <span class="material-icons" style="color: #e07047; margin: 120px 10px 10px 280px; font-size: 50px;">cloud_download</span>
    <p style="margin: 0 0 0 200px; color: #e07047; font-weight: bold; ">Drag and drop your excel file here</p>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file"  style="margin: 10px 0 0 200px; ">
        <input type="submit" name="import_csv_btn" value="Import">
{*        <button type="submit" name="import_csv_btn" style="margin: 10px 0 0 200px; border-radius: 25px; padding: 10px 60px 10px 60px; border: 3px solid #e07047; background-color: white; color: #e07047; font-weight: bold">Download file</button>*}
    </form>
{*    <button type="submit" name="" style="margin: 10px 0 0 200px; border-radius: 25px; padding: 10px 60px 10px 60px; border: 3px solid #e07047; background-color: white; color: #e07047; font-weight: bold">Download file</button>*}
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