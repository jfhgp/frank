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
            <a href="#"><i class="material-icons" id="settings">settings</i></a>
        </div>
        <div class="frank-settings">
            <a href="#"><i class="material-icons">assessment</i></a>
        </div>
    </div>
    <div class="container-fluid ctr">
        <div class="row">
            <div class="col-sm-11">
                <p>Create a shipping</p>
            </div>
            <div class="col-sm-1">
                <p>X</p>
            </div>
        </div>
        <br>
        <form method="post">
            <div class="row">
                <div class="col-sm-4">
                    <label for="" style="color: #e07047; ">Order number</label>
                    <input type="text">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <p>Item information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Item name</label>
                    <input type="text">
                </div>
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Quantity</label>
                    <input type="text">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                   <p>Package dimension</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 ">
                    <label for="" style="color: #9d9d9d;">Width</label>
                    <div class="input-container">
                        <input class="input-field" type="text">
                        <i class="icon">cm</i>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="" style="color: #9d9d9d;">Height</label>
                    <div class="input-container">
                        <input class="input-field" type="text">
                        <i class="icon">cm</i>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="" style="color: #9d9d9d;">Depth</label>
                    <div class="input-container">
                        <input class="input-field" type="text">
                        <i class="icon">cm</i>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="" style="color: #9d9d9d;">Weight</label>
                    <div class="input-container">
                        <input class="input-field" type="text">
                        <i class="icon">kg</i>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <p>Return information</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <input type="checkbox">
                    <label for="" style="color: #9d9d9d;">Can return</label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <p>Contact information</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Full name</label>
                    <input type="text">
                </div>
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Phone number</label>
                    <input type="text">
                </div>
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Email</label>
                    <input type="text">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Pickup date</label>
                    <input type="date" style="width: 200px;">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <p>Delivery method</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <input type="radio">
                    <label style="color: #9d9d9d;" for="">Flex</label>
                </div>
                <div class="col-sm-2">
                    <input type="radio">
                    <label for=""  style="color: #9d9d9d;">Standard</label>
                </div>
                <div class="col-sm-2">
                    <input type="radio">
                    <label for="" style="color: #9d9d9d;">Green</label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="" style="color: #9d9d9d;">Dropoff address</label>
                    <input type="text">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <label style="color: #e07047; for="">Dropoff address</label>
                    <input type="text">
                </div>
                <div class="col-sm-6">
                    <label style="color: #e07047; for="">Dropoff address</label>
                    <input type="text">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <input type="button" value="Create" class="create-new-shipment-btn">
                </div>
            </div>
        </form>
    </div>
</div>