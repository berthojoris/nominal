<div class="modal fade" id="edit_form_relokasi">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
                <?php
                $attributes = array('role' => 'form', 'id' => 'form_edit', 'method' => 'POST');
                echo form_open_multipart('relokasi/updaterelokasi', $attributes);
                ?>
                <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit New Relokasi</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="form_type" name="form_type" value="UPDATE">
                    <input type="hidden" id="id_relokasi" name="id_relokasi" value="">
                    <input type="hidden" id="edit_key_id_jarkom" name="edit_key_id_jarkom" value="">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row" id="panelIdEdit">
                                <label class="col-sm-5 col-form-label">IP LAN / Network ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_id_jarkom" id="edit_id_jarkom" readonly>
                                    <input type="hidden" name="edit_id_jarkom_val" id="edit_id_jarkom_val">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">No.SPK</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_no_spk" id="edit_no_spk" required readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">SPK Serial No.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_no_serial_spk" id="edit_no_serial_spk" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Reason</label>
                                <div class="col-sm-7">
                                    <textarea name="edit_reason" id="edit_reason" class="form-control input-sm" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Type</label>
                                <div class="col-sm-7">
                                    <select id="edit_type" name="edit_type" class="form-control input-sm">
                                        <option value="RELOKASI">RELOKASI</option>
                                        <option value="RELAYOUT">RELAYOUT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Status</label>
                                <div class="col-sm-7">
                                    <select id="edit_status" name="edit_status" class="form-control input-sm">
                                        <option value="Draft">DRAFT</option>
                                        <option value="Pending Approval">PENDING APPROVAL</option>
                                        <option value="in Progress">IN PROGRESS</option>
                                        <option value="Done">DONE - CLOSED</option>
                                        <option value="Cancel">CANCEL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Req Doc File</label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control input-sm"  name="edit_file_upload_1" id="edit_rec_doc_file">
                                    <input type="hidden" name="valid_edit_reqdocfile" id="valid_edit_reqdocfile" value="">
                                </div>
                                <div class="col-md-12 lblExt">
                                pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 mbReduce">
                                    <div class="alert alert-biru" id="file_req_doc"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Rec Doc No.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_req_doc_no" id="edit_req_doc_no" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Rec Doc Date</label>
                                <div class="col-sm-7">
                                    <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="edit_req_doc_date" id="edit_req_doc_date" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Work Order File</label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control input-sm"  name="edit_file_upload_2" id="edit_work_order_file">
                                    <input type="hidden" name="valid_edit_wofile" id="valid_edit_wofile" value="">
                                </div>
                                <div class="col-md-12 lblExt">
                                pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 mbReduce">
                                    <div class="alert alert-biru" id="file_work_order"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Work Order No.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_work_order_no" id="edit_work_order_no" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Persons In Charge</label>
                                <div class="col-sm-7">
                                    <input type="text" autocomplete="off" class="form-control input-sm" name="edit_pic" id="edit_pic" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Live Target</label>
                                <div class="col-sm-7">
                                    <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="edit_live_target" autocomplete="off" id="edit_live_target" required>
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
                                    <input type="text" class="form-control input-sm" name="edit_network_type_old" id="edit_network_type_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Network ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_network_id_old" id="edit_network_id_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP LAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_ip_lan_old" id="edit_ip_lan_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP WAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_ip_wan_old" id="edit_ip_wan_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row" id="remoteNamePanel">
                                <label class="col-sm-5 col-form-label">Remote Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_remote_name_old" id="edit_remote_name_old" readonly>
                                    <input type="hidden" class="form-control input-sm" name="edit_id_remote_old" id="edit_id_remote_old">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Type</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_remote_type_old" id="edit_remote_type_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Latitude</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_remote_latitude_old" id="edit_remote_latitude_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Longitude</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_remote_longitude_old" id="edit_remote_longitude_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Region</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_region_old" id="edit_region_old" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Address</label>
                                <div class="col-sm-7">
                                    <textarea name="edit_remote_address_old" id="edit_remote_address_old" class="form-control input-sm" rows="3" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Network Type</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_network_type_new" id="edit_network_type_new" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Network ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_network_id_new" id="edit_network_id_new" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP LAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_ip_lan_new" id="edit_ip_lan_new" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">IP WAN</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_ip_wan_new" id="edit_ip_wan_new" required>
                                </div>
                            </div>
                            <div class="form-group row" id="remotePanel">
                                <label class="col-sm-5 col-form-label">Remote Name</label>
                                <div class="col-sm-7">
                                    <select id="edit_remote_name_new" name="edit_remote_name_new"></select>
                                    <input type="hidden" name="edit_id_remote_new" id="edit_id_remote_new">
                                    <input type="hidden" name="edit_remote_name_new_val" id="edit_remote_name_new_val">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Type</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_remote_type_new" id="edit_remote_type_new" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Latitude</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_remote_latitude_new" id="edit_remote_latitude_new" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Longitude</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_remote_longitude_new" id="edit_remote_longitude_new" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Region</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_region_new" id="edit_region_new" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Remote Address</label>
                                <div class="col-sm-7">
                                    <textarea name="edit_remote_address_new" id="edit_remote_address_new" class="form-control input-sm" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Distance</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="edit_distance" id="edit_distance" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Update" class="btn btn-primary" id="updateRelokasi">
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>