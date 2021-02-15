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
    <div class="panel" id="panel-ask">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-1">
                <h3><a href="#" style="text-decoration: none; color: #9f3d48;" id="want-to-apply">Want to apply?</a></h3>
            </div>
            <div class="col-md-1">
                <h3><a href="#" style="text-decoration: none; color: #9f3d48;" id="already-applied">Already applied?</a></h3>
            </div>
        </div>
    </div>

    <div class="panel" id="signup-form">
        <div class="panel-heading">
            <i class="icon icon-cogs"></i> {l s='Settings' mod='frank'}
        </div>
        {*        Main form----------------------------------------------------------------------------------------------------------------------------*}
        <div id="p-body" class="panel-body p-body active">
            <form class="form-horizontal registration-form" method="post" enctype="multipart/form-data">
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

                {*                extended fields*}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="reg-email">Email address</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" placeholder="Email address" name="email">
                    </div>
                </div>

                {*                extended fields*}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" placeholder="Registration password" name="password">
                    </div>
                </div>

                {*                extended fields*}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="confirm-password">Confirm password</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="confirm-password" placeholder="Confirm password" name="confirm_password">
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
                        <select  class="form-control" id="country" name="country">
                            {foreach $countries as $country}
                                <option>{$country['name']}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>

{*                <div class="form-group">*}
{*                    <label class="control-label col-sm-2" for="country">Country</label>*}
{*                    <div class="col-sm-4">*}
{*                        <input type="text" class="form-control" id="country" placeholder="Country" name="country">*}
{*                    </div>*}
{*                </div>*}

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


                {*                extended fields*}
{*                <div class="form-group">*}
{*                    <label class="control-label col-sm-2" for="facebook">Facebook link</label>*}
{*                    <div class="col-sm-4">*}
{*                        <input type="text" class="form-control" id="facebook" placeholder="Facebook link" name="facebook">*}
{*                    </div>*}
{*                </div>*}
{*                *}{*                extended fields*}
{*                <div class="form-group">*}
{*                    <label class="control-label col-sm-2" for="instagram">Instagram link</label>*}
{*                    <div class="col-sm-4">*}
{*                        <input type="text" class="form-control" id="instagram" placeholder="Instagram link" name="instagram">*}
{*                    </div>*}
{*                </div>*}

                {*                extended fields*}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="acceptsReturn">Accept return</label>
                    <div class="col-sm-4">
                        <select  class="form-control" id="acceptsReturn" name="acceptsReturn">
                            <option>{$reg_accept_return}</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                </div>
                {*                extended fields*}

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
    </div>

    <div class="panel" id="signin-form">
        <div class="panel-heading">
            <i class="icon icon-cogs"></i> {l s='Settings' mod='frank'}
        </div>
        <div class="panel-body">
            <form class="form-horizontal signin-form" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email address</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="signin-email" placeholder="Email address" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="signin-password" placeholder="Registration password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password"></label>
                    <div class="col-sm-4">
                        <a href="#" id="forget-password">Forget password</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default btn-singinFrankModule" name="signinFrankModule">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="panel" id="forget-password-panel">
        <div class="panel-heading">
            <i class="icon icon-cogs"></i> {l s='Settings' mod='frank'}
        </div>
        <div class="panel-body">
            <form class="form-horizontal forget-password-form" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email address</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="signin-email" placeholder="Email address" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default btn-forget-password" name="forgetPassword">Submit</button>
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
                        <input id="pac-input" type="text" placeholder="Enter a location">
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
