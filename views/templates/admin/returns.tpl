<div class="container-header">
    <a href="#" style="text-decoration: none; "><h1 style="color: #e07047; float: left; padding-left: 30px;">Frank</h1></a>
    <a href="{$shipping}" class="shipping-link active">Shipping</a>
    <a href="{$returns}" class="returns-link active">Returns</a>

    <a href=""><i class="material-icons" style="float: right; margin-right: 30px; margin-top: 27px; color: #e07047">settings</i></a>
    <a href=""><i class="material-icons" style="float: right; margin-right: 20px; margin-top: 27px; color: #e07047">assessment</i></a>
</div>

<div class="tab-container">
    <button style="float: left" class="btn-search"><i class="material-icons" id="material-icon">search</i></button>
    <input type="text" placeholder="name, tracking number, address.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'name, tracking number, address..'" class="input-search">

    <a href="" class="upload-file">Upload file</a>
    <a href="" class="upload-icon"><i class="material-icons">system_update_alt</i></a>

    <button class="btn-new-shipment"><i class="material-icons" style="font-size: 14px; font-weight: bold;">add</i> New shipment</button>

    <div class="tabs">
        <div class="buttonContainer">
            <button id="tab-btn1">Pending</button>
            <button id="tab-btn2">Shipped</button>
            <button id="tab-btn3">Cancelled</button>
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
                <tbody>
                {foreach $api_franks as $api_frank}
                    {if $api_frank['status'] === 'pending'}
                        <tr>
                            <td scope="col">{$api_frank['orderNumber']}</td>
                            <td scope="col">{$api_frank['contact']['name']}</td>
                            <td scope="col">{$api_frank['transporter']['firstName']}</td>
                            <td scope="col">{$api_frank['pickupDate']|date_format:"%m/%m/%Y"}</td>
                            <td scope="col">Status</td>
                            <td scope="col"><a href="#"><i class="material-icons" style="font-size: 20px">create</i></a></td>
                        </tr>
                    {/if}
                {/foreach}
                </tbody>
            </table>
        </div>
        <div class="tabPanel">Shipped</div>
        <div class="tabPanel">Cancelled</div>
        <button class="btn-support"><i class="material-icons" style="font-size: 11px;">help_outline</i> Support</button>
    </div>
</div>