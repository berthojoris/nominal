<div class="modal fade" id="edit_form_relokasi">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form role="form" id="form_add" action="<?php echo base_url(); ?>index.php/adm_operation/updaterelokasi" method='POST' enctype="multipart/form-data">
                <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit New Relokasi</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="form_type" name="form_type" value="UPDATE">
                    <input type="hidden" id="update_form" name="update_form" value="">
                    <input type="hidden" id="edit_kode_jarkom" name="edit_kode_jarkom" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Network ID / IP Address / Provider</label>
                                    <select id="edit_id_jarkom" name="edit_id_jarkom" required></select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Doc Number</label>
                                    <input type="text" autocomplete="off" class="form-control input-sm" name="edit_doc_number" id="edit_doc_number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No SPK</label>
                                    <input type="text" class="form-control input-sm" name="edit_no_spk" id="edit_no_spk" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>File Upload</label>
                                    <input type="hidden" class="form-control input-sm"  name="edit_file_upload_current" id="edit_file_upload_current">
                                    <input type="file" class="form-control input-sm"  name="edit_file_upload" id="edit_file_upload">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea name="edit_reason" id="edit_reason" class="form-control input-sm" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PIC In Charge</label>
                                    <input type="text" autocomplete="off" class="form-control input-sm" name="edit_pic_in_charge" id="edit_pic_in_charge" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="edit_status" name="edit_status" class="form-control input-sm">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Live Target</label>
                                    <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="edit_live_target" autocomplete="off" id="edit_live_target" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Network Type</label>
                                    <input type="text" class="form-control input-sm" name="edit_network_type" id="edit_network_type" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Network Type</label>
                                    <input type="text" class="form-control input-sm" name="edit_network_type_new" id="edit_network_type_new" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP LAN</label>
                                    <input type="text" class="form-control input-sm" name="edit_ip_lan" id="edit_ip_lan" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP LAN</label>
                                    <input type="text" class="form-control input-sm" name="edit_ip_lan_new" id="edit_ip_lan_new" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP WAN</label>
                                    <input type="text" class="form-control input-sm" name="edit_ip_wan" id="edit_ip_wan" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP WAN</label>
                                    <input type="text" autocomplete="off" class="form-control input-sm" name="edit_ip_wan_new" id="edit_ip_wan_new" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="remotePanelEdit">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Name</label>
                                    <input type="text" class="form-control input-sm" name="edit_remote_name" id="edit_remote_name" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Name</label>
                                    <select id="edit_remote_name_new" name="edit_remote_name_new" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Type</label>
                                    <input type="text" class="form-control input-sm" name="edit_remote_type" id="edit_remote_type" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Type</label>
                                    <input type="text" class="form-control input-sm" name="edit_remote_type_new" id="edit_remote_type_new" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Region</label>
                                    <input type="text" class="form-control input-sm" name="edit_region" id="edit_region" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Region</label>
                                    <input type="text" class="form-control input-sm" name="edit_region_new" id="edit_region_new" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Address</label>
                                    <textarea name="edit_remote_address" id="edit_remote_address" class="form-control input-sm" rows="3" readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Address</label>
                                    <textarea name="edit_remote_address_new" id="edit_remote_address_new" class="form-control input-sm" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>