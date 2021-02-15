<div class="frank">
    <div class="container-header">
        <div class="frank-logo">
            <a href="#">Frank</a>
        </div>
        <div class="frank-shipping">
            <a href="{$shipping}" class="shipping-link" style="color: #9c9c9c;">Shipping</a>
        </div>
        <div class="frank-returns">
            <a href="{$returns}" class="returns-link" style="color: #9c9c9c;">Returns</a>
        </div>
        <div class="frank-chart">
            <a href="{$settings}"><i class="material-icons" id="settings">settings</i></a>
        </div>
        <div class="frank-settings">
            <a href="{$statics}"><i class="material-icons" style="color: #9c9c9c;">assessment</i></a>
        </div>
    </div>
    {*    Account*}

    <div id="ctr-1-account" class="container-fluid container-account ctr-1 ctr-active">
        <div class="row justify-content-around flex-column-reverse flex-xs-row flex-sm-row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 mt-5 pr-4 pb-4">

{*                <div class="container-fluid bg-white pt-4 pb-4 pl-4 container-upload-logo">*}
{*                    <p style="color: #e07047">Upload Logo</p>*}
{*                    <form  class="upload-image-form" method="post" enctype="multipart/form-data">*}
{*                        <div class="row">*}
{*                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">*}
{*                                <label for="">Upload image</label>*}
{*                                <input type="file" name="upload_image" id="upload-image" class="form-control" accept="image/*">*}
{*                            </div>*}

{*                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">*}
{*                                <label for=""class="text-white">Upload image</label>*}
{*                                <button type="submit" class="form-control btn upload-image-btn" name="btn_upload_image" >Save</button>*}
{*                            </div>*}
{*                        </div>*}
{*                    </form>*}

{*                </div>*}

                <div class="container-fluid bg-white pt-4 pb-4 pl-4 container-contact-detail">
                    <p style="color: #e07047">Contact detail</p>
                    <form  class="contact-details-form" method="post">
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <label for="">Contact person</label>
                                <input type="text" name="contact_person" id="contact-person" class="form-control">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <label for="">Phone</label>
                                <input type="text" name="phone" id="contact-phone" class="form-control">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <label for="">Language</label>
                                <input type="text" name="language" id="contact-language" class="form-control">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <label for=""class="text-white">Contact person</label>
                                <button type="submit" class="form-control btn contact-detail-btn" name="btn_contact_save" >Save</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="container-fluid bg-white pt-4 pb-4 pl-4 mt-4 container-email-address">
                    <p style="color: #e07047">Email address</p>
{*                    <div class="email-verification-section"></div>*}
                    {foreach $api_email_addresses as $api_email_address}
                        <form method="post" class="resend-verification-form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="">Email</label>
                                    <input type="text" name="verification_email" value="{$api_email_address['email']}" class="form-control" disabled style="border: unset; background-color: white;">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <label for="">Role</label>
                                    <input type="text" name="verification_role" value="{$api_email_address['role']}" class="form-control" disabled style="border: unset; background-color: white;">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <label for="">Company</label>
                                    <input type="text" name="verification_role" value="" disabled style="border: unset; background-color: white;">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <label for="">Status</label>
                                    <input type="text" name="verification_role" value="" disabled style="border: unset; background-color: white;">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="" class="text-white">Status</label>
                                    <button type="submit" name="btn_resend_verification" class="btn form-control email-address-resend-verification">Resend verification</button>
                                </div>
                            </div>
                        </form>
                    {/foreach}
                    <form method="post" class="update-email-address-form">
                        <div class="row mt-4 pr-4">
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                                <label for="">Add new email address</label>
                                <input type="email" name="add_new_email_address" class="form-control email-css">
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                                <label for="">Add new role</label>
                                <input type="text" name="add_new_role" class="form-control email-css">
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-4">
                                <label for="" class="text-white">Add new role</label>
                                <button type="submit" class="form-control btn mt-4 email-address-add" name="update_email_address">Add</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="container-fluid bg-white pt-4 pb-4 pl-4 mt-4 container-change-password">
                    <p style="color: #e07047">Change password</p>
                    <form method="post" class="change-password-form">
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <label for="">Current password</label>
                                <input type="password" class="form-control" name="current_password">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <label for="">New password</label>
                                <input type="password" class="form-control" name="new_password">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <label for="">Confirm password</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <label for=""class="text-white">Contact person</label>
                                <button type="submit" name="change_password" class="form-control btn contact-change-password">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="container-fluid bg-white pt-4 pb-4 pl-4 mt-4 container-delete-account">
                    <p style="color: #e07047">Delete account</p>
                    <div style="display: flex;">
                        <span class="material-icons" style="color: #e07047;  padding-right: 5px;">info</span>
                        <p style="color: #b1b1b1;" >Once you request your account to be deleted you have until November 29. 2020 to keep this account</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <p style="color: #b1b1b1;" >Please note:</p>
                            <ul>
                                <li style="color: #b1b1b1;" >You will not be able to create shipping anymore</li>
                                <li style="color: #b1b1b1;" >All you account data will be permanently removed in 6 months</li>
                                <li style="color: #b1b1b1;" >We recommend you to export you data before deleting this account</li>
                            </ul>
                        </div>

                        <form method="post" class="delete-account-form">
                            <div class="col-lg-3">
                                <input type="hidden" name="_id">
                                <button type="submit" name="btn_delete_account" class="btn form-control delete-account-btn">Delete account</button>
                            </div>
                        </form>
                    </div>

                </div>


            </div>

            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-4 pt-4 pr-4 pb-4" style="height: 125px;">
                <div class="container-fluid bg-white pt-4 pb-4 setting-menu">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="account">ACCOUNT</a>
                        </div>
                        <div class="col-12">
                            <a href="#" class="invoice">INVOICE</a>
                        </div>
                        <div class="col-12">
                            <a href="#" class="warehouse">WAREHOUSE</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {*    Invoice*}

    <div id="ctr-2-invoice" class="container-fluid ctr-2 ctr-active">
        <div class="row justify-content-around flex-column-reverse flex-xs-row flex-sm-row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 mt-5 pr-4 pb-4">
                <div class="container-fluid bg-white pt-4 pb-4 pl-4 container-invoice">
                    <p style="color: #e07047">Invoice</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-4 pt-4 pr-4 pb-4" style="height: 125px;">
                <div class="container-fluid bg-white pt-4 pb-4 setting-menu">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="account">ACCOUNT</a>
                        </div>
                        <div class="col-12">
                            <a href="#" class="invoice">INVOICE</a>
                        </div>
                        <div class="col-12">
                            <a href="#" class="warehouse">WAREHOUSE</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {*    Warehouse*}

    <div id="ctr-3-warehouse" class="container-fluid ctr-3 ctr-active">
        <div class="row justify-content-around flex-column-reverse flex-xs-row flex-sm-row flex-md-row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 mt-5 pr-4 pb-4">
                <div class="container-fluid bg-white pt-4 pb-4 pl-4 container-warehouse">
                    <p style="color: #e07047">Warehouse</p>
                    <form class="add-warehouse-form" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label for="">Warehouse name</label>
                                <input type="text" id="warehouse-name" name="warehouse_name" class="form-control add-new-warehouse-input" >
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label for="">Warehouse address</label>
                                <input type="text" class="form-control add-new-warehouse-input" name="warehouse_address" id="warehouse-address">

                                {*                    hidden*}
                                <input type="hidden" name="warehouse_lat" id="warehouse-lat">
                                <input type="hidden" name="warehouse_lng" id="warehouse-lng">
                                <input type="hidden" name="warehouse_city" id="warehouse-city">
                                <input type="hidden" name="warehouse_country" id="warehouse-country">
                                <input type="hidden" name="warehouse_id" id="warehouse-id">

                                {*                    hidden-end*}

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label for="" class="text-white">Warehouse</label>
                                <button type="submit" class="form-control btn btn-default add-new-warehouse-btn" name="add_new_warehouse_btn">Save</button>
                            </div>
                        </div>
                    </form>
                    <p class="mt-4" style="color: #e07047">Warehouse available</p>
                    <div class="row">
                        <table class="table warehouse-table">

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-4 pt-4 pr-4 pb-4" style="height: 125px;">
                <div class="container-fluid bg-white pt-4 pb-4 setting-menu">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="account">ACCOUNT</a>
                        </div>
                        <div class="col-12">
                            <a href="#" class="invoice">INVOICE</a>
                        </div>
                        <div class="col-12">
                            <a href="#" class="warehouse">WAREHOUSE</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
