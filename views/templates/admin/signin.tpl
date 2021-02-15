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
            <form class="form-horizontal registration-form" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="isActive">Active</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="isActive" name="isActive" value="{$config['isActive']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="store">Store Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="store-name" name="store" value="{$config['store_name']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="first_name">First Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first-name" placeholder="Enter first name" name="first_name" value="{$config['firstName']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="last_name">Last Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="last-name" placeholder="Enter last name" name="last_name" value="{$config['lastName']}" disabled>
                    </div>
                </div>

                {*                extended fields*}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="reg-email">Email address</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" placeholder="Email address" name="email" value="{$config['email']}" disabled>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="address_1">Address 1</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address-1" placeholder="Enter address 1" name="address_1" value="{$config['address_1']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address_2">Address 2</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address-2" placeholder="Enter address 2" name="address_2" value="{$config['address_2']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address_3">Address 3</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address-3" placeholder="Enter address 3" name="address_3" value="{$config['address_3']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="latitude">Latitude</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{$config['latitude']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="longitude">Longitude</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="longitude" name="longitude" value="{$config['longitude']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="city">City</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="city" placeholder="Enter city" name="city" value="{$config['city']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="postal_code">Postal code</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="postal-code" placeholder="Enter postal code" name="postal_code" value="{$config['zip']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="country">Country</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="country-code" placeholder="Enter postal code" name="country" value="{$config['country']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="country_code">Country code</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="country-code" placeholder="Enter country code" name="country_code" value="{$config['country_code']}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="mobile_number">Mobile Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="mobile-number" placeholder="Enter mobile number" name="mobile_number" value="{$config['mobile']}" disabled>
                    </div>
                </div>


                {*                extended fields*}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="facebook">Facebook link</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="facebook" placeholder="Facebook link" name="facebook" value="{$config['facebook_link']}" disabled>
                    </div>
                </div>
                {*                extended fields*}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="instagram">Instagram link</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="instagram" placeholder="Instagram link" name="instagram" value="{$config['instagram_link']}" disabled>
                    </div>
                </div>

                {*                extended fields*}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="acceptsReturn">Accept return</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="acceptsReturn" name="acceptsReturn" value="{$config['accept_return']}" disabled>
                    </div>
                </div>
                {*                extended fields*}

                <div class="form-group">
                    <label class="control-label col-sm-2" for="number_of_stores">No. of store(s)</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="number-of-stores" placeholder="Enter No. of store(s)" name="number_of_stores" value="{$config['num_of_stores']}" disabled>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>