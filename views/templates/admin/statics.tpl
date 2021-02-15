
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
            <a href="{$settings}"><i class="material-icons" id="settings" style="color: #9c9c9c;">settings</i></a>
        </div>
        <div class="frank-settings">
            <a href="{$statics}"><i class="material-icons">assessment</i></a>
        </div>
    </div>
    {*    Boxes*}

    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col-sm-3 box-1-2-3" onclick="trigger('lastWeek');">
                <p>Last week</p>
                <p id="last-week"></p>
            </div>

            <div class="col-sm-1"></div>
            <div class="col-sm-3 box-1-2-3" onclick="trigger('lastTwoWeek');">
                <p>Last 2 week</p>
                <p id="last-two-week"></p>
            </div>

            <div class="col-sm-1"></div>
            <div class="col-sm-3 box-1-2-3" onclick="trigger('lastMonth');">
                <p>Last month</p>
                <p id="last-month"></p>
            </div>
        </div>
    </div>
    {*    Boxes End*}
    {*    Single Box*}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-11 single-box">
                <div id="tabs" style="height: 360px">
{*                    <ul>*}
{*                        <li ><a href="#tabs-1" style="font-size: 12px">Spline</a></li>*}
{*                        <li ><a href="#tabs-2"  style="font-size: 12px">Spline Area</a></li>*}
{*                    </ul>*}
                    <div id="tabs-1" style="height: 300px">
                        <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                    </div>
                    <div id="tabs-2" style="height: 300px">
                        <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
    </div>
    {*    Single box end*}
</div>