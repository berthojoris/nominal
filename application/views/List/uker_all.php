<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Select2 -->
<!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/plugins/select2/select2.min.css"> -->
<!-- Select2 -->
<!-- <script src="<?php //echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

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

<script type="text/javascript">
  $(document).ready(function() {
    // //Date picker
    // $('#datepicker').datepicker({
    //   autoclose: true
    // });
    // //Money Euro
    // $('[data-mask]').inputmask();
    // //Timepicker
    // $('.timepicker').timepicker({
    //   showInputs: false
    // });
  });
</script>

<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li class="active" style="color: #3C8DBC;">Remote List</li>
      </ol>
    </div>
</section>
<!-------------- FORM EDIT --------------->        

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content" >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Remote</h4>
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
                            $start_nop = new DateTime($data[0]->start_nop);
                            $st_H = $start_nop->format('H');
                            $st_i = $start_nop->format('i');
                            $st_s = $start_nop->format('s');

                            $end_nop = new DateTime($data[0]->end_nop);
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
                          <input type="text" name="pic_uker" id="pic_uker" class="form-control" value="<?php echo $data[0]->pic_uko;?>">
                        </div>
                        <div class="form-group">
                          <label>TELP. REMOTE</label>
                          <input type="text" name="telp" class="form-control" value="<?php echo $data[0]->telp_uker;?>">
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
<!-------------- END FORM EDIT --------------->
<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Remote - All Region</div>
        <div class="panel-body">             
            <div style="width:100%;height:50px;">
              <input type="hidden" name="url" id="url" value="<?php echo base_url().'index.php/Dashboard/All_uker_search/'; ?>">
              <div align="left" style="float: left;">
                <?php if (in_array($this->session->userdata('role'),array(1,5))) {?>
                  <button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#modal-default" style="width: 100px;height:30px"><i class="fa fa-plus"></i> Add Remote</button>
                <?php }?>
              </div>
              <div align="right">
                <table>
                <tr>
                  <td>
                    <!-- <select class="form-control" name="kategori" style="width: 150px;height: 30px;margin-right: 5px;" id="kategori">
                      <option value="a.nama_remote">Remote Name</option>
                      <option value="c.tipe_uker">Remote Type</option>
                      <option value="e.nama_kanwil">Region</option>
                      <option value="d.nama_kanca">Main Branch</option>
                      <option value="a.kode_uker">Branch Code</option>
                      <option value="a.ip_lan">IP Address</option>
                    </select> -->
                    <select class="form-control" name="kategori" style="width: 150px;height: 30px;margin-right: 5px;" id="kategori" onchange="status()">
                      <option value="nama_remote">Remote Name</option>
                      <option value="tipe_uker">Remote Type</option>
                      <option value="nama_kanwil">Region</option>
                      <option value="nama_kanca">Main Branch</option>
                      <option value="kode_uker">Branch Code</option>
                      <option value="ip_lan">IP Address</option>
                      <option value="status">Remote Status</option>
                      <option value="jenis_jarkom">Network Type</option>
                      <option value="nickname_provider">Provider</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-control" name="kategori" style="width: 150px;height: 30px;margin-right: 5px;display: none" id="status">
                      <option value="3">ONLINE</option>
                      <option value="1">OFFLINE</option>
                      <option value="null">UNKNOWN</option>
                      <option value="nop">NOP</option>
                    </select>
                  </td>
                  <td>
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="input" class="form-control pull-right" id="input" placeholder="Search" id="input">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-default" onclick="search()"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </td>
          				<!-- <td>
          					&nbsp;<a href="<?php echo base_url();?>index.php/Dashboard/All_uker2"><button type="button" class="btn btn-primary btn-sm" style="width: 100px;">Switch Style </button></a>
          				</td> -->
                </tr>
              </table>
            </div>
          </div>
      <div class="box-body table-responsive no-padding">
        <span style="margin-left:10px;font-size:18px">Total Data : <?php echo $total;?></span>
        <table class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th>No.</th>
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
            <?php $no=$this->uri->segment(3)+1; foreach ($data as $datas) {?>
            <tr id="TR" style="background-color: 
                   <?php 
                        if ($datas->status_onoff==3) {
                          //echo '#00a65a;color:white';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status_onoff==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status_onoff==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          //echo '#3c8dbc;color:white';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status_onoff==1 && $datas->kode_op==1){
                          //echo '#ff9999;';
                          $waktu = $datas->status_fail_date;
                        }else{
                          //echo '#e0e0d1';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>;">
              <td><?php echo $no;?></td>
              <td><?php echo $datas->nama_remote;
                  if ($datas->kode_tipe_uker==7) {
                      echo "<br>TID ( ";
                      foreach ($tid_atm[$datas->id_remote] as $tid_atms) {
                        echo $tid_atms->tid_atm." ";
                      }
                      echo ")";
                  }?>
              </td>
              <td><?php echo $datas->tipe_uker;?></td>
              <td><?php echo $datas->nama_kanwil;?></td>
              <td><?php echo $datas->nama_kanca;?></td>
              <td><?php echo $datas->kode_uker;?></td>
              <td><?php echo $datas->ip_lan;?></td>
              <td>
                <?php 
                  if ($datas->status_onoff==3) {
                    echo '<span class="label label-success">ONLINE</span>';
                    $waktu = $datas->status_rec_date;
                  }else if($datas->status_onoff==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status_onoff==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                    echo '<span class="label label-primary">NOP</span>';
                    $waktu = $datas->status_fail_date;
                  }else if($datas->status_onoff==1 && $datas->kode_op==1){
                    echo '<span class="label label-danger">OFFLINE</span>';
                    $waktu = $datas->status_fail_date;
                  }else{
                    echo '<span class="label label-primary">UNKNOWN</span>';
                    $waktu = $datas->status_fail_date;
                  }
                ?>
              </td>
              <td>
                <?php 
                  //echo $datas->last_up;
                  $firstTime = strtotime($waktu);
                  $lastTime = strtotime(date('Y-m-d H:i:s'));
                  $lama = (($lastTime - $firstTime) / 3600) / 24;
                  $date_a = new DateTime($waktu);

                  $date_b = new DateTime(date('Y-m-d H:i:s'));
                  
                  $interval = date_diff($date_a, $date_b);

                  $lamane = $interval->format('%ad %hh %im %ss');   
                  echo $lamane;
                ?>    
              </td>
              <td>
                <?php 
                  foreach ($jarkom[$datas->id_remote] as $jarkoms) {
                    if ($jarkoms->brisat==1) {
                      if ($jarkoms->status==3) {
                        echo '<span class="label label-success">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                      }else if ($jarkoms->status==1) {
                        echo '<span class="label label-danger">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                      }else{
                        echo '<span class="label label" style="color:#3d3d29">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                      }
                    }else{
                      if ($jarkoms->status==3) {
                        echo '<span class="label label-success">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                      }else if ($jarkoms->status==1) {
                        echo '<span class="label label-danger">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                      }else{
                        echo '<span class="label label" style="color:#3d3d29">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                      }
                    }
                  }
                ?>
              </td>
              <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px;hight:30px"><i class="fa fa-book"></i> Detail</button></a></td>
            </tr>
            <?php $no++; }?>
          </tbody>
        </table>
        <?php echo $this->pagination->create_links();?>
      </div>
    </div>
    </div>        
</div>
</section>


<script>
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
</script>