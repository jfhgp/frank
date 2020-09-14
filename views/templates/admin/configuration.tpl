{*
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
*}
<link href="{$module_dir|escape:'html':'UTF-8'}views/css/back.css" type="text/css" rel="stylesheet" media="all"/>
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
        height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 350px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }
    .pac-container{
        z-index: 9999;
    }
    .modal-body{
        height: 400px;
    }
</style>

<script src="{$module_dir|escape:'html':'UTF-8'}views/js/back.js" type="text/javascript"></script>
<div class="configuration">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon icon-truck"></i> {l s='Frank shipping module' mod='frank'}
        </div>
        <div class="panel-body">
            <img src="{$module_dir|escape:'html':'UTF-8'}logo.png" id="payment-logo" class="pull-right" />

            <p>
                <strong>{l s='Here is my new shipping module!' mod='frank'}</strong><br />
                {l s='Thanks to PrestaShop, now I have a great shipping module.' mod='frank'}<br />
                {l s='I can configure it using the following configuration form.' mod='frank'}
            </p>
            <br />
            <p>
                {l s='This module will boost your sales!' mod='frank'}
            </p>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <i class="icon icon-cogs"></i> {l s='Settings' mod='frank'}
        </div>
{*        Main form----------------------------------------------------------------------------------------------------------------------------*}
        <div id="p-body" class="panel-body p-body active">
            <form class="form-horizontal registration-form" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="first_name">First Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first-name" placeholder="Enter first name" name="first_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="last_name">Last Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="last-name" placeholder="Enter last name" name="last_name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address_1">Address 1</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address-1" placeholder="Enter address 1" name="address_1">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address_2">Address 2</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address-2" placeholder="Enter address 2" name="address_2">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address_3">Address 3</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address-3" placeholder="Enter address 3" name="address_3">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="city">City</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="city" placeholder="Enter city" name="city">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="postal_code">Postal code</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="postal-code" placeholder="Enter postal code" name="postal_code">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="country">Country</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="country" placeholder="Enter country" name="country">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="country_code">Country code</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="country-code" placeholder="Enter country code" name="country_code">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="mobile_number">Mobile Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="mobile-number" placeholder="Enter mobile number" name="mobile_number">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="number_of_stores">No. of store(s)</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="number-of-stores" placeholder="Enter No. of store(s)" name="number_of_stores">
                    </div>
                </div>

{*                Hiddin fields*}
                <input type="hidden" class="latitude-class" id="latitude-id" name="latitude">
                <input type="hidden" class="longitude-class" id="longitude-id" name="longitude">
{*                Hiddin fields off*}

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default btn-submitFrankModule" name="submitFrankModule">Save</button>
                    </div>
                </div>
            </form>
        </div>
{*        Code confirmation form----------------------------------------------------------------------------------------------------------------------------*}
        <div id="confirmation" class="panel-body confirmation">
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="mobile">Mobile</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="smsCode">Code</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="sms-Code" placeholder="Code" name="smsCode">
                    </div>
                </div>

                <input type="hidden" name="con_first_name" id="con-first-name">
                <input type="hidden" name="con_last_name" id="con-last-name">
                <input type="hidden" name="con_address_1" id="con-address-1">
                <input type="hidden" name="con_address_2" id="con-address-2">
                <input type="hidden" name="con_address_3" id="con-address-3">
                <input type="hidden" name="con_city" id="con-city">
                <input type="hidden" name="con_zip_code" id="con-zip-code">
                <input type="hidden" name="con_country" id="con-country">
                <input type="hidden" name="con_country_code" id="con-country-code">
                <input type="hidden" name="con_mobile" id="con-mobile">
                <input type="hidden" name="con_stores" id="con-stores">
                <input type="hidden" name="con_latitude" id="con-latitude">
                <input type="hidden" name="con_longitude" id="con-longitude">

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="submitConfirmation">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
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
