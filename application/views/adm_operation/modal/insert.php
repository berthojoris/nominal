<div class="modal fade" id="add_form_relokasi">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
                <?php
                $attributes = array('role' => 'form', 'id' => 'form_add', 'method' => 'POST');
                echo form_open_multipart('adm_operation/saverelokasi', $attributes);
                ?>
                <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Relokasi</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="form_type" name="form_type" value="CREATE">
                    <input type="hidden" id="kode_jarkom" name="kode_jarkom" value="">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP Address / Network ID</label>
                                <div class="col-sm-7">
                                    <select id="id_jarkom" name="id_jarkom" required></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">No.SPK</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="no_spk" id="no_spk" required readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">SPK Serial No.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="no_serial_spk" id="no_serial_spk" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Reason</label>
                                <div class="col-sm-7">
                                    <textarea name="reason" id="reason" class="form-control input-sm" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Type</label>
                                <div class="col-sm-7">
                                    <select id="type" name="type" class="form-control input-sm">
                                        <option value="RELOKASI">Relokasi</option>
                                        <option value="RELAYOUT">Relayout</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Status</label>
                                <div class="col-sm-7">
                                    <select id="status" name="status" class="form-control input-sm">
                                        <option value="Draft">Draft</option>
                                        <option value="Pending Approval">Pending Approval</option>
                                        <option value="in Progress">in Progress</option>
                                        <option value="Done">Done</option>
                                        <option value="Cancel">Cancel</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Req Doc File</label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control input-sm"  name="file_upload_1" id="rec_doc_file">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Rec Doc No.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="req_doc_no" id="req_doc_no" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Work Order File</label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control input-sm"  name="file_upload_2" id="work_order_file">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Work Order No.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="work_order_no" id="work_order_no" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Persons In Charge</label>
                                <div class="col-sm-7">
                                    <input type="text" autocomplete="off" class="form-control input-sm" name="pic" id="pic" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Live Target</label>
                                <div class="col-sm-7">
                                    <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="live_target" autocomplete="off" id="live_target" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Network Type</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="network_type_old" id="network_type_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Network ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="network_id_old" id="network_id_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP LAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="ip_lan_old" id="ip_lan_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP WAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="ip_wan_old" id="ip_wan_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Name</label>
                                <div class="col-sm-7">
                                    <input type="hidden" class="form-control input-sm" name="id_remote_old" id="id_remote_old">
                                    <input type="text" class="form-control input-sm" name="remote_name_old" id="remote_name_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Type</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="remote_type_old" id="remote_type_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Region</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="region_old" id="region_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Address</label>
                                <div class="col-sm-7">
                                    <textarea name="remote_address_old" id="remote_address_old" class="form-control input-sm" rows="3" required readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Network Type</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="network_type_new" id="network_type_new" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Network ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="network_id_new" id="network_id_new" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP LAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="ip_lan_new" id="ip_lan_new" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP WAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="ip_wan_new" id="ip_wan_new" required>
                                </div>
                            </div>
                            <div class="form-group row" id="remotePanel">
                                <label class="col-sm-5 col-form-label">Remote Name</label>
                                <div class="col-sm-7">
                                    <select id="remote_name_new" name="remote_name_new" required></select>
                                    <input type="hidden" name="remote_name_new_val" id="remote_name_new_val">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Type</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="remote_type_new" id="remote_type_new" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Region</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="region_new" id="region_new" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Address</label>
                                <div class="col-sm-7">
                                    <textarea name="remote_address_new" id="remote_address_new" class="form-control input-sm" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>