<div class="panelFilter" id="panelFilter">
    <form action="<?= site_url('adm_operation/relokasi')  ?>" id="filterForm" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>IP WAN</label>
                    <input type="text" name="filter_ip_wan" id="filter_ip_wan" class="form-control input-sm">
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
                    <label>IP LAN</label>
                    <input type="text" name="filter_ip_lan" id="filter_ip_lan" class="form-control input-sm">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>WO No.</label>
                    <input type="text" name="filter_wo_no" id="filter_wo_no" class="form-control input-sm">
                </div>
            </div>
            <div class="col-md-6" id="filterPanelRemoteName">
                <div class="form-group">
                    <label>Remote Name</label>
                    <select id="filter_remote_name" name="filter_remote_name" required></select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Req Doc No.</label>
                    <input type="text" name="filter_req_doc_no" id="filter_req_doc_no" class="form-control input-sm">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                        <select id="filter_status" name="filter_status" class="form-control input-sm">
                            <option value="">- Pilih -</option>
                            <option value="Draft">Draft</option>
                            <option value="Pending Approval">Pending Approval</option>
                            <option value="in Progress">in Progress</option>
                            <option value="Done">Done</option>
                            <option value="Cancel">Cancel</option>
                        </select>
                </div>
            </div>
            <div class="col-md-6">
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
        </div>
    </form>
</div>