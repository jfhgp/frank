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
            <a href="{$statics}"><i class="material-icons">assessment</i></a>
        </div>
    </div>

    <div id="main-page-id" class="container-main-page container-main-page-active">
        <div class="container-fluid">
            <div class="row mt-sm-4 mt-lg-4">
                <div class="col-sm-12 col-lg-2">
                    <div class="input-group">
                        <span class="input-group-addon btn-search" style=" border-radius: 25px 0 0 25px; border: 2px solid #e07047; border-right: unset;"><i id="material-icon" class="fas fa-search" style="color: #e07047;"></i></span>
                        <input type="text" class="input-search" id="txt-search" placeholder="name, tracking number, address.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'name, tracking number, address..'">
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 offset-lg-3 text-lg-right my-class-icons">
                    <a href="{$new_shipment}" class="btn font-weight-bold btn-new-shipment"><i class="fa fa-plus"></i> New Shipment</a>
                </div>
                <div class="col-sm-12 col-lg-3 text-lg-right pr-3 pt-3">
                    <a href="#" style="color: #e07047;" class="upload"><i class="fas fa-upload" style="color: #e07047;"></i> Upload</a>
                </div>
            </div>

            <div class="container-fluid tabs-container">
                <div class="buttonContainer">
                    <button id="tab-btn1">Pending</button>
                    <button id="tab-btn2">In progress</button>
                    <button id="tab-btn3">Shipped</button>
                    <button id="tab-btn4">Cancelled</button>
                </div>
                <div class="main-tab">
                    <div class="tabPanel" style="height: 450px;overflow-y: scroll;">
                        <table class="table tabPanelTable">
                            <thead>
                            <tr>
                                <th class="col-sm-2">Tracking number</th>
                                <th class="col-sm-2">Recipients</th>
                                <th class="col-sm-2">Transporters</th>
                                <th class="col-sm-2 ">Delivery dates</th>
                                <th class="col-sm-2">Status</th>
                                <th class="col-sm-2"></th>
                            </tr>
                            </thead>
                            <tbody id="search-pending">
                            {foreach $api_franks as $api_frank}
                                {if $api_frank['status'] === 'pending'}
                                    <tr>
                                        <td class="col-sm-2">{$api_frank['orderNumber']}</td>
                                        <td class="col-sm-2">{$api_frank['contact']['name']}</td>
                                        <td class="col-sm-2">{$api_frank['transporter']['firstName']}</td>
                                        <td class="col-sm-2">{$api_frank['pickupDate']|date_format:"%m/%d/%Y"}</td>
                                        <td class="col-sm-2">{$api_frank['dropoff']['country']}</td>
                                        <td class="col-sm-2">
                                            <a href="{$orderDetails}" data-target="detail" data-id="{$api_frank['_id']}" class="pencil">
                                                <i class="material-icons" style="font-size: 20px; ">create</i>
                                            </a>
                                        </td>
                                    </tr>
                                {/if}
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <div class="tabPanel" style="height: 450px;overflow-y: scroll;">
                        <table class="table tabPanelTable">
                            <thead>
                            <tr>
                                <th class="col-sm-2">Tracking number</th>
                                <th class="col-sm-2">Recipients</th>
                                <th class="col-sm-2">Transporters</th>
                                <th class="col-sm-2 ">Delivery dates</th>
                                <th class="col-sm-2">Status</th>
                                <th class="col-sm-2"></th>
                            </tr>
                            </thead>
                            <tbody id="search-pending">
                            {foreach $api_franks as $api_frank}
                                {if $api_frank['status'] === 'accepted'}
                                    <tr>
                                        <td class="col-sm-2">{$api_frank['orderNumber']}</td>
                                        <td class="col-sm-2">{$api_frank['contact']['name']}</td>
                                        <td class="col-sm-2">{$api_frank['transporter']['firstName']}</td>
                                        <td class="col-sm-2">{$api_frank['pickupDate']|date_format:"%m/%d/%Y"}</td>
                                        <td class="col-sm-2">{$api_frank['dropoff']['country']}</td>
                                        <td class="col-sm-2">
                                            <a href="{$orderDetails}" data-target="detail" data-id="{$api_frank['_id']}" class="pencil">
                                                <i class="material-icons" style="font-size: 20px; ">create</i>
                                            </a>
                                        </td>
                                    </tr>
                                {/if}
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <div class="tabPanel" style="height: 450px;overflow-y: scroll;">
                        <table class="table tabPanelTable">
                            <thead>
                            <tr>
                                <th class="col-sm-2">Tracking number</th>
                                <th class="col-sm-2">Recipients</th>
                                <th class="col-sm-2">Transporters</th>
                                <th class="col-sm-2 ">Delivery dates</th>
                                <th class="col-sm-2">Status</th>
                                <th class="col-sm-2"></th>
                            </tr>
                            </thead>
                            <tbody id="search-pending">
                            {foreach $api_franks as $api_frank}
                                {if $api_frank['status'] === 'delivered'}
                                    <tr>
                                        <td class="col-sm-2">{$api_frank['orderNumber']}</td>
                                        <td class="col-sm-2">{$api_frank['contact']['name']}</td>
                                        <td class="col-sm-2">{$api_frank['transporter']['firstName']}</td>
                                        <td class="col-sm-2">{$api_frank['pickupDate']|date_format:"%m/%d/%Y"}</td>
                                        <td class="col-sm-2">{$api_frank['dropoff']['country']}</td>
                                        <td class="col-sm-2">
                                            <a href="{$orderDetails}" data-target="detail" data-id="{$api_frank['_id']}" class="pencil">
                                                <i class="material-icons" style="font-size: 20px; ">create</i>
                                            </a>
                                        </td>
                                    </tr>
                                {/if}
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <div class="tabPanel" style="height: 450px;overflow-y: scroll;">
                        <table class="table tabPanelTable">
                            <thead>
                            <tr>
                                <th class="col-sm-2">Tracking number</th>
                                <th class="col-sm-2">Recipients</th>
                                <th class="col-sm-2">Transporters</th>
                                <th class="col-sm-2 ">Delivery dates</th>
                                <th class="col-sm-2">Status</th>
                                <th class="col-sm-2"></th>
                            </tr>
                            </thead>
                            <tbody id="search-pending">
                            {foreach $api_franks as $api_frank}
                                {if $api_frank['status'] === 'cancelled'}
                                    <tr>
                                        <td class="col-sm-2">{$api_frank['orderNumber']}</td>
                                        <td class="col-sm-2">{$api_frank['contact']['name']}</td>
                                        <td class="col-sm-2">{$api_frank['transporter']['firstName']}</td>
                                        <td class="col-sm-2">{$api_frank['pickupDate']|date_format:"%m/%d/%Y"}</td>
                                        <td class="col-sm-2">{$api_frank['dropoff']['country']}</td>
                                        <td class="col-sm-2">
                                            <a href="{$orderDetails}" data-target="detail" data-id="{$api_frank['_id']}" class="pencil">
                                                <i class="material-icons" style="font-size: 20px; ">create</i>
                                            </a>
                                        </td>
                                    </tr>
                                {/if}
                            {/foreach}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="upload-page-id" class="container-upload-page">
        <div class="container-fluid" style="margin-top: 40px;">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6" style=" height: 400px; background-color: white;border-radius: 9px; padding: 30px;">
                    <div class="row">
                        <div class="col-sm-11"></div>
                        <div class="col-sm-1">
                            <button class="upload-cancel-btn" style="background-color: unset; border: unset; color: #e07047; font-size: 25px;">X</button>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 80px;">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 text-center"><span class="material-icons" style="color: #e07047; font-size: 50px;">cloud_download</span></div>
                        <div class="col-sm-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 text-center">
                            <p>Drag and drop your excel file here</p>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6 text-center">
                                <input type="file" name="file">
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" name="import_csv_btn" value="Import">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>

</div>