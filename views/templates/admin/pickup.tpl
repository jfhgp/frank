
<div class="panel">
    <div class="panel-heading">
        {l s='Frank orders for pickup' mod='frank'}
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" style="width: auto;">Dropoff Address</th>
                <th scope="col">City</th>
                <th scope="col">Country</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col" style="width: 90px">Created At</th>
                <th scope="col">Pickup Date</th>
                <th scope="col">Ready for pickup</th>
                <th scope="col">Order cancel</th>
            </tr>
            </thead>
            <tbody>
            <div class="status role="alert"></div>
            {foreach from=$api_franks item=$api_frank}
                {usort($api_frank, $api_frank['createdAt'])}
                <tr>
                    <form action="" method="post" class="form-ready-for-pickup">
                        <input type="hidden" name="_id" value="{$api_frank['_id']}"></th>
                        <td>{$api_frank['dropoff']['shortAddress']}</td>
                        <td>{$api_frank['dropoff']['city']}</td>
                        <td>{$api_frank['dropoff']['country']}</td>
{*                        {foreach $api_frank['commodities'] as $commodity}*}
{*                            <td>{$commodity['name']}</td>*}
{*                        {/foreach}*}
                        <td>
                            <ul>
                                {foreach $api_frank['commodities'] as $commodity}
                                    <li>{$commodity['name']}</li>
                                {/foreach}
                            </ul>
                        </td>
{*                        <td>{count(array_column($api_frank['commodities'], 'quantity'))}</td>*}
                        <td>{array_sum(array_column($api_frank['commodities'], 'quantity'))}</td>
                        <td>{$api_frank['createdAt']|date_format}</td>
                        <td>
                            <input type="date" name="pickupDate" id="pickDate" value="{$api_frank['pickupDate']|date_format:"%Y-%m-%d"}" required>
                        </td>
                        <td>
                            {if $api_frank['createdAt'] == $api_frank['updatedAt'] && empty($api_frank['timeLogs']['cancelled'])}
                                <button type="submit" class="btn btn-success">Ready for pickup</button>
                            {elseif $api_frank['createdAt'] != $api_frank['updatedAt'] && empty($api_frank['timeLogs']['cancelled'])}
                                <button type="submit" class="btn btn-danger">Ready for pickup</button>
                            {/if}
                        </td>
                    </form>
                    <form class="order-cancel">
                        <input type="hidden" name="_id" value="{$api_frank['_id']}">
                        {if empty($api_frank['timeLogs']['cancelled'])}
                            <td><button type="submit" class="btn btn-danger">Cancel order</button></td>
                        {/if}
                    </form>
                </tr>
            {/foreach}
            </tbody>
        </table>
        <br>
    </div>
</div>
