<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Pembayaran</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="form-group" id="total_payment">
                        <label class="control-label">Total Harga</label><br>
                        <span class="text-danger bold" style="font-size: 26px" id="grand_total">Rp. 0</span>
                        <input type="hidden" name="grand_total" class="form-control" value="0">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" id="down_payment">
                        <label class="control-label">Down Payment</label>
                        <input type="text" name="down_payment" class="form-control autonumeric" value="">
                        <div class="help-block"></div>
                        <div id="down_payment_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" id="total_payment">
                        <label class="control-label">Total Bayar</label>
                        <input type="text" name="total_payment" class="form-control autonumeric" value="">
                        <div class="help-block"></div>
                        <div id="total_payment_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" id="payment_method">
                        <label class="control-label">Metode Pembayaran</label>
                        <input type="text" name="payment_method" class="form-control" value="">
                        <div class="help-block"></div>
                        <div id="payment_method_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" id="payment_status">
                        <label class="control-label">Status Pembayaran</label>
                        <input type="text" name="payment_status" class="form-control" value="">
                        <div class="help-block"></div>
                        <div id="payment_status_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
