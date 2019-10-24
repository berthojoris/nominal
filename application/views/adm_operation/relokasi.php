<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<script src="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>
<style>
.buttonXtra {
    margin: 20px 0px 20px 20px;
}
.modal-dialog {
    width: 900px;
    margin: 30px auto;
}
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 0px;
}
.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 32px;
    user-select: none;
    -webkit-user-select: none;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    display: block;
    padding-left: 0px;
    padding-right: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.table-responsive {
    min-height: .01%;
    overflow-x: hidden;
}
.error {
    color: red;
}
</style>

<section>
    <div style="width:100%;height:38px;" class="panel panel-default">
        <ol class="breadcrumb" style="background: white;">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active" style="color: #3C8DBC;">Relokasi</li>
        </ol>
    </div>
</section>

<section class="content" id="full" style="margin-top: -20px">
    <div class="row">

    <?php if ($this->session->flashdata('notif_success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('notif_success') ?> </div>
    <?php } ?>

    <?php if ($this->session->flashdata('notif_error')) { ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('notif_error') ?> </div>
    <?php } ?>

    <?php 
    function showHide($name) {
        if($name == "default.jpg") {
            return "-";
        } else {
            return anchor(base_url()."index.php/adm_operation/download/".$name, "Download File", "");
        }
    }
    ?>

        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Add SIK</div>
            <div class="buttonXtra">
                <button id="add_form_btn" class="btn btn-primary">Add</button>
                <button id="filter_form_btn" class="btn btn-primary">Filter</button>
            </div>

            <div class="panel-body">
                <div class="box-body table-responsive no-padding">
                    <table id="filter_table_Data" class="table table-bordered table-striped table-hover" id="table_relokasi">
                        <thead>
                            <tr>
                                <th>IP/Network</th>
                                <th>Reason</th>
                                <th>Doc Number</th>
                                <th>File Upload</th>
                                <th>PIC In Charge</th>
                                <th>Live Target</th>
                                <th>IP WAN</th>
                                <th>Remote Name</th>
                                <th>Remote Address</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="filter_modal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" >

            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Filter Data</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <tr>
                                <th>IP Address / Network ID</th>
                                <td>
                                    <select id="filter_ip" name="filter_ip" style="width: 100%;"></select>
                                </td>
                            </tr>
                            <tr>
                                <th>Remote Name</th>
                                <td>
                                    <select id="filter_remote_name" name="filter_remote_name" style="width: 100%;"></select>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <select id="filter_status" name="filter_status" class="form-control input-sm">
                                        <option value="relokasi">Relokasi</option>
                                        <option value="upgrade_bw">Upgrade BW</option>
                                        <option value="dismantle">Dismantle</option>
                                        <option value="psb">PSB</option>
                                        <option value="realokasi">Realokasi</option>
                                        <option value="reaktifasi">Reaktifasi</option>
                                        <option value="baol">Baol</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>
                                    <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="filter_order_date" id="filter_order_date">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <tr>
                                <th>Provider</th>
                                <td>
                                    <select id="filter_provider" name="filter_provider" class="form-control input-sm"></select>
                                </td>
                            </tr>
                            <tr>
                                <th>Doc Number</th>
                                <td>
                                    <select id="filter_doc_number" name="filter_doc_number" style="width: 100%;"></select>
                                </td>
                            </tr>
                            <tr>
                                <th>PIC In Charge</th>
                                <td>
                                    <select id="filter_pic" name="filter_pic" style="width: 100%;"></select>
                                </td>
                            </tr>
                            <tr>
                                <th>Live Target</th>
                                <td>
                                    <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="filter_live_target" id="filter_live_target">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <button type="button" id="searchNow" class="btn btn-primary" style="margin-bottom: 20px;">Search</button>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>IP Address/Network ID</th>
                                    <th>Remote Name</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Provider</th>
                                    <th>Doc Number</th>
                                    <th>PIC In Charge</th>
                                    <th>Live Target</th>                                    
                                </tr>
                            </thead>
                            <tbody id="filter_table_Data"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_form_relokasi">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" >
            <form role="form" id="form_add" action="<?php echo base_url(); ?>index.php/adm_operation/saverelokasi" method='POST' enctype="multipart/form-data">
                <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Relokasi</h4>
                </div>

                <input type="hidden" id="form_type" name="form_type" value="CREATE">
                <input type="hidden" id="id_remote_old" name="id_remote_old" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>IP Address / Network ID</th>
                                    <td>
                                        <select id="id_jarkom" name="id_jarkom" style="width: 100%;"></select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>No SPK</th>
                                    <td><input type="text" class="form-control input-sm" name="no_spk" id="no_spk" readonly></td>
                                </tr>
                                <tr>
                                    <th>Reason</th>
                                    <td><textarea name="reason" id="reason" class="form-control input-sm" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <select id="status" name="status" class="form-control input-sm">
                                            <option value="relokasi">Relokasi</option>
                                            <option value="upgrade_bw">Upgrade BW</option>
                                            <option value="dismantle">Dismantle</option>
                                            <option value="psb">PSB</option>
                                            <option value="realokasi">Realokasi</option>
                                            <option value="reaktifasi">Reaktifasi</option>
                                            <option value="baol">Baol</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6" style="margin-bottom: 55px;">
                            <table class="table table-hover">
                                <tr>
                                    <th>Doc Number</th>
                                    <td><input type="text" autocomplete="off" class="form-control input-sm" name="doc_number" id="doc_number"></td>
                                </tr>
                                <tr>
                                    <th>File Upload</th>
                                    <td><input type="file" class="form-control input-sm"  name="file_upload" id="file_upload"></td>
                                </tr>
                                <tr>
                                    <th>PIC In Charge</th>
                                    <td><input type="text" autocomplete="off" class="form-control input-sm" name="pic_in_charge" id="pic_in_charge"></td>
                                </tr>
                                <tr>
                                    <th>Live Target</th>
                                    <td><input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="live_target" autocomplete="off" id="live_target"></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>Network Type</th>
                                    <td><input type="text" class="form-control input-sm" name="network_type" id="network_type" readonly></td>
                                </tr>
                                <tr>
                                    <th>IP LAN</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_lan" id="ip_lan" readonly></td>
                                </tr>
                                <tr>
                                    <th>IP WAN</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_wan" id="ip_wan" readonly></td>
                                </tr>
                                <tr>
                                    <th>Remote Name</th>
                                    <td><input type="text" class="form-control input-sm" name="remote_name" id="remote_name" readonly></td>
                                </tr>
                                <tr>
                                    <th>Remote Type</th>
                                    <td><input type="text" class="form-control input-sm" name="remote_type" id="remote_type" readonly></td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td><input type="text" class="form-control input-sm" name="region" id="region" readonly></td>
                                </tr>
                                <tr>
                                    <th>Remote Address</th>
                                    <td><textarea name="remote_address" id="remote_address" class="form-control input-sm" rows="3" readonly></textarea></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>Network Type</th>
                                    <td><input type="text" class="form-control input-sm" name="network_type_new" id="network_type_new" readonly></td>
                                </tr>
                                <tr>
                                    <th>IP LAN</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_lan_new" id="ip_lan_new" readonly></td>
                                </tr>
                                <tr>
                                    <th>IP WAN</th>
                                    <td><input type="text" autocomplete="off" class="form-control input-sm" name="ip_wan_new" id="ip_wan_new"></td>
                                </tr>
                                <tr>
                                    <th>Remote Name</th>
                                    <td>
                                        <select id="remote_name_new" name="remote_name_new" style="width: 100%;"></select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Remote Type</th>
                                    <td><input type="text" class="form-control input-sm" name="remote_type_new" id="remote_type_new" readonly></td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td><input type="text" class="form-control input-sm" name="region_new" id="region_new" readonly></td>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Remote Address</th>
                                    <td><textarea name="remote_address_new" id="remote_address_new" class="form-control input-sm" rows="3"></textarea></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="update_form_relokasi">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" >
            <form role="form" id="form_update" action="<?php echo base_url(); ?>index.php/adm_operation/saverelokasi" method='POST' enctype="multipart/form-data">
                <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Relokasi</h4>
                </div>

                <input type="hidden" id="form_type" name="form_type" value="UPDATE">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>IP Address / Network ID</th>
                                    <td>
                                        <select id="id_jarkom" name="id_jarkom" style="width: 100%;"></select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>No SPK</th>
                                    <td><input type="text" class="form-control input-sm" name="no_spk" id="no_spk" readonly></td>
                                </tr>
                                <tr>
                                    <th>Reason</th>
                                    <td><textarea name="reason" id="reason" class="form-control input-sm" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <select id="status" name="status" class="form-control input-sm">
                                            <option value="relokasi">Relokasi</option>
                                            <option value="upgrade_bw">Upgrade BW</option>
                                            <option value="dismantle">Dismantle</option>
                                            <option value="psb">PSB</option>
                                            <option value="realokasi">Realokasi</option>
                                            <option value="reaktifasi">Reaktifasi</option>
                                            <option value="baol">Baol</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6" style="margin-bottom: 55px;">
                            <table class="table table-hover">
                                <tr>
                                    <th>Doc Number</th>
                                    <td><input type="text" autocomplete="off" class="form-control input-sm" name="doc_number" id="doc_number"></td>
                                </tr>
                                <tr>
                                    <th>File Upload</th>
                                    <td><input type="file" class="form-control input-sm"  name="file_upload" id="file_upload"></td>
                                </tr>
                                <tr>
                                    <th>PIC In Charge</th>
                                    <td><input type="text" autocomplete="off" class="form-control input-sm" name="pic_in_charge" id="pic_in_charge"></td>
                                </tr>
                                <tr>
                                    <th>Live Target</th>
                                    <td><input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="live_target" autocomplete="off" id="live_target"></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>Network Type</th>
                                    <td><input type="text" class="form-control input-sm" name="network_type" id="network_type" readonly></td>
                                </tr>
                                <tr>
                                    <th>IP LAN</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_lan" id="ip_lan" readonly></td>
                                </tr>
                                <tr>
                                    <th>IP WAN</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_wan" id="ip_wan" readonly></td>
                                </tr>
                                <tr>
                                    <th>Remote Name</th>
                                    <td><input type="text" class="form-control input-sm" name="remote_name" id="remote_name" readonly></td>
                                </tr>
                                <tr>
                                    <th>Remote Type</th>
                                    <td><input type="text" class="form-control input-sm" name="remote_type" id="remote_type" readonly></td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td><input type="text" class="form-control input-sm" name="region" id="region" readonly></td>
                                </tr>
                                <tr>
                                    <th>Remote Address</th>
                                    <td><textarea name="remote_address" id="remote_address" class="form-control input-sm" rows="3" readonly></textarea></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>Network Type</th>
                                    <td><input type="text" class="form-control input-sm" name="network_type_new" id="network_type_new" readonly></td>
                                </tr>
                                <tr>
                                    <th>IP LAN</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_lan_new" id="ip_lan_new" readonly></td>
                                </tr>
                                <tr>
                                    <th>IP WAN</th>
                                    <td><input type="text" autocomplete="off" class="form-control input-sm" name="ip_wan_new" id="ip_wan_new"></td>
                                </tr>
                                <tr>
                                    <th>Remote Name</th>
                                    <td>
                                        <select id="remote_name_new" name="remote_name_new" style="width: 100%;"></select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Remote Type</th>
                                    <td><input type="text" class="form-control input-sm" name="remote_type_new" id="remote_type_new" readonly></td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td><input type="text" class="form-control input-sm" name="region_new" id="region_new" readonly></td>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Remote Address</th>
                                    <td><textarea name="remote_address_new" id="remote_address_new" class="form-control input-sm" rows="3"></textarea></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>