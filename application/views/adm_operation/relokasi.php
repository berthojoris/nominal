<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<script src="<?php echo base_url('assets/js/plugins/daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
<style>
.buttonXtra {
    margin: 20px 0px 20px 20px;
}
.modal-dialog {
    width: 800px;
    margin: 30px auto;
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

        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Add SIK</div>
            <div class="buttonXtra">
                <button id="add_form_btn" class="btn btn-primary">Add</button>
                <button id="filter_form_btn" class="btn btn-primary">Filter</button>
            </div>

            <div class="panel-body">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-striped table-hover" id="table_relokasi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>IP Address/Network ID</th>
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
                        <tbody>
                            <?php
                                $no = $this->uri->segment('3') + 1;
                                foreach($relokasi as $d) {
                                    echo "<tr>";
                                        echo "<td>".$no++."</td>";
                                        echo "<td>".$d->ip_address_network_id."</td>";
                                        echo "<td>".$d->reason."</td>";
                                        echo "<td>".$d->doc_number."</td>";
                                        echo "<td>".anchor(base_url()."/adm_operation/downloadFile/".$d->file_upload, "Download File", "")."</td>";
                                        echo "<td>".$d->pic."</td>";
                                        echo "<td>".$d->live_target."</td>";
                                        echo "<td>".$d->ip_wan."</td>";
                                        echo "<td>".$d->remote_name."</td>";
                                        echo "<td>".$d->remote_address."</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php 
                        echo $this->pagination->create_links();
                    ?>
                </div>
            </div>
        </div>
    </row>
</section>

<div class="modal fade" id="search_modal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" >

            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Relokasi</h4>
            </div>

            <div class="modal-body">
                <div class="col-md-12">
                    <input type="text" name="searchFilter" id="searchFilter">
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

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>IP Address / Network ID</th>
                                    <td><input type="text" autocomplete="off" class="form-control input-sm" name="ip_address_network_id" id="ip_address_network_id"></td>
                                </tr>
                                <tr>
                                    <th>No SPK</th>
                                    <td><input type="text" class="form-control input-sm" name="no_spk" id="no_spk" readonly></td>
                                </tr>
                                <tr>
                                    <th>Reason</th>
                                    <td><textarea name="reason" id="reason" class="form-control input-sm" rows="3"></textarea></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
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
                                <tr>
                                    <th></th>
                                    <td></td>
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
                                        <div class="form-group has-feedback">
                                            <input type="text" autocomplete="off" class="form-control" name="remote_name_new" id="remote_name_new" placeholder="Search" />
                                            <i class="glyphicon glyphicon-search form-control-feedback"></i>
                                        </div>
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