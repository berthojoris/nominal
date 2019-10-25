<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<script src="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/js/additional-methods.min.js"></script>

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

                <?php $this->view('adm_operation/filter'); ?>

                <div class="box-body table-responsive no-padding">
                    <table id="filter_table_Data" class="table table-bordered table-striped table-hover" id="table_relokasi">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Remote Old</th>
                                <th>Remote New</th>
                                <th>Alamat</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>PIC</th>
                                <td>Detail</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="add_form_relokasi">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form role="form" id="form_add" action="<?php echo base_url(); ?>index.php/adm_operation/saverelokasi" method='POST' enctype="multipart/form-data">
                <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Relokasi</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="form_type" name="form_type" value="CREATE">
                    <input type="hidden" id="id_remote_old" name="id_remote_old" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Network ID / IP Address / Provider</label>
                                    <select id="id_jarkom" name="id_jarkom" required></select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Doc Number</label>
                                    <input type="text" autocomplete="off" class="form-control input-sm" name="doc_number" id="doc_number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No SPK</label>
                                    <input type="text" class="form-control input-sm" name="no_spk" id="no_spk" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>File Upload</label>
                                    <input type="file" class="form-control input-sm"  name="file_upload" id="file_upload">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea name="reason" id="reason" class="form-control input-sm" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PIC In Charge</label>
                                    <input type="text" autocomplete="off" class="form-control input-sm" name="pic_in_charge" id="pic_in_charge" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control input-sm">
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
                                    <input type="text" data-date-format='yyyy-mm-dd' class="form-control input-sm" name="live_target" autocomplete="off" id="live_target" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Network Type</label>
                                    <input type="text" class="form-control input-sm" name="network_type" id="network_type" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Network Type</label>
                                    <input type="text" class="form-control input-sm" name="network_type_new" id="network_type_new" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP LAN</label>
                                    <input type="text" class="form-control input-sm" name="ip_lan" id="ip_lan" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP LAN</label>
                                    <input type="text" class="form-control input-sm" name="ip_lan_new" id="ip_lan_new" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP WAN</label>
                                    <input type="text" class="form-control input-sm" name="ip_wan" id="ip_wan" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP WAN</label>
                                    <input type="text" autocomplete="off" class="form-control input-sm" name="ip_wan_new" id="ip_wan_new" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="remotePanel">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Name</label>
                                    <input type="text" class="form-control input-sm" name="remote_name" id="remote_name" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Name</label>
                                    <select id="remote_name_new" name="remote_name_new" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Type</label>
                                    <input type="text" class="form-control input-sm" name="remote_type" id="remote_type" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Type</label>
                                    <input type="text" class="form-control input-sm" name="remote_type_new" id="remote_type_new" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Region</label>
                                    <input type="text" class="form-control input-sm" name="region" id="region" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Region</label>
                                    <input type="text" class="form-control input-sm" name="region_new" id="region_new" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Address</label>
                                    <textarea name="remote_address" id="remote_address" class="form-control input-sm" rows="3" readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remote Address</label>
                                    <textarea name="remote_address_new" id="remote_address_new" class="form-control input-sm" rows="3" required></textarea>
                                </div>
                            </div>
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

<div class="modal fade" id="open_detail_modal">
    <div class="modal-dialog" style="width: 600px;">
        <div class="modal-content" >
            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail</h4>
            </div>

            <div class="modal-body">
                <table>
                    <tr>
                        <td>Remote Name Old</td>
                        <td class="detail">:</td>
                        <td><label id="nama_remote_old" class="detail"></label></td>
                    </tr>
                    <tr>
                        <td>Remote Name New</td>
                        <td class="detail">:</td>
                        <td><label id="nama_remote_new" class="detail"></label></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td class="detail">:</td>
                        <td><label id="alamat" class="detail"></label></td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td class="detail">:</td>
                        <td><label id="file_url" class="detail"></label></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td class="detail">:</td>
                        <td><label id="status_detail" class="detail"></label></td>
                    </tr>
                    <tr>
                        <td>Due Date</i></td>
                        <td class="detail">:</td>
                        <td><label id="due_date" class="detail"></label></td>
                    </tr>
                    <tr>
                        <td>PIC</td>
                        <td class="detail">:</td>
                        <td><label id="pic" class="detail"></label></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

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
                    
                    <form id="filterForm">

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

                    </form>
                    
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Remote Name</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Provider</th>
                                    <th>Doc Number</th>
                                    <th>PIC In Charge</th>
                                    <th>Live Target</th>                                    
                                </tr>
                            </thead>
                            <tbody id="data_filter"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>