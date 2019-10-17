<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<script src="<?=base_url()?>assets/plugins/select2/select2.full.min.js"></script>
<style>
.buttonXtra {
    margin: 20px 0px 20px 20px;
}
.modal-dialog {
    width: 700px;
    margin: 30px auto;
}
</style>
<script>
$(document).ready(function() {
    $("#add_form_btn").click(function (e) {
        $("#add_form_relokasi").modal('show');
    });

    // $("#filter_form_btn").click(function (e) {
    //     $("#search_modal").modal('show');
    // });

    $("#remote_name_new").change(function (e) { 
        e.preventDefault();
        var name = $(this).val();
        $("#remote_type_new").val('');
        $("#region_new").val('');
        $("#remote_address_new").val('');
        $.ajax({
            type: "GET",
            url: "<?=base_url()?>index.php/Api/getremotebyname/"+name,
            dataType: "json",
            success: function (response) {
                if(response.code == 200) {
                    $("#remote_type_new").val(response.data[0].tipe_uker);
                    $("#region_new").val(response.data[0].nama_kanwil);
                    $("#remote_address_new").val(response.data[0].alamat_uker);
                } else if(response.code == 404) {
                    swal("Oops", "Data not found for "+name, "success");
                }  else {
                    swal("Oops", "Search failed. Please reload the page", "error");
                }
            }
        });
    });

    $("#ip_address_network_id").change(function (e) { 
        e.preventDefault();
        var ip = $(this).val();
        $.ajax({
            type: "GET",
            url: "<?=base_url()?>index.php/Api/getremote/"+ip,
            dataType: "json",
            success: function (response) {
                console.log(response);
            }
        });
    });

    $("#searchFilter").select2({
        minimumInputLength:6,
        placeholder:"Type at least 6 charachter",
        ajax:{
            url:"<?=base_url()?>index.php/ApiSimcard/findIccid",
            type:"post",
            dataType:"json",
            data: function(param) {
                return{search:param.term}
            },
            processResults:function(data) {
                return{results:data}
            }
        }
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
        <?php 
        if(!empty($this->session->userdata('notif_success'))) {
            echo '<div class="alert alert-success" role="alert">Success create ticket</div>';
        }
        if(!empty($this->session->userdata('ticket_created'))) {
            echo '<div class="alert alert-danger" role="alert">Ticket has been created before</div>';
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
                    <table class="table table-bordered table-striped table-hover" id="table_relokasi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Jarkom</th>
                                <th>ID Remote Old</th>
                                <th>ID Remote New</th>
                                <th>Alamat</th>
                                <th>File Path</th>
                                <th>No.SIK</th>
                                <th>No.Doc Pendukung</th>
                                <th>Alasan Relokasi</th>
                                <th>Status Relokasi</th>
                                <th>Tanggal Live</th>
                                <th>Order Date</th>
                                <th>PIC</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
                                    <td><input type="text" class="form-control input-sm" name="ip_wan_new" id="ip_wan_new"></td>
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

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="button" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>