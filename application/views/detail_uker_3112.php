<script type="text/javascript">
    // $(document).ready(function() {
    //     initialize();
    // });
</script>
<style type="text/css">
    th{
        width: 180px;
        font-size: 14px;
    }
    td{
        font-size: 14px;
    }
    a {color : #777777;}
</style>
<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
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
<!-- <script src="<?php //echo base_url(); ?>assets/js/datepicker.js"></script> -->

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>

<script type="text/javascript">
 
//Initialize Select2 Elements
// $(function () {
//   $('.selectpicker').selectpicker();
// }); 

function edit_jarkom(kodeja) {
  //alert('masoook');
  var url="<?php echo base_url(); ?>index.php/Dashboard/edit_jarkom";

    //ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form'+kodeja).serialize(),
        dataType: "JSON",
        success: function(data)
        {
            alert("Success!");
            location.reload();
            //swal("SUCCESS!", "", "success");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            //swal("ERROR!", "", "error");
 
        }
    });
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

function pilih_brisat() {
  //alert('test');
  var jenis_jarkom = $("#form_network_type").val();
  if (jenis_jarkom != 1) {
    document.getElementById('form_brisat').selectedIndex = '1';
    $('#form_brisat').attr('disabled',true);
  }else{
    document.getElementById('form_brisat').selectedIndex = '0';
    $('#form_brisat').attr('disabled',false);
  }
}
</script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section>
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kanwil[0]->kode_kanwil; ?>">Main Branch</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Remote/'.$data[0]->kode_kanca; ?>">Remote Group</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/data_uker/'.$data[0]->kode_kanca."/".$this->uri->segment(4); ?>">Remote List</a></li>
        <li class="active" style="color: #3C8DBC;">Profile Remote Detail</li>
      </ol>
    </div>
</section>
<section class="content" id="full" style="margin-top: -20px">   
    <div class="row">
        <div class="panel panel-default" style="float: left;width:49%;">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">PROFILE REMOTE DETAIL</div>     
                <div style="width:100%;height:100%;position:relative;">                          
                      <table class="table table-hover">
                        <tr>
                            <th colspan="3">PROFILE REMOTE : <?php echo $data[0]->tipe_uker.' '.$data[0]->nama_remote;?></th>
                        </tr>
                        <tr>
                          <th>REGION</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $kanwil[0]->nama_kanwil;?></td>
                        </tr>
                        <tr>
                          <th>REMOTE STATUS</th>
                          <td style="width: 10px">:</td>
                          <td>
                            <?php 
                              if ($data[0]->status_onoff==3) {
                                echo '<span class="label label-success">ONLINE</span>';
                                $waktu = $data[0]->status_rec_date;
                              }else if($data[0]->status_onoff==1 && $data[0]->kode_op==2 || ( $data[0]->kode_op==1 && $data[0]->status_onoff==1 && in_array($data[0]->kode_tipe_uker, array(10,6,11,13)) ) ){
                                echo '<span class="label label-primary">NOP</span>';
                                $waktu = $data[0]->status_fail_date;
                              }else if($data[0]->status_onoff==1 && $data[0]->kode_op==1){
                                echo '<span class="label label-danger">OFFLINE</span>';
                                $waktu = $data[0]->status_fail_date;
                              }else{
                                $kop = '';
                                if ($data[0]->kode_op==1) {
                                  $kop = 'OP';
                                }else{
                                  $kop = 'NOP';
                                }
                                echo '<span class="label label-primary">UNKNOWN-'.$kop.'</span>';
                                $waktu = $data[0]->status_fail_date;
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <th>LAST CHANGE STATUS</th>
                          <td style="width: 10px">:</td>
                          <td><?php 
                            //echo $data[0]->last_up;
                            $firstTime = strtotime($waktu);
                            $lastTime = strtotime(date('Y-m-d H:i:s'));
                            $lama = (($lastTime - $firstTime) / 3600) / 24;
                            $date_a = new DateTime($waktu);

                            //if ($a->tt_closetime == NULL) {
                              $date_b = new DateTime(date('Y-m-d H:i:s'));
                              //echo date("Y-m-d H:i:s",time());
                            //} else {
                              //$date_b = new DateTime($a->tt_closetime);
                            //}
                            $interval = date_diff($date_a, $date_b);

                            $lamane = $interval->format('%ad %hh %im %ss');   
                            echo $lamane;?>
                          </td>
                        </tr>
                        <tr>
                          <th>COORDINATE</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo "Latitude(".$data[0]->latitude."),Longitude(".$data[0]->longitude.")"; ?>
                          </td>
                        </tr>
                        <tr>
                          <?php
                            if ($data[0]->kode_tipe_uker==7) {
                                echo "<th>ATM TID</th>";
                            }else{
                                echo "<th>BRANCH CODE</th>";
                            }
                          ?>
                          <td style="width: 10px">:</td>
                          <td><?php 
                              if ($data[0]->kode_tipe_uker==7) {
                                  //echo $data[0]->tid_atm;
                                  foreach ($tid_atm[$data[0]->id_remote] as $tid_atms) {
                                    echo $tid_atms->tid_atm." ";
                                  }
                              }else{
                                  echo $data[0]->kode_uker;
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <th>MAIN BRANCH</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo strtoupper($data[0]->nama_kanca);?></td>
                        </tr>
                        <tr>
                          <th>IP LAN</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->ip_lan;?></td>
                        </tr>
                        <tr>
                          <th>PIC REGION</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->pic_kanwil;?></td>
                        </tr>
                        <tr>
                          <th>PIC PINCA</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->pic_pinca;?></td>
                        </tr>
                        <tr>
                          <th>PIC SPO</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->pic_spo;?></td>
                        </tr>
                        <tr>
                          <th>PET IT</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->pet_it;?></td>
                        </tr>
                        <tr>
                          <th>PIC REMOTE</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->nama_pic;?></td>
                        </tr>
                        <tr>
                          <th>ADDRESS</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->alamat_uker;?></td>
                        </tr>
                        <tr>
                          <th>TELP. REMOTE</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->telp_uker;?></td>
                        </tr>
                        <tr>
                          <th>NOTE</th>
                          <td style="width: 10px">:</td>
                          <td><?php echo $data[0]->keterangan;?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <?php if (in_array($this->session->userdata('role'),array(1,5,6,7))) {?>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                  <i class="fa fa-edit"></i> Edit
                                </button>
                                <?php }?>
                                <button type="button" class="btn btn-default" onclick="ping_sweep('<?php echo $data[0]->ip_lan;?>','#show_data')" data-toggle="modal" data-target="#PING">
                                  <i class="fa fa-search"></i> Check Device Online
                                </button>
                            </td>
                        </tr>
                      </table> 					  
                </div>
            </div>

            
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
                                <form role="form" action="<?php $id_remote=$this->uri->segment(3); $kode_tipe_uker=$this->uri->segment(4); echo base_url()."index.php/Dashboard/edit_remote/"; ?>" id="formid" method='post'>
                                  <div class="box-body">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <!-- <input type="hidden" name="kode_kanca" value="<?php //echo $data[0]->kode_kanca; ?>"> -->
                                        <input type="hidden" name="id_remote" value="<?php echo $id_remote; ?>">
                                        <input type="hidden" name="kode_tipe_uker" value="<?php echo $kode_tipe_uker; ?>">
                                        <input type="hidden" name="kode_kanwil" value="<?php echo $data[0]->kode_kanwil; ?>">
                                        <input type="hidden" name="latitude" value="<?php echo $data[0]->latitude; ?>">
                                        <input type="hidden" name="longitude" value="<?php echo $data[0]->longitude; ?>">
                                        <div class="form-group">
                                          <label>REMOTE NAME</label>
                                          <input type="text" name="nama_remote" class="form-control" value="<?php echo $data[0]->nama_remote;?>" <?php if( !in_array($this->session->userdata('role'),array(1,5)) ) { echo 'disabled';}?>>
                                        </div>
                                        <div class="form-group">
                                          <label>REMOTE TYPE</label>
                                          <select class="form-control" name="kode_tipe_uker" <?php echo $this->session->userdata('role') != 1 ? 'disabled' : ''?>>
                                          <?php foreach ($tipe_uker as $tp) {?>
                                            <option value="<?php echo $tp->kode_tipe_uker;?>" 
                                              <?php echo $data[0]->kode_tipe_uker == $tp->kode_tipe_uker ? 'selected' : ''?> >
                                              <?php echo $tp->tipe_uker;?>
                                            </option>
                                          <?php }?>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label>REMOTE STATUS</label>
                                          <select class="form-control" name="kode_op" <?php echo $this->session->userdata('role') != 1 ? 'disabled' : ''?>>
                                            <option <?php echo $data[0]->kode_op== 1 ? 'selected' : ''?> value="1">
                                              <span class="label label-success">OP</span>
                                            </option>
                                            <option <?php echo $data[0]->kode_op== 2 ? 'selected' : ''?> value="2">
                                              <span class="label label-primary">NOP</span>
                                            </option>
                                            <option <?php echo $data[0]->kode_op== 0 ? 'selected' : ''?> value="0">
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
                                              <input type="text" name="start_nop" class="form-control timepicker" value="<?php echo $data[0]->start_nop;?>">

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
                                              <input type="text" name="end_nop" class="form-control timepicker" value="<?php echo $data[0]->end_nop;?>">

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
                                          <input type="text" name="kode_uker" maxlength="5" class="form-control" value="<?php echo $data[0]->kode_uker;?>" <?php echo $this->session->userdata('role') != 1 ? 'disabled' : ''?>">
                                        </div>
                                        <div class="form-group">
                                          <label>MAIN BRANCH</label>
                                          <select  class="form-control selectpicker" id="kanca"  data-live-search="true" style="width: 100%;" name="kode_kanca" <?php echo $this->session->userdata('role') != 1 ? 'disabled' : ''?> onchange="getPIC()">
                                          <?php foreach ($kanca as $kc) {?>
                                            <option value="<?php echo $kc->kode_kanca;?>" 
                                              <?php echo $data[0]->kode_kanca == $kc->kode_kanca ? 'selected="selected"' : ''?> >
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
                                            <input type="text" name="ip_lan" class="form-control" value="<?php echo $data[0]->ip_lan;?>" data-inputmask="'alias': 'ip'" data-mask <?php echo $this->session->userdata('role') != 1 ? 'disabled' : ''?>>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label>ADDRESS</label>
                                          <textarea  name="alamat" class="form-control" rows=""><?php echo $data[0]->alamat_uker;?></textarea>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>PIC REGION</label>
                                          <!-- <input type="text" name="pic_kanwil" class="form-control" value="<?php //echo $data[0]->pic_kanwil;?>" <?php //if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>> -->
                                          <textarea name="pic_kanwil" id="pic_kanwil" class="form-control" rows="3" placeholder="Enter ..." <?php if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>><?php echo $data[0]->pic_kanwil;?></textarea>
                                        </div>
                                        <div class="form-group">
                                          <label>PIC PINCA</label>
                                          <input type="text" name="pic_pinca" id="pic_pinca" class="form-control" value="<?php echo $data[0]->pic_pinca;?>" <?php if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>>
                                        </div>
                                        <div class="form-group">
                                          <label>PIC SPO</label>
                                          <input type="text" name="pic_spo" id="pic_spo" class="form-control" value="<?php echo $data[0]->pic_spo;?>" <?php if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>>
                                        </div>
                                        <div class="form-group">
                                          <label>PET IT</label>
                                          <!-- <input type="text" name="pet_it" class="form-control" value="<?php //echo $data[0]->pet_it;?>" <?php //if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>> -->
                                          <textarea name="pet_it" id="pet_it" class="form-control" rows="3" placeholder="Enter ..." <?php if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>><?php echo $data[0]->pet_it;?></textarea>
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
                                          <?php
                                          $keterangan = '';
                                            if($data[0]->keterangan){
                                              $keterangan = explode(']',$data[0]->keterangan);
                                              $keterangan = $keterangan[1];
                                            }
                                          ?>
                                          <textarea name="keterangan" class="form-control" rows="3" placeholder="Enter ..."><?php echo $keterangan;?></textarea>
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

        
        <div class="panel panel-default" style="width:49%;float: right;"> 
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">REMOTE LOCATION</div>      
            <div id="map-canvas" style="width:100%; height:600px;"></div>
        </div>
    </div>
    
    <!-------------------->
    
    <div class="row">
        <div class="panel panel-default" style="width:100%;"> 
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">NETWORK DETAIL</div>
            <div class="panel-body;margin:5px;width:100%;">  
                <?php $no=1; foreach ($jarkom[$data[0]->id_remote] as $jar){?>
                
                      <div class="panel panel-default" style="display:inline-block;margin:5px;vertical-align: top;">
                        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:12pt;text-align:center;"><?php echo $no;?></div>
                        <div class="panel-body">
                          <table class="table table-hover" style="width: 350px;">
                              <tr>
                                <th>PROVIDER</th>
                                <td style="width: 10px">:</td>
                                <td><?php echo $jar->nama_provider; ?></td>
                              </tr>
                              <tr>
                                <th>NETWORK STATUS</th>
                                <td style="width: 10px">:</td>
                                <td>
                                  <?php 
                                      if ($jar->brisat==1) {
                                        if ($jar->status==3) {
                                          echo '<span class="label label-success">BRISAT/'.$jar->nickname_provider.'</span><br>';
                                        }else if ($jar->status==1) {
                                          echo '<span class="label label-danger">BRISAT/'.$jar->nickname_provider.'</span><br>';
                                        }else {
                                          echo '<span class="label label-primary">BRISAT/'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                        }
                                      }else{
                                        if ($jar->status==3) {
                                          echo '<span class="label label-success">'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                        }else if ($jar->status==1) {
                                          echo '<span class="label label-danger">'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                        }else {
                                          echo '<span class="label label-primary">'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                        }
                                      }
                                    
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <th>LAST CHANGE STATUS</th>
                                <td style="width: 10px">:</td>
                                <td><?php echo $lamane;?></td>
                              </tr>
                              <tr>
                                <th>MEDIA</th>
                                <td style="width: 10px">:</td>
                                <td><?php echo $jar->jenis_jarkom; ?></td>
                              </tr>
                              <tr>
                                <th>IP WAN</th>
                                <td style="width: 10px">:</td>
                                <td><?php echo $jar->ip_wan; ?></td>
                              </tr>
                              <tr>
                                <th>NETWORK ID</th>
                                <td style="width: 10px">:</td>
                                <td><?php echo $jar->kode_jarkom; ?></td>
                              </tr>
                              <tr>
                                <th>BRISAT</th>
                                <td style="width: 10px">:</td>
                                <td>
                                  <?php 
                                  if ($jar->brisat==1) {
                                    echo "YES";
                                  }else{
                                      echo "NO";
                                  }?>
                                </td>
                              </tr>
                              <tr>
                                <th>BANDWIDTH</th>
                                <td style="width: 10px">:</td>
                                <td>
                                  <?php 
                                    echo $jar->bandwidth;
                                  ?> Kbps
                                </td>
                              </tr>
                          </table>
                          <?php if (in_array( $this->session->userdata('role'), array(1,5))) {?>
                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?php echo $jar->kode_jarkom;?>">
                            <i class="fa fa-edit"></i> Edit
                          </button>
                          <?php //if (in_array( $this->session->userdata('role'), array(1,5))) {?>
                          <!-- <button type="button" class="btn btn-danger" onclick="delete_jarkom('<?php //echo $jar->kode_jarkom;?>')">
                            <i class="fa fa-close"></i> Disable
                          </button> -->
                          <?php }?>
                        </div>
                      </div>

                  <?php $no++; }?>
        </div>
        
        <?php if ($this->session->userdata('role')==1) {?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
          <i class="fa fa-plus-square"></i> Add Network
        </button>
        <?php }?>
    </div>
  </div>
  
  <?php 
if(isset($system_log_remote['logs'])){?>
 <div class="row">
        <div class="panel panel-default" style="width:50%;"> 
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Log Remote Network</div>
		<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>DateTime</th>
                  <th>Type</th>
                  <th>Message</th>
                  <th>Reference</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
				<?php
					foreach ($system_log_remote['logs'] as $logs) {
					?>
                <tr>
                  <td><?php echo $logs['datetime'];?></td>
                  <td><?php echo $logs['type'];?></td>
                  <td><?php echo substr($logs['message'], 0, 10) . '...';?></td>
                  <td><?php echo $logs['reference'];?></td>
                  <td>X</td>
                </tr>
					<?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>DateTime</th>
                  <th>Type</th>
                  <th>Message</th>
                  <th>Reference</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		  
		  </div>
		  </div>
<?php } ?>
<!--ADD JARKOM-->
<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Network</h4>
      </div>
      <div class="modal-body">
          <form role="form" action="<?php echo base_url()."index.php/Dashboard/add_jarkom"; ?>" method='post'>
            <div class="box-body">
              <div class="row">
                <!-- <div class="col-md-6"> -->
                  <div class="form-group">
                    <label>Remote Name</label>
                    <input type="text" name="nama_remote" class="form-control" value="<?php echo $data[0]->nama_remote;?>" disabled>
                    <input type="hidden" name="id_remote" class="form-control" value="<?php echo $data[0]->id_remote;?>">
                    <input type="hidden" name="kode_tipe_uker" class="form-control" value="<?php echo $data[0]->kode_tipe_uker;?>">
                  </div>
                  <!-- <div class="form-group">
                    <label>Network ID</label>
                    <input type="text" name="kode_jarkom" class="form-control" value="">
                  </div> -->
                  <div class="form-group">
                    <label>Network Type</label>
                    <select class="form-control" name="kode_jenis_jarkom" id="form_network_type" onchange="pilih_brisat()">
                    <?php foreach ($jenis_jarkom as $jj) {?>
                      <option value="<?php echo $jj->kode_jenis_jarkom;?>">
                        <?php echo $jj->jenis_jarkom;?>
                      </option>
                    <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>BRISAT Yes/No</label> 
                    <select class="form-control" name="brisat"  id="form_brisat">
                      <option value="1"> BRISAT </option>
                      <option value="0"> NON BRISAT </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Provider</label>
                    <select class="form-control" name="kode_provider">
                    <?php foreach ($provider as $p) {?>
                      <option value="<?php echo $p->kode_provider;?>">
                        <?php echo $p->nickname_provider;?>
                      </option>
                    <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>IP WAN</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                      </div>
                      <input type="text" name="ip_wan" class="form-control" value="<?php echo $data[0]->ip_lan;?>" data-inputmask="'alias': 'ip'" data-mask readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>BANDWIDTH</label>
                    <input type="text" name="bandwidth" class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <label>Note</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                  <!-- /.input group -->
                <!-- </div> -->
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" value="submit" class="btn btn-primary" >Save</button>
            </div>
          </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--END ADD JARKOM-->

</section>
<?php $no=1; foreach ($jarkom[$data[0]->id_remote] as $jar){?>
                    
<!--EDIT JARKOM-->
  <div class="modal fade" id="<?php echo $jar->kode_jarkom;?>">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Network</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="" id="form<?php echo $jar->kode_jarkom;?>" method='post'>
            <div class="box-body">
              <div class="row">
                <input type="hidden" name="kode_jarkom" value="<?php echo $jar->kode_jarkom;?>">
                <input type="hidden" name="id_remote" value="<?php echo $jar->id_remote;?>">
                <!-- <div class="col-md-6"> -->
                  <div class="form-group">
                    <label>Provider</label>
                    <select class="form-control" name="kode_provider">
                    <?php foreach ($provider as $p) {?>
                      <option value="<?php echo $p->kode_provider;?>" 
                        <?php echo $jar->kode_provider == $p->kode_provider ? 'selected' : ''?> >
                        <?php echo $p->nickname_provider;?>
                      </option>
                    <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Network Type</label>
                    <select class="form-control" name="kode_jenis_jarkom">
                    <?php foreach ($jenis_jarkom as $jj) {?>
                      <option value="<?php echo $jj->kode_jenis_jarkom;?>" 
                        <?php echo $jar->kode_jenis_jarkom == $jj->kode_jenis_jarkom ? 'selected' : ''?> >
                        <?php echo $jj->jenis_jarkom;?>
                      </option>
                    <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Used Status</label>
                    <select class="form-control" name="used_status">
                      <option value="1" 
                        <?php echo $jar->used_status == 1 ? 'selected' : ''?> > Enable
                      </option>
                      <option value="0" 
                        <?php echo $jar->used_status == 0 ? 'selected' : ''?> > Disable
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>BRISAT Yes/No</label>
                    <select class="form-control" name="brisat">
                      <option value="1" 
                        <?php echo $jar->brisat == 1 ? 'selected' : ''?> > BRISAT
                      </option>
                      <option value="0" 
                        <?php echo $jar->brisat == 0 ? 'selected' : ''?> > NON BRISAT
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>IP WAN</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                      </div>
                      <input type="text" name="ip_wan" class="form-control" value="<?php echo $jar->ip_wan;?>" data-inputmask="'alias': 'ip'" data-mask >
                    </div>
                  </div>
                  <div class="form-group">
                    <label>BANDWIDTH</label>
                    <input type="text" name="bandwidth" class="form-control" value="<?php echo $jar->bandwidth;?>">
                  </div>
                  <!-- /.input group -->
                <!-- </div> -->
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="edit_jarkom('<?php echo $jar->kode_jarkom;?>')">Save</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!--END EDIT JARKOM-->

<?php }?>


<!--PING JARKOM-->
  <div class="modal fade" id="PING">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">PING SWEEP - IP <?php echo $data[0]->ip_lan; ?></h4>
        </div>
        <div class="modal-body">
          <table class="table table-hover" id="table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>IP Address</th>
                    <th>Nama Host</th>
                </tr>
            </thead>
            <tbody id="show_data">
                 
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!--END PING JARKOM-->




<script type="text/javascript">

  function ping_sweep(ip,id){
      //alert('tes');
      $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url()?>index.php/Hosts/getHosts',
          async : false,
          dataType : 'JSON',
          data:"ip="+ip+"&net=24",
          success : function(data){
              var html = '';
              var i;
              for(var i = 0 ; i < data['hosts'].length ; i++){
                  html += '<tr>'+
                          '<td>'+(i+1)+'</td>'+
                          '<td>'+data['hosts'][i]['ip_addr']+'</td>'+
                          '<td>'+data['hosts'][i]['host_apps']+'</td>'+
                          '</tr>';
              }
              $(id).html(html);
              $('#table').DataTable();
          }

      });
  }

  function delete_jarkom(kode_jarkom) {
    //alert(kode_jarkom);
    $.ajax({
        url : '<?php echo base_url()?>index.php/Dashboard/disable_jarkom',
        type: "POST",
        data: "kode_jarkom="+kode_jarkom,
        dataType: "JSON",
        success: function(data)
        {
            alert("Success!");
            location.reload();
            //swal("SUCCESS!", "", "success");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error!!!');
            //swal("ERROR!", "", "error");
 
        }
    });
  }

</script>
<style>
#map-canvas {
    height: 600px;
    width: 550px;
    margin: 0px;
    padding: 0px
}

.container {
    width: 300px;
    float: left;
    height: 430px;
    background: transparent;
    margin-right: -10px
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>
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
var map;
function initialize() {
    var mark  = new Array();

    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
	//var statusonoff = "";
	
	//statusonoff = <?php echo $data[0]->status_onoff;?>;
    var icons = {
      ico0_3: iconBase + 'i0-3.png' ,  ico0_1: iconBase + 'i0-1.png' , ico0_null: iconBase + 'i0-null.png' , ico0_nop: iconBase + 'i0-null.png' , ico0_0: iconBase + 'i0-null.png' ,
      ico1_3: iconBase + 'i1-3.png' ,  ico1_1: iconBase + 'i1-1.png' , ico1_null: iconBase + 'i1-null.png' , ico1_nop: iconBase + 'i1-null.png' , ico1_0: iconBase + 'i1-null.png' ,
      ico2_3: iconBase + 'i2-3.png' ,  ico2_1: iconBase + 'i2-1.png' , ico2_null: iconBase + 'i2-null.png' , ico2_nop: iconBase + 'i2-null.png' , ico2_0: iconBase + 'i2-null.png' ,
      ico3_3: iconBase + 'i3-3.png' ,  ico3_1: iconBase + 'i3-1.png' , ico3_null: iconBase + 'i3-null.png' , ico3_nop: iconBase + 'i3-null.png' , ico3_0: iconBase + 'i3-null.png' ,
      ico4_3: iconBase + 'i4-3.png' ,  ico4_1: iconBase + 'i4-1.png' , ico4_null: iconBase + 'i4-null.png' , ico4_nop: iconBase + 'i4-null.png' , ico4_0: iconBase + 'i4-null.png' ,
      ico5_3: iconBase + 'i5-3.png' ,  ico5_1: iconBase + 'i5-1.png' , ico5_null: iconBase + 'i5-null.png' , ico5_nop: iconBase + 'i5-null.png' , ico5_0: iconBase + 'i5-null.png' ,
      ico6_3: iconBase + 'i6-3.png' ,  ico6_1: iconBase + 'i6-1.png' , ico6_null: iconBase + 'i6-null.png' , ico6_nop: iconBase + 'i6-null.png' , ico6_0: iconBase + 'i6-null.png' ,
      ico7_3: iconBase + 'i7-3.png' ,  ico7_1: iconBase + 'i7-1.png', ico7_null: iconBase + 'i7-null.png' , ico7_nop: iconBase + 'i7-null.png' , ico7_0: iconBase + 'i6-null.png' ,
      ico8_3: iconBase + 'i8-3.png' ,  ico8_1: iconBase + 'i8-1.png', ico8_null: iconBase + 'i8-null.png' , ico8_nop: iconBase + 'i8-null.png' , ico8_0: iconBase + 'i8-null.png' ,
      ico9_3: iconBase + 'i9-3.png' ,  ico9_1: iconBase + 'i9-1.png', ico9_null: iconBase + 'i9-null.png' , ico9_nop: iconBase + 'i9-null.png' , ico9_0: iconBase + 'i9-null.png' ,
      ico10_3: iconBase + 'i10-3.png' , ico10_1: iconBase + 'i10-1.png', ico10_null: iconBase + 'i10-null.png' , ico10_nop: iconBase + 'i10-null.png' , ico10_0: iconBase + 'i10-null.png' ,
      ico11_3: iconBase + 'i11-3.png' , ico11_1: iconBase + 'i11-1.png', ico11_null: iconBase + 'i11-null.png' , ico11_nop: iconBase + 'i11-null.png' , ico11_0: iconBase + 'i11-null.png' ,
      ico12_3: iconBase + 'i12-3.png' , ico12_1: iconBase + 'i12-1.png', ico12_null: iconBase + 'i12-null.png' , ico12_nop: iconBase + 'i12-null.png' , ico12_0: iconBase + 'i12-null.png' ,
	  ico13_3: iconBase + 'i13-3.png' , ico13_1: iconBase + 'i13-1.png', ico13_null: iconBase + 'i13-null.png' , ico13_nop: iconBase + 'i13-null.png' , ico13_0: iconBase + 'i13-null.png'      
      };

    var mapOptions = {
        mapTypeId: 'roadmap',
        zoom: 15,
        center: new google.maps.LatLng(<?php echo $data[0]->lat;?>, <?php echo $data[0]->long;?>)
    };
    var mark = icons['ico'+<?php echo $data[0]->kode_tipe_uker;?>+'_'+<?php echo ($data[0]->status_onoff!=NULL) ? $data[0]->status_onoff : 'null' ;?>]; 
    var letak = new google.maps.LatLng(<?php echo $data[0]->lat;?>, <?php echo $data[0]->long;?>);
    map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
    var marker=new google.maps.Marker({ position:letak, icon:mark,title:"<?php echo $data[0]->tipe_uker.' '.$data[0]->nama_remote;?>", animation:google.maps.Animation.BOUNCE });
    marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);


</script>



<!--
script untuk datatables log
-->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>