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
<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>
<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> -->

<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0/jquery-ui.js"></script>
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Select2 -->
<!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/plugins/select2/select2.min.css"> -->
<!-- Select2 -->
<!-- <script src="<?php //echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>-->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" /> -->

<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />

<!-- leaflet -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/leaflet/leaflet.css" />
<script src="<?php echo base_url(); ?>assets/plugins/leaflet/leaflet.js" ></script>
<script src="<?php echo base_url(); ?>assets/plugins/leaflet-bouncing/leaflet.smoothmarkerbouncing.js" ></script>

<!-- InputMask -->
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/timepicker/bootstrap-timepicker.min.css">
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- <script src="<?php //echo base_url(); ?>assets/js/datepicker.js"></script> -->

<!-- <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script> -->

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
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
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
                                }else if($data[0]->status_onoff==1 && $data[0]->kode_op==1){
                                  echo '<span class="label label-danger">OFFLINE</span>';
                                  $waktu = $data[0]->status_fail_date;
                                }else if($data[0]->status_onoff==1 && $data[0]->kode_op==2){
                                  echo '<span class="label label-primary">NOP</span>';
                                  $waktu = $data[0]->status_fail_date;
                                }else if($data[0]->kode_op==0){
                                  echo '<span class="label label-danger">DISABLE</span>';
                                  $waktu = $data[0]->status_fail_date;
                                }else{
                                  echo '<span class="label label-primary">UNKNOW</span>';
                                  $waktu = $data[0]->status_fail_date;
                                }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <th>LAST CHANGE STATUS</th>
                          <td style="width: 10px">:</td>
                          <td><?php 
                            //echo $datas->last_up;
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
                          <td><?php echo $data[0]->pic_uko;?></td>
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
                            <th>STATUS ALARM</th>
                            <td style="width: 10px">:</td>
                            <td>
                              <div style="float: left;margin-right: 5px">
                            <?php
                                if ($data[0]->status_alarm==2) {
                                  echo '<span class="label label-danger">UNACKED</span>';
                                }else if($data[0]->status_alarm==3 || $data[0]->status_alarm==4){
                                  echo '<span class="label label-warning">ACKED</span>';
                                }else{
                                  echo '<span class="label label-default">NONE</span>';
                                }
                            ?>
                            <?php if($data[0]->status_onoff==1){?>
                              <button type="button" class="btn-xs btn-primary" data-toggle="modal" data-target="#detail_alarm" onclick="DetailAlarm(<?php echo $data[0]->id_alarm;?>)">
                                Detail Alarm
                              </button>
                            <?php }?>
                              <button type="button" class="btn-xs btn-primary" data-toggle="modal" data-target="#HISTORY">
                                History Alarm
                              </button>
                              </div>
                    <?php if($data[0]->status_onoff==1 && !empty($data[0]->id_alarm && in_array($this->session->userdata('role'),array(1,5)))){?>
                              <div class="input-group-btn">
                                <button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
                                  <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                  <!-- <li><a href="<?php echo base_url().'index.php/Master/ActionAckByRemote/'.$data[0]->id_alarm.'/'.$data[0]->current_state;?>">Ack</a></li> -->
                                  <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" onclick="ActionAckByRemote('<?php echo base_url().'index.php/Master/ActionAckByRemote/'.$data[0]->id_alarm.'/'.$data[0]->current_state;?>')">Ack</button></li>
                                  <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" data-toggle="modal" data-target="#edit_alarm" onclick="GetAlarm(<?php echo $data[0]->id_alarm;?>)">Edit Alarm</button></li>
                                </ul>
                              </div>
                        <?php }?>
                            </td>
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
                          <div class="modal-dialog" style="width: 1000px">
                            <div class="modal-content" >
                              <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
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
                                          <textarea name="pic_kanwil" id="pic_kanwil" class="form-control" rows="3" placeholder="Enter ..." <?php if( !in_array($this->session->userdata('role'),array(1,5,6)) ) { echo 'disabled';}?>><?php echo $data[0]->pic_kanwil;?></textarea>
                                        </div>
                                        <div class="form-group">
                                          <label>PIC PINCA</label>
                                          <input type="text" name="pic_pinca" id="pic_pinca" class="form-control" value="<?php echo $data[0]->pic_pinca;?>" <?php if( !in_array($this->session->userdata('role'),array(1,5,6)) ) { echo 'disabled';}?>>
                                        </div>
                                        <div class="form-group">
                                          <label>PIC SPO</label>
                                          <input type="text" name="pic_spo" id="pic_spo" class="form-control" value="<?php echo $data[0]->pic_spo;?>" <?php if( !in_array($this->session->userdata('role'),array(1,5,6)) ) { echo 'disabled';}?>>
                                        </div>
                                        <div class="form-group">
                                          <label>PET IT</label>
                                          <!-- <input type="text" name="pet_it" class="form-control" value="<?php //echo $data[0]->pet_it;?>" <?php //if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>> -->
                                          <textarea name="pet_it" id="pet_it" class="form-control" rows="3" placeholder="Enter ..." <?php if( !in_array($this->session->userdata('role'),array(1,5,6)) ) { echo 'disabled';}?>><?php echo $data[0]->pet_it;?></textarea>
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


                <!--EDIT ALARM-->
                <div class="modal fade" id="edit_alarm">
                  <div class="modal-dialog" style="width: 1000px">
                    <div class="modal-content" >
                      <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Alarm</h4>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="" id="formid1" method='post'>
                          <div class="box-body">
                            <div class="row">
                              <input type="hidden" name="id_alarm" id="id_alarm" class="form-control">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Remote Name</label>
                                  <input type="text" name="remote_name" id="remote_name" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Remote Type</label>
                                  <input type="text" name="remote_type" id="remote_type" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Region</label>
                                  <input type="text" name="region" id="region" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Main Branch</label>
                                  <input type="text" name="main_branch" id="main_branch" class="form-control" disabled>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Branch Code</label>
                                  <input type="text" name="branch_code" id="branch_code" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>IP Address</label>
                                  <input type="text" name="ip_address" id="ip_address" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Provider</label>
                                  <input type="text" name="provider" id="provider" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Network Type</label>
                                  <input type="text" name="jenis_jarkom" id="jenis_jarkom" class="form-control" disabled>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Current State</label>
                                  <input type="text" name="current_state" id="current_state" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Ack Time</label>
                                  <input type="text" name="ack_at" id="ack_at" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Ack By</label>
                                  <input type="text" name="ack_by" id="ack_by" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Type Alarm</label>
                                  <select class="form-control" name="alarm_type">
                                    <option id="alarm_type0" value="0">--Choose Type--</option>
                                    <?php foreach ($type_alarm as $ta) {?>
                                    <option value="<?php echo $ta->id;?>" id="alarm_type<?php echo $ta->id;?>">
                                      <?php echo $ta->alarm_type;?>
                                    </option>
                                  <?php }?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Clear Time</label>
                                  <input type="text" name="stop_at" id="stop_at" class="form-control" value="" disabled>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button> -->
                            <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="SaveAlarm()">Save</button>
                          </div>
                        </form>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="" id="formid2" method='post'>
                          <div class="box-body">
                            <div class="row">
                              <!-- <div class="callout callout-info">
                                <h4>Note</h4>
                                <p>Follow the steps to continue to payment.</p>
                              </div> -->
                              <div id="note"></div>
                              <div class="form-group">
                                <label>NOTES</label>
                                <input type="hidden" name="id_alarm" id="id_alarm2">
                                <textarea  name="note" class="form-control" rows=""></textarea>
                              </div>
                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="SaveNoteAlarm()">Save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

                <!--DETAIL ALARM-->
                <div class="modal fade" id="detail_alarm">
                  <div class="modal-dialog" style="width: 1000px">
                    <div class="modal-content" >
                      <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Detail Alarm</h4>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="" method='post'>
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Remote Name</label>
                                  <input type="text" name="remote_name" id="remote_name2" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Remote Type</label>
                                  <input type="text" name="remote_type" id="remote_type2" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Region</label>
                                  <input type="text" name="region" id="region2" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Main Branch</label>
                                  <input type="text" name="main_branch" id="main_branch2" class="form-control" disabled>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Branch Code</label>
                                  <input type="text" name="branch_code" id="branch_code2" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>IP Address</label>
                                  <input type="text" name="ip_address" id="ip_address2" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Provider</label>
                                  <input type="text" name="provider" id="provider2" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Network Type</label>
                                  <input type="text" name="jenis_jarkom" id="jenis_jarkom2" class="form-control" disabled>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Current State</label>
                                  <input type="text" name="current_state" id="current_state2" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Ack Time</label>
                                  <input type="text" name="ack_at" id="ack_at2" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Ack By</label>
                                  <input type="text" name="ack_by" id="ack_by2" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                  <label>Type Alarm</label>
                                  <select class="form-control" name="alarm_type" disabled>
                                    <option id="alarm_type20" value="0">--Choose Type--</option>
                                    <?php foreach ($type_alarm as $ta) {?>
                                    <option value="<?php echo $ta->id;?>" id="alarm_type<?php echo $ta->id;?>">
                                      <?php echo $ta->alarm_type;?>
                                    </option>
                                  <?php }?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Clear Time</label>
                                  <input type="text" name="stop_at" id="stop_at2" class="form-control" value="" disabled>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

                <!--HISTORY ALARM-->
                <div class="modal fade" id="HISTORY">
                  <div class="modal-dialog" style="width: 1200px">
                    <div class="modal-content" >
                      <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">History Alarm</h4>
                      </div>
                      <div class="modal-body">
                        <table class="table table-bordered table-striped table-hover" id="table_data" >
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Alarm Id</th>
                              <!-- <th>Remote Name</th>
                              <th>Remote Type</th>
                              <th>Region</th>
                              <th>Main Branch</th>
                              <th>Branch Code</th>
                              <th>IP Address</th> -->
                              <!-- <th>Priority</th> -->
                              <th>Provider</th>
                              <th>Network Type</th>
                              <th>Current State</th>
                              <th>Ack Time</th>
                              <th>Acked By</th>
                              <th>Alarm Start</th>
                              <th>Alarm End</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

        
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
                
                      <div class="panel panel-default" style="display:inline-block;margin:5px;">
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
                              <?php if($jar->status==1){?>
                              <tr>
                                <th>STATUS ALARM</th>
                                <td style="width: 10px">:</td>
                                <td>
                                <?php
                                    if ($jar->status_alarm==2) {
                                      echo '<span class="label label-danger">ALARM, UNACKED</span>';
                                    }else if($jar->status_alarm==3){
                                      echo '<span class="label label-danger">ALARM, ACKED</span>';
                                    }
                                ?>
                                </td>
                              </tr>
                            <?php }?>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah" onclick="getID()">
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
      <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
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
                  <div class="form-group">
                    <label>Network ID</label>
                    <input type="text" name="kode_jarkom" id="kode_jarkom" class="form-control">
                  </div>
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
        <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
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
        <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
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


  $(document).ready(function(){
	  initialize();
    AlarmRemote(<?php echo $data[0]->id_remote;?>);
  });

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

  function AlarmRemote(id_remote){

    $("#table_data").DataTable({
      processing:true,
      serverSide:true,
      columns:[
        {data:"No"},
        {data:"Site Id"},
        // {data:"Remote Name"},
        // {data:"Remote Type"},
        // {data:"Region"},
        // {data:"Main Branch"},
        // {data:"Branch Code"},
        // {data:"IP Address"},
        // {data:"Priority"},
        {data:"Provider"},
        {data:"Network Type"},
        {data:"Current Type"},
        {data:"Ack Time"},
        {data:"Acked By"},
        {data:"Alarm Start"},
        {data:"Alarm End"}
      ],
      columnDefs:[
        {
          targets:[0,3],
          orderable:false
        }
      ],
      ajax:{
        url:"<?php echo base_url().'index.php/Master/GetAlarmRemote/';?>"+id_remote,
        type:"post",
        dataType:"json"

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

  function getID() {
    $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url()?>index.php/Dashboard/add_jarkom',
        async : false,
        dataType : 'JSON',
        success : function(data){
            console.log(data);
            $("#kode_jarkom").val(data);
        }

    });
  }

  function GetAlarm(id){
    //alert('masoook');
    var url="<?php echo base_url(); ?>index.php/Master/Getdata_Alarm";

    //ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: {id:id},
        dataType: "JSON",
        success: function(data)
        {
            //alert(data.kode_jarkom);
            if (data.alarm_type==null) {data.alarm_type=0;}

            if (data.current_state == 1 || data.current_state == 2) {data.current_state='Active,Unack';}
            if (data.current_state == 3 || data.current_state == 4) {data.current_state='Active,Ack';}
            if (data.current_state == 9) {data.current_state='Cleared,Unack';}
            if (data.current_state == 10) {data.current_state='CLeared,Ack';}

            //note = [];
            note = data.notes;
            tamp='';

            for (var i = 0; i < note.length; i++) {
                tamp += '<div class="callout callout-info"><h4>Noted By : '+note[i]['user_create']+' | Date : '+note[i]['create_at']+'</h4><p>'+note[i]['notes']+'</p></div>';
            }

            document.getElementById("note").innerHTML = tamp;

            document.getElementById("alarm_type"+data.id_alarm_type).selected = "true";
            document.getElementById("id_alarm").value = data.id;
            document.getElementById("id_alarm2").value = data.id;
            document.getElementById("remote_name").value = data.remote_name;
            document.getElementById("remote_type").value = data.remote_type;
            document.getElementById("jenis_jarkom").value = data.jenis_jarkom;
            document.getElementById("region").value = data.region;
            document.getElementById("main_branch").value = data.main_branch;
            document.getElementById("branch_code").value = data.branch_code;
            document.getElementById("provider").value = data.provider;
            document.getElementById("ip_address").value = data.ip_address;
            document.getElementById("current_state").value = data.current_state;
            document.getElementById("ack_by").value = data.user_acked;
            document.getElementById("ack_at").value = data.ack_at;
            document.getElementById("stop_at").value = data.stop_at;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops","Error Get Data", "error");
 
        }
    });
  }

  function DetailAlarm(id){
    //alert('masoook');
    var url="<?php echo base_url(); ?>index.php/Master/Detail_Alarm";

    //ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: {id:id},
        dataType: "JSON",
        success: function(data)
        {
            //alert(data.kode_jarkom);
            if (data.alarm_type==null) {data.alarm_type=0;}

            if (data.current_state == 1 || data.current_state == 2) {data.current_state='Active,Unack';}
            if (data.current_state == 3 || data.current_state == 4) {data.current_state='Active,Ack';}
            if (data.current_state == 9) {data.current_state='Cleared,Unack';}
            if (data.current_state == 10) {data.current_state='CLeared,Ack';}

            document.getElementById("alarm_type2"+data.id_alarm_type).selected = "true";
            document.getElementById("remote_name2").value = data.remote_name;
            document.getElementById("remote_type2").value = data.remote_type;
            document.getElementById("jenis_jarkom2").value = data.jenis_jarkom;
            document.getElementById("region2").value = data.region;
            document.getElementById("main_branch2").value = data.main_branch;
            document.getElementById("branch_code2").value = data.branch_code;
            document.getElementById("provider2").value = data.provider;
            document.getElementById("ip_address2").value = data.ip_address;
            document.getElementById("current_state2").value = data.current_state;
            document.getElementById("ack_by2").value = data.user_acked;
            document.getElementById("ack_at2").value = data.ack_at;
            document.getElementById("stop_at2").value = data.stop_at;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops","Error Get Data", "error");
 
        }
    });
  }

  function HistoryAlarm(ip,id){
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

function ActionAckByRemote(url=''){
    //alert(url);
    $.ajax({
        url : url,
        //type: "POST",
        //data: $('#formid2').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          if (data==true) {
            swal({
                title:"Update Data Success!", 
                type: "success",
                timer: 20000,   
                confirmButtonText: "Ok"},
              function(){
                location.reload();
            });
          }else{
            swal("Oops","Error Update Data", "error");
          }
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error Insert Data');
            swal("Oops","Error Update Data", "error");
 
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
/*function initialize() {
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

function showmap()
{
	var lat    = new Array(); 
    var lng    = new Array(); 
    var mark   = new Array();
	var uker   = new Array();
	var titles = new Array();
	var anim   = new Array();
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
	
	var LeafIcon = L.Icon.extend({
		options: {
			//shadowUrl: 'leaf-shadow.png',
			iconSize:     [20, 31],
			//shadowSize:   [50, 64],
			iconAnchor:   [10, 31]
			//shadowAnchor: [4, 62],
			//popupAnchor:  [-3, -76]
		}
	});
	
	var ico0_3 = new LeafIcon({iconUrl: iconBase + 'i0-3.png'}), ico0_1 = new LeafIcon({iconUrl: iconBase + 'i0-1.png'}), ico0_ = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_null = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_nop = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_0 = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_10 = new LeafIcon({iconUrl: iconBase + 'i0-null.png'});
    var ico1_3 = new LeafIcon({iconUrl: iconBase + 'i1-3.png'}), ico1_1 = new LeafIcon({iconUrl: iconBase + 'i1-1.png'}), ico1_ = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_null = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_nop = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_0 = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_10 = new LeafIcon({iconUrl: iconBase + 'i1-null.png'});
    var ico2_3 = new LeafIcon({iconUrl: iconBase + 'i2-3.png'}), ico2_1 = new LeafIcon({iconUrl: iconBase + 'i2-1.png'}), ico2_ = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_null = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_nop = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_0 = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_10 = new LeafIcon({iconUrl: iconBase + 'i2-null.png'});
    var ico3_3 = new LeafIcon({iconUrl: iconBase + 'i3-3.png'}), ico3_1 = new LeafIcon({iconUrl: iconBase + 'i3-1.png'}), ico3_ = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_null = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_nop = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_0 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico4_3 = new LeafIcon({iconUrl: iconBase + 'i4-3.png'}), ico4_1 = new LeafIcon({iconUrl: iconBase + 'i4-1.png'}), ico4_ = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_null = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_nop = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_0 = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico5_3 = new LeafIcon({iconUrl: iconBase + 'i5-3.png'}), ico5_1 = new LeafIcon({iconUrl: iconBase + 'i5-1.png'}), ico5_ = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_null = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_nop = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_0 = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico6_3 = new LeafIcon({iconUrl: iconBase + 'i6-3.png'}), ico6_1 = new LeafIcon({iconUrl: iconBase + 'i6-1.png'}), ico6_ = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_null = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_nop = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_0 = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico7_3 = new LeafIcon({iconUrl: iconBase + 'i7-3.png'}), ico7_1 = new LeafIcon({iconUrl: iconBase + 'i7-1.png'}), ico7_ = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_null = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_nop = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_0 = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico8_3 = new LeafIcon({iconUrl: iconBase + 'i8-3.png'}), ico8_1 = new LeafIcon({iconUrl: iconBase + 'i8-1.png'}), ico8_ = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_null = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_nop = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_0 = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico9_3 = new LeafIcon({iconUrl: iconBase + 'i9-3.png'}), ico9_1 = new LeafIcon({iconUrl: iconBase + 'i9-1.png'}), ico9_ = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_null = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_nop = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_0 = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico10_3 = new LeafIcon({iconUrl: iconBase + 'i10-3.png'}), ico10_1 = new LeafIcon({iconUrl: iconBase + 'i10-1.png'}), ico10_ = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_null = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_nop = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_0 = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico11_3 = new LeafIcon({iconUrl: iconBase + 'i11-3.png'}), ico11_1 = new LeafIcon({iconUrl: iconBase + 'i11-1.png'}), ico11_ = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_null = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_nop = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_0 = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico12_3 = new LeafIcon({iconUrl: iconBase + 'i12-3.png'}), ico12_1 = new LeafIcon({iconUrl: iconBase + 'i12-1.png'}), ico12_ = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_null = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_nop = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_0 = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico13_3 = new LeafIcon({iconUrl: iconBase + 'i13-3.png'}), ico13_1 = new LeafIcon({iconUrl: iconBase + 'i13-1.png'}), ico13_ = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_null = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_nop = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_0 = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
	var ico14_3 = new LeafIcon({iconUrl: iconBase + 'i14-3.png'}), ico14_1 = new LeafIcon({iconUrl: iconBase + 'i14-1.png'}), ico14_ = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_null = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_nop = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_0 = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
	
	var icons = { ico0_3, ico0_1, ico0_null, ico0_, ico0_nop, ico0_0, ico0_10,
	ico1_3, ico1_1, ico1_null, ico1_, ico1_nop, ico1_0, ico1_10,
	ico2_3, ico2_1, ico2_null, ico2_, ico2_nop, ico2_0, ico2_10,
	ico3_3, ico3_1, ico3_null, ico3_,  ico3_nop, ico3_0, ico3_10,
	ico4_3, ico4_1, ico4_null, ico4_, ico4_nop, ico4_0, ico4_10,
	ico5_3, ico5_1, ico5_null, ico5_, ico5_nop, ico5_0, ico5_10,
	ico6_3, ico6_1, ico6_null, ico6_, ico6_nop, ico6_0, ico6_10,
	ico7_3, ico7_1, ico7_null, ico7_, ico7_nop, ico7_0, ico7_10,
	ico8_3, ico8_1, ico8_null, ico8_, ico8_nop, ico8_0, ico8_10,
	ico9_3, ico9_1, ico9_null, ico9_, ico9_nop, ico9_0, ico9_10,
	ico10_3, ico10_1, ico10_null, ico10_, ico10_nop, ico10_0, ico10_10,
	ico11_3, ico11_1, ico11_null, ico11_, ico11_nop, ico11_0, ico11_10,
	ico12_3, ico12_1, ico12_null, ico12_, ico12_nop, ico12_0, ico12_10,
	ico13_3, ico13_1, ico13_null, ico13_, ico13_nop, ico13_0, ico13_10,
	ico14_3, ico14_1, ico14_null, ico14_, ico14_nop, ico14_0, ico14_10};
	
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/getCenterMap'); ?>",
		dataType:'JSON',
        data:"kw=<?php echo $kode_kanwil;?>",
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{ 
			//alert(data['center'][0]['center_map']);
			//var center = data['center'][0]['center_map'];
			mymap = L.map('map-canvas').setView([data['center'][0]['latitude'],data['center'][0]['longitude']], 8);
			osmUrl='http://172.18.65.56/hot/{z}/{x}/{y}.png';
			osmAttrib='PT Bank Rakyat Indonesia (Persero) Tbk. | Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';

			L.tileLayer(osmUrl, {
				maxZoom: 20,
				attribution: osmAttrib
			}).addTo(mymap);
		}
	});	
}
*/

var mymap;
var osmUrl;
var osmAttrib;
var lat    = <?php echo $latitude;?>;
var lng    = <?php echo $longitude;?>;
var latinduk = <?php echo($locinduk[$data[0]->id_remote][0]->latitude); ?>;
var lnginduk = <?php echo($locinduk[$data[0]->id_remote][0]->longitude); ?>;

function initialize()
{
	//var centerlat = <?php echo $data[0]->latitude;?>;
	//var centerlng = <?php echo $data[0]->longitude;?>;
	if(lat==0 && lng==0)
	{
		mymap = L.map('map-canvas').setView([latinduk,lnginduk], 16);
	}
	else
	{
		mymap = L.map('map-canvas').setView([lat,lng], 16);
	}
	
	osmUrl='http://172.18.65.56/hot/{z}/{x}/{y}.png';
	osmAttrib='PT Bank Rakyat Indonesia (Persero) Tbk. | Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';

	L.tileLayer(osmUrl, {
		maxZoom: 20,
		attribution: osmAttrib
	}).addTo(mymap);
	
	getLocationOnMap();
}


function getLocationOnMap() {
 
    var mark   = new Array();
	var tipe   = new Array();
	var titles = new Array();
	var anim   = new Array();
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
	
	var LeafIcon = L.Icon.extend({
		options: {
			//shadowUrl: 'leaf-shadow.png',
			iconSize:     [20, 31],
			//shadowSize:   [50, 64],
			iconAnchor:   [10, 31]
			//shadowAnchor: [4, 62],
			//popupAnchor:  [-3, -76]
		}
	});
	
	var ico0_3 = new LeafIcon({iconUrl: iconBase + 'i0-3.png'}), ico0_1 = new LeafIcon({iconUrl: iconBase + 'i0-1.png'}), ico0_ = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_null = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_nop = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_0 = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_10 = new LeafIcon({iconUrl: iconBase + 'i0-null.png'});
    var ico1_3 = new LeafIcon({iconUrl: iconBase + 'i1-3.png'}), ico1_1 = new LeafIcon({iconUrl: iconBase + 'i1-1.png'}), ico1_ = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_null = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_nop = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_0 = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_10 = new LeafIcon({iconUrl: iconBase + 'i1-null.png'});
    var ico2_3 = new LeafIcon({iconUrl: iconBase + 'i2-3.png'}), ico2_1 = new LeafIcon({iconUrl: iconBase + 'i2-1.png'}), ico2_ = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_null = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_nop = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_0 = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_10 = new LeafIcon({iconUrl: iconBase + 'i2-null.png'});
    var ico3_3 = new LeafIcon({iconUrl: iconBase + 'i3-3.png'}), ico3_1 = new LeafIcon({iconUrl: iconBase + 'i3-1.png'}), ico3_ = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_null = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_nop = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_0 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico4_3 = new LeafIcon({iconUrl: iconBase + 'i4-3.png'}), ico4_1 = new LeafIcon({iconUrl: iconBase + 'i4-1.png'}), ico4_ = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_null = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_nop = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_0 = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico5_3 = new LeafIcon({iconUrl: iconBase + 'i5-3.png'}), ico5_1 = new LeafIcon({iconUrl: iconBase + 'i5-1.png'}), ico5_ = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_null = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_nop = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_0 = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico6_3 = new LeafIcon({iconUrl: iconBase + 'i6-3.png'}), ico6_1 = new LeafIcon({iconUrl: iconBase + 'i6-1.png'}), ico6_ = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_null = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_nop = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_0 = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico7_3 = new LeafIcon({iconUrl: iconBase + 'i7-3.png'}), ico7_1 = new LeafIcon({iconUrl: iconBase + 'i7-1.png'}), ico7_ = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_null = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_nop = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_0 = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico8_3 = new LeafIcon({iconUrl: iconBase + 'i8-3.png'}), ico8_1 = new LeafIcon({iconUrl: iconBase + 'i8-1.png'}), ico8_ = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_null = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_nop = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_0 = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico9_3 = new LeafIcon({iconUrl: iconBase + 'i9-3.png'}), ico9_1 = new LeafIcon({iconUrl: iconBase + 'i9-1.png'}), ico9_ = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_null = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_nop = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_0 = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico10_3 = new LeafIcon({iconUrl: iconBase + 'i10-3.png'}), ico10_1 = new LeafIcon({iconUrl: iconBase + 'i10-1.png'}), ico10_ = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_null = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_nop = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_0 = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico11_3 = new LeafIcon({iconUrl: iconBase + 'i11-3.png'}), ico11_1 = new LeafIcon({iconUrl: iconBase + 'i11-1.png'}), ico11_ = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_null = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_nop = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_0 = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico12_3 = new LeafIcon({iconUrl: iconBase + 'i12-3.png'}), ico12_1 = new LeafIcon({iconUrl: iconBase + 'i12-1.png'}), ico12_ = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_null = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_nop = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_0 = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico13_3 = new LeafIcon({iconUrl: iconBase + 'i13-3.png'}), ico13_1 = new LeafIcon({iconUrl: iconBase + 'i13-1.png'}), ico13_ = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_null = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_nop = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_0 = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
	var ico14_3 = new LeafIcon({iconUrl: iconBase + 'i14-3.png'}), ico14_1 = new LeafIcon({iconUrl: iconBase + 'i14-1.png'}), ico14_ = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_null = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_nop = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_0 = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
	
	var icons = { ico0_3, ico0_1, ico0_null, ico0_, ico0_nop, ico0_0, ico0_10,
	ico1_3, ico1_1, ico1_null, ico1_, ico1_nop, ico1_0, ico1_10,
	ico2_3, ico2_1, ico2_null, ico2_, ico2_nop, ico2_0, ico2_10,
	ico3_3, ico3_1, ico3_null, ico3_,  ico3_nop, ico3_0, ico3_10,
	ico4_3, ico4_1, ico4_null, ico4_, ico4_nop, ico4_0, ico4_10,
	ico5_3, ico5_1, ico5_null, ico5_, ico5_nop, ico5_0, ico5_10,
	ico6_3, ico6_1, ico6_null, ico6_, ico6_nop, ico6_0, ico6_10,
	ico7_3, ico7_1, ico7_null, ico7_, ico7_nop, ico7_0, ico7_10,
	ico8_3, ico8_1, ico8_null, ico8_, ico8_nop, ico8_0, ico8_10,
	ico9_3, ico9_1, ico9_null, ico9_, ico9_nop, ico9_0, ico9_10,
	ico10_3, ico10_1, ico10_null, ico10_, ico10_nop, ico10_0, ico10_10,
	ico11_3, ico11_1, ico11_null, ico11_, ico11_nop, ico11_0, ico11_10,
	ico12_3, ico12_1, ico12_null, ico12_, ico12_nop, ico12_0, ico12_10,
	ico13_3, ico13_1, ico13_null, ico13_, ico13_nop, ico13_0, ico13_10,
	ico14_3, ico14_1, ico14_null, ico14_, ico14_nop, ico14_0, ico14_10};
	
	//statusonoff = <?php echo $data[0]->status_onoff;?>;
    var iconmarker = icons['ico'+<?php echo $data[0]->kode_tipe_uker;?>+'_'+<?php echo ($data[0]->status_onoff!=NULL) ? $data[0]->status_onoff : 'null' ;?>];
	
	var marker;
	if(lat==0 && lng==0)
	{
		marker = L.marker([latinduk,lnginduk], {icon: iconmarker}).addTo(mymap);
	}
	else
	{
		marker = L.marker([lat,lng], {icon: iconmarker}).addTo(mymap);
	}
	
	
	marker.bounce();

}

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