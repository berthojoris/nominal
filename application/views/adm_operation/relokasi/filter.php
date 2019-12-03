<div class="panelFilter" id="panelFilter">
    <form action="<?= site_url('relokasi')  ?>" id="filterForm" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">IP WAN</label>
                    <div class="col-sm-9">
                        <input type="text" name="filter_ip_wan" id="filter_ip_wan" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Provider</label>
                    <div class="col-sm-9">
                        <select id="filter_provider" name="filter_provider" class="form-control input-sm"></select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">IP LAN</label>
                    <div class="col-sm-9">
                        <input type="text" name="filter_ip_lan" id="filter_ip_lan" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">WO No.</label>
                    <div class="col-sm-9">
                        <input type="text" name="filter_wo_no" id="filter_wo_no" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Remote Name</label>
                    <div class="col-sm-9">
                        <select id="filter_remote_name" name="filter_remote_name"></select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Req Doc No.</label>
                    <div class="col-sm-9">
                        <input type="text" name="filter_req_doc_no" id="filter_req_doc_no" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select id="filter_status" name="filter_status" class="form-control input-sm">
                            <option value="">- Pilih -</option>
                            <option value="Draft">DRAFT</option>
                            <option value="Pending Approval">PENDING APPROVAL</option>
                            <option value="in Progress">IN PROGRESS</option>
                            <option value="Done">DONE</option>
                            <option value="Cancel">CANCEL</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">PIC In Charge</label>
                    <div class="col-sm-9">
                        <input type="text" name="filter_pic" id="filter_pic" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Order Date</label>
                    <div class="col-sm-9">
                        <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="filter_order_date" id="filter_order_date">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Live Target</label>
                    <div class="col-sm-9">
                        <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="filter_live_target" id="filter_live_target">
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" value="Filter now" class="btn btn-primary">
    </form>
</div>