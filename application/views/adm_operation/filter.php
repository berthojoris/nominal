<div class="panelFilter" id="panelFilter" style="display: none;">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Network ID / IP Address / Provider</label>
                <select id="filter_ip" name="filter_ip"></select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Provider</label>
                <select id="filter_provider" name="filter_provider" class="form-control input-sm"></select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Remote Name</label>
                <select id="filter_remote_name" name="filter_remote_name"></select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Doc Number</label>
                <select id="filter_doc_number" name="filter_doc_number"></select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                    <select id="filter_status" name="filter_status" class="form-control input-sm">
                        <option value="relokasi">Relokasi</option>
                        <option value="upgrade_bw">Upgrade BW</option>
                        <option value="dismantle">Dismantle</option>
                        <option value="psb">PSB</option>
                        <option value="realokasi">Realokasi</option>
                        <option value="reaktifasi">Reaktifasi</option>
                        <option value="baol">Baol</option>
                    </select>
            </div>
        </div>
        <div class="col-md-6" id="panelPic">
            <div class="form-group">
                <label>PIC In Charge</label>
                <select id="filter_pic" name="filter_pic"></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Order Date</label>
                <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="filter_order_date" id="filter_order_date">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Live Target</label>
                <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="filter_live_target" id="filter_live_target">
            </div>
        </div>
        <div class="col-md-12">
            <button type="button" id="searchNow" class="btn btn-primary" style="margin-bottom: 20px;">Filter Now</button>
        </div>
    </div>
</div>