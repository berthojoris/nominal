<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<style>
.buttonXtra {
    margin: 20px 0px 20px 20px;
}
.modal-dialog {
    width: 1200px;
    margin: 30px auto;
}
</style>
<script>
$(document).ready(function() {
    $("#add_form_btn").click(function (e) {
        $("#add_form_relokasi").modal('show');
    });
});
</script>

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
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Add SIK</div>
            <div class="buttonXtra">
                <button id="add_form_btn" class="btn btn-primary">Add</button>
                <button id="filter_form_btn" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </row>
</section>

<div class="modal fade" id="add_form_relokasi">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" >

            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Relokasi</h4>
            </div>

            <div class="modal-body">
                <form role="form" id="form_add" action="<?php echo base_url(); ?>index.php/adm_operation/add" method='post'>
                    <div class="row">

                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>IP Address / Network ID</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_address_network_id" id="ip_address_network_id"></td>
                                </tr>
                                <tr>
                                    <th>No SPK</th>
                                    <td><input type="text" class="form-control input-sm" name="no_spk" id="no_spk"></td>
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
                                    <td><input type="text" class="form-control input-sm" name="doc_number" id="doc_number"></td>
                                </tr>
                                <tr>
                                    <th>File Upload</th>
                                    <td><input type="file" class="form-control input-sm"  name="file_upload" id="file_upload"></td>
                                </tr>
                                <tr>
                                    <th>PIC In Charge</th>
                                    <td><input type="text" class="form-control input-sm" name="pic_in_charge" id="pic_in_charge"></td>
                                </tr>
                                <tr>
                                    <th>Live Target</th>
                                    <td><input type="text" class="form-control input-sm" name="live_target" id="live_target"></td>
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
                                    <td><input type="text" class="form-control input-sm" name="network_type" id="network_type"></td>
                                </tr>
                                <tr>
                                    <th>IP Address</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_address" id="ip_address"></td>
                                </tr>
                                <tr>
                                    <th>Remote Name</th>
                                    <td><input type="text" class="form-control input-sm" name="remote_name" id="remote_name"></td>
                                </tr>
                                <tr>
                                    <th>Remote Type</th>
                                    <td><input type="text" class="form-control input-sm" name="remote_type" id="remote_type"></td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td><input type="text" class="form-control input-sm" name="region" id="region"></td>
                                </tr>
                                <tr>
                                    <th>Remote Address</th>
                                    <td><textarea name="remote_address" id="remote_address" class="form-control input-sm" rows="3"></textarea></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <th>Network Type</th>
                                    <td><input type="text" class="form-control input-sm" name="network_type_new" id="network_type_new" disabled></td>
                                </tr>
                                <tr>
                                    <th>IP Address</th>
                                    <td><input type="text" class="form-control input-sm" name="ip_address_new" id="ip_address_new"></td>
                                </tr>
                                <tr>
                                    <th>Remote Name</th>
                                    <td>
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control" name="remote_name_new" id="remote_name_new" placeholder="Search" />
                                            <i class="glyphicon glyphicon-search form-control-feedback"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Remote Type</th>
                                    <td>
                                        <select name="remote_type_new" id="remote_type_new" class="form-control input-sm">
                                            <option value="">- Choose Remote Type -</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td>
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control" name="region_new" id="region_new" placeholder="Search" />
                                            <i class="glyphicon glyphicon-search form-control-feedback"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Remote Address</th>
                                    <td><textarea name="remote_address_new" id="remote_address_new" class="form-control input-sm" rows="3"></textarea></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="button" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>