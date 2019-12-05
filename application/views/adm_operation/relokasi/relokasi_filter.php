<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/relokasi.css">
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

    <?php 
    function showHide($name) {
        if($name == "default.jpg") {
            return "-";
        } else {
            return anchor(base_url()."index.php/relokasi/download/".$name, "Download File", "");
        }
    }
    ?>

        <div class="panel panel-default">
            <input type="hidden" name="config_form" id="config_form" value="1">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Add SIK</div>
            <div class="buttonXtra">
                <button id="add_form_btn" class="btn btn-primary">Add</button>
                <button id="filter_form_btn" class="btn btn-primary">Filter</button>
            </div>

            <div class="panel-body">

                <?php $this->view('adm_operation/relokasi/filter'); ?>

                <div class="box-body table-responsive no-padding">
                    <table id="filter_table_Data" class="table table-bordered table-striped table-hover" id="table_relokasi">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Kode Jarkom</th>
                                <th>IP WAN</th>
                                <th>Remote Old</th>
                                <th>Remote New</th>
                                <th>Alamat</th>
                                <th>Req Doc</th>
                                <th>WO</th>
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

<?php $this->view('adm_operation/relokasi/insert'); ?>
<?php $this->view('adm_operation/relokasi/detail'); ?>
<?php $this->view('adm_operation/relokasi/edit'); ?>