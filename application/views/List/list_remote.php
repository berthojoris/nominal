<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0/jquery-ui.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Select2 -->
<!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/plugins/select2/select2.min.css"> -->
<!-- Select2 -->
<!-- <script src="<?php //echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />

<!-- InputMask -->
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/timepicker/bootstrap-timepicker.min.css">
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>

<style>
a {color : #777777;}
/* tr:hover  #TR{ background-color : #ccd9ff }  */
</style>

<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li class="active" style="color: #3C8DBC;">Remote List</li>
      </ol>
    </div>
</section>


<!-------------- FORM ADD --------------->        

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width: 1000px">
            <div class="modal-content" >
              <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Remote</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="<?php echo base_url()."index.php/Dashboard/add_remote/"; ?>" id="formid" method='post'>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                        <!-- <input type="hidden" name="kode_kanca" value="<?php //echo $data[0]->kode_kanca; ?>"> -->
                        <!-- <input type="hidden" name="id_remote" value="<?php //echo $id_remote; ?>">
                        <input type="hidden" name="kode_tipe_uker" value="<?php //echo $kode_tipe_uker; ?>">
                        <input type="hidden" name="kode_kanwil" value="<?php //echo $data[0]->kode_kanwil; ?>">
                        <input type="hidden" name="latitude" value="<?php //echo $data[0]->latitude; ?>">
                        <input type="hidden" name="longitude" value="<?php //echo $data[0]->longitude; ?>"> -->
                        <div class="form-group">
                          <label>REMOTE NAME</label>
                          <input type="text" name="nama_remote" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>REMOTE TYPE</label>
                          <select class="form-control" name="kode_tipe_uker" >
                          <?php foreach ($tipe_uker as $tp) {?>
                            <option value="<?php echo $tp->kode_tipe_uker;?>">
                              <?php echo $tp->tipe_uker;?>
                            </option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>REMOTE STATUS</label>
                          <select class="form-control" name="kode_op">
                            <option value="1">
                              <span class="label label-success">OP</span>
                            </option>
                            <option value="2">
                              <span class="label label-primary">NOP</span>
                            </option>
                            <option value="0">
                              <span class="label label-danger">DISABLE</span>
                            </option>
                          </select>
                        </div>
                        <?php
                            $start_nop = new DateTime(date('Y-m-d H:i:s'));
                            $st_H = $start_nop->format('H');
                            $st_i = $start_nop->format('i');
                            $st_s = $start_nop->format('s');

                            $end_nop = new DateTime(date('Y-m-d H:i:s'));
                            $end_H = $end_nop->format('H');
                            $end_i = $end_nop->format('i');
                            $end_s = $end_nop->format('s');
                        ?>
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                            <label>START NOP</label>

                            <div class="input-group">
                              <input type="text" name="start_nop" class="form-control timepicker" value="">

                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                        </div>

                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                            <label>END NOP</label>

                            <div class="input-group">
                              <input type="text" name="end_nop" class="form-control timepicker" value="">

                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                        </div>
                        <div class="form-group">
                          <label>BRANCH CODE</label>
                          <input type="text" name="kode_uker" maxlength="5" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>MAIN BRANCH</label>
                          <select  class="form-control selectpicker" id="kanca"  data-live-search="true" style="width: 100%;" name="kode_kanca" onchange="getPIC()">
                            <option value="">--Choose Main Branch--</option>
                          <?php foreach ($kanca as $kc) {?>
                            <option value="<?php echo $kc->kode_kanca;?>">
                              <?php echo $kc->kode_kanca.'-'.$kc->nama_kanca;?>
                            </option>
                          <?php }?>
                          </select>
                          <!-- <input type="text" name="kode_kanca" class="form-control" value="<?php //echo $data[0]->nama_kanca;?>"> -->
                        </div>
                        <div class="form-group">
                          <label>IP LAN</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" name="ip_lan" class="form-control" value="" data-inputmask="'alias': 'ip'" data-mask >
                          </div>
                        </div>
                        <div class="form-group">
                          <label>LATITUDE</label>
                          <input type="text" name="latitude" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>LONGITUDE</label>
                          <input type="text" name="longitude" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>ADDRESS</label>
                          <textarea  name="alamat" class="form-control" rows=""></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>PIC REGION</label>
                          <!-- <input type="text" name="pic_kanwil" class="form-control" value="<?php //echo $data[0]->pic_kanwil;?>" <?php //if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>> -->
                          <textarea name="pic_kanwil" id="pic_kanwil" class="form-control" rows="3" placeholder="Enter ..." ></textarea>
                        </div>
                        <div class="form-group">
                          <label>PIC PINCA</label>
                          <input type="text" name="pic_pinca" id="pic_pinca" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>PIC SPO</label>
                          <input type="text" name="pic_spo" id="pic_spo" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>PET IT</label>
                          <!-- <input type="text" name="pet_it" class="form-control" value="<?php //echo $data[0]->pet_it;?>" <?php //if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>> -->
                          <textarea name="pet_it" id="pet_it" class="form-control" rows="3" placeholder="Enter ..." ></textarea>
                        </div>
                        <div class="form-group">
                          <label>PIC REMOTE</label>
                          <input type="text" name="pic_uker" id="pic_uker" class="form-control" value="">
                        </div>
                        <div class="form-group">
                          <label>TELP. REMOTE</label>
                          <input type="text" name="telp" class="form-control" value="">
                        </div>
                        <div class="form-group">
                          <label>NOTE</label>
                          <textarea name="keterangan" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<!-------------- END FORM ADD --------------->

<!-------------- FORM ADD --------------->        

        <div class="modal fade" id="modal-default2">
          <div class="modal-dialog">
            <div class="modal-content" >
              <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Remote Batch</h4>
              </div>
              <div class="modal-body">
                <form role="form" id="import_form" enctype="multipart/form-data" method='post'>
                  <div class="box-body">
                    <div class="row">

                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="file" name="file" required accept=".xls, .xlsx" >
                        <p class="help-block">Example block-level help text here.</p>
                      </div>

                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" value="Check" class="btn btn-primary">
                    <!-- <button type="button" name="save" value="save" class="btn btn-primary" onclick="save_remote()">Save</button> -->
                  </div>
                </form>
                <div>
                	<a href="<?php echo base_url().'index.php/Master/remote_excel/valid';?>"><button type="button" class="btn btn-primary pull-left">Export Excel Valid</button></a>
                </div>
                <div style="margin-left: 140px">
                	<a href="<?php echo base_url().'index.php/Master/remote_excel/invalid';?>"><button type="button" class="btn btn-primary pull-left">Export Excel Invalid</button></a>
                </div>
                <div style="margin-left: 290px">
                	<a href="<?php echo base_url().'index.php/Master/Download_Format';?>">
                		<button type="button" class="btn btn-primary btn-flat">
                              <span class="fa fa-download"></span> Download Format Excel
                        </button>
                	</a>
                </div>
                <br><br><br>
                <table class="table table-hover" id="remote">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>IP LAN</th>
                      <th>Remote Name</th>
                      <th>Branch Code</th>
                      <th>Main Branch ID</th>
                    </tr>
                  </thead>
                  <tbody  id="remote_data">

                  </tbody>
                </table>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-right" id="btn_save" style="display: none;" onclick="save_remote()">Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<!-------------- END FORM ADD --------------->

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Remote - All Region</div>
        <div class="panel-body">
          <div style="width:100%;height:50px;">
              <input type="hidden" name="url" id="url" value="<?php echo base_url().'index.php/Dashboard/All_uker_search/'; ?>">
              <?php if (in_array($this->session->userdata('role'),array(1,5))) {?>
              <div align="left" style="float: left;">
                <button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#modal-default" style="width: 100px;height:30px"><i class="fa fa-plus"></i> Add Remote</button>
              </div>
              <div style="float: left; margin-left: 10px">
                <button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#modal-default2" style="width: 130px;height:30px"><i class="fa fa-plus"></i> Add Remote  Batch</button>
              </div>
              <!-- <div style="float: left; margin-left: 10px;">
                <a href="<?php echo base_url().'index.php/Dashboard/uker_excel/All/';?>"><button type="button" class="btn btn-primary btn-sm" style="width: 100px">
                Export Excel
                </button></a>
              </div> -->
              <?php }?>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-bordered table-striped table-hover" id="table_data">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Remote Id</th>
                  <th>Remote Name</th>
                  <th>Remote Type</th>
                  <th>Region</th>
                  <th>Main Branch</th>
                  <th>Branch Code</th>
                  <th>IP Address</th>
                  <th>Remote Status</th>
                  <th>Last Change Update</th>
                  <th>Network</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
    </div>        
</div>
</section>


<script>

  $(document).ready(function(){
    //alert("test jquery");
    tampilkan_data();
  });

  function tampilkan_data()
  {
    $("#table_data").DataTable({
      orderMulti: true,
      processing:true,
      serverSide:true,
      columns:[

        {data:"No"},
        {data:"Remote Id"},
        {data:"Remote Name"},
        {data:"Remote Type"},
        {data:"Region"},
        {data:"Main Branch"},
        {data:"Branch Code"},
        {data:"IP Address"},
        {data:"Remote Status"},
        {data:"Last Change Update"},
        {data:"Network"},
        {data:"Action"}
      ],
      columnDefs:[
        {
          targets:[0,11],
          orderable:true
        }
      ],

      ajax:{
        url:"<?php echo base_url().'index.php/Dashboard/tampil_table';?>",
        type:"post",
        dataType:"json"

      }
    });
  }



  //Date picker
  $('#datepicker').datepicker({
    autoclose: true
  });
  //Money Euro
  $('[data-mask]').inputmask();
  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  });

  function search() {
    kategori = $('#kategori').val();
    input = $('#input').val();
    status = $('#status').val();
    url = $('#url').val();

    if (kategori=='status') {
      window.location = url+kategori+'/'+status;
    }else{
      window.location = url+kategori+'/'+input;
    }
    //alert(location);
  }

  function status() {
    $("#status").hide();
    var pilih = $("#kategori").val(); 
    //alert(pilih);
    if (pilih=='status') {
        $("#status").show();
    }
  }

  function getPIC() {
    //alert("MAsoook");
    var kanca = $("#kanca").val();
    console.log(kanca);
    $.ajax({
        type  : 'POST',
        url   : "<?php echo site_url('Dashboard/getPIC')?>",
        async : false,
        dataType : 'JSON',
        data:"kanca="+kanca,
        success : function(data){
          console.log(data);
          $("#pic_kanwil").val(data.pic_kanwil);
          $("#pic_pinca").val(data.pic_pinca);
          $("#pic_spo").val(data.pic_spo);
          $("#pet_it").val(data.pet_it);
        }
    });
  }

  function load_data()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>index.php/Master/fetch_remote",
      method:"POST",
      dataType:'JSON',
      success:function(data){
        console.log(data['jumlah']);
        console.log(data);
        $('#remote_data').html(data['output']);
        $('#remote').DataTable();
        if (data['jumlah']==0) {
          $('#btn_save').show();
        }
      }
    })
  }

  function save_remote()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>index.php/Master/insert_remote",
      success:function(data){
        alert(data);
      }
    })
  }

  $('#import_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"<?php echo base_url(); ?>index.php/Master/import_remote",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        //$('#file').val('');
        load_data();
        alert(data);
      }
    })
  });
</script>