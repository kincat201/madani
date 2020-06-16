<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Pesanan</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="is_design">
                            <label class="control-label">Design Tersedia</label>
                            <select class="form-control" name="is_design">
                                @foreach(\App\Util\Constant::COMMON_YESNO_LABEL_LIST as $key => $val)
                                    <option value="{{ $key }}" {{ @$model->$keyField == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <div class="help-block"></div>
                            <div id="is_design_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="deadline">
                            <label class="control-label required-form">Deadline</label>
                            <input type="text" name="deadline" class="form-control datepickerinput" maxlength="" value="" placeholder="Deadline">
                            <div class="help-block"></div>
                            <div id="deadline_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="design_fee">
                            <label class="control-label">Harga Design</label>
                            <input type="text" name="design_fee" onchange="calculate()" class="form-control autonumeric" value="" placeholder="Harga Design jika ada">
                            <div class="help-block"></div>
                            <div id="design_fee_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="finishing_fee">
                            <label class="control-label">Harga Finishing</label>
                            <input type="text" name="finishing_fee" onchange="calculate()" class="form-control autonumeric" value="" placeholder="Harga Finishing jika ada">
                            <div class="help-block"></div>
                            <div id="finishing_fee_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
