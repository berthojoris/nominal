<div class="panelFilter" id="panelFilter" style="display: none;">
    <form action="<?= site_url('adm_operation/relokasi')  ?>" id="filterForm" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Network ID / IP Address / Provider</label>
                    <input type="text" name="filter_ip" id="filter_ip" class="form-control input-sm">
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
                    <input type="text" name="filter_remote_name" id="filter_remote_name" class="form-control input-sm">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Doc Number</label>
                    <input type="text" name="filter_doc_number" id="filter_doc_number" class="form-control input-sm">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                        <select id="filter_status" name="filter_status" class="form-control input-sm">
                            <option value="">- Pilih -</option>
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
                    <input type="text" name="filter_pic" id="filter_pic" class="form-control input-sm">
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
                <input type="submit" id="searchNow" class="btn btn-primary" style="margin-bottom: 20px;" value="Filter Now">
            </div>
        </div>
    </form>
</div>