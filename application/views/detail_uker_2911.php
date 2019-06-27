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
<!-- <script src="<?php //echo base_url(); ?>assets/sw/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php //echo base_url(); ?>assets/sw/sweetalert.css"> -->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/select2/dist/css/select2.min.css">
<!-- Select2 -->
<script src="<?php echo base_url(); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
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

function test() {
  swal("SUCCESS!", "", "success");
}
</script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section>
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kanwil[0]->kode_kanwil; ?>">Main Branch</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Remote/'.$data[0]->kode_kanca; ?>">Remote Group</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/data_uker/'.$data[0]->kode_kanca."/".$this->uri->segment(4); ?>">Remote List</a></li>
        <li class="active" style="color: #3C8DBC;">Remote Detail</li>
      </ol>
    </div>
</section>
<section class="content" id="full" style="background: white; margin-top: -20px">   
    <div class="row">
        <div class="panel panel-default" style="float: left;width:49%;">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">REMOTE DETAIL</div>     
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
                                }else{
                                  echo '<span class="label label-danger">DISABLE</span>';
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
                          <?php
                            if ($data[0]->kode_tipe_uker==7) {
                                echo "<th>ATM TID</th>";
                            }else{
                                echo "<th>BRANCH ID</th>";
                            }
                          ?>
                          <td style="width: 10px">:</td>
                          <td><?php 
                              if ($data[0]->kode_tipe_uker==7) {
                                  echo $data[0]->tid_atm;
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
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                  <i class="fa fa-edit"></i> Edit
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
                                        <div class="form-group">
                                          <label>REMOTE STATUS</label>
                                          <select class="form-control" name="kode_op">
                                            <option <?php echo $data[0]->kode_op== 1 ? 'selected' : ''?> >
                                              <span class="label label-success">OP</span>
                                            </option>
                                            <option <?php echo $data[0]->kode_op== 2 ? 'selected' : ''?> >
                                              <span class="label label-primary">NOP</span>
                                            </option>
                                            <option <?php echo $data[0]->kode_op== 0 ? 'selected' : ''?> >
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
                                          <input type="text" name="kode_uker" class="form-control" value="<?php echo $data[0]->kode_uker;?>">
                                        </div>
                                        <div class="form-group">
                                          <label>MAIN BRANCH</label>
                                          <select class="form-control" name="kode_kanca" <?php echo $data[0]->kode_tipe_uker == 2 ? 'disabled' : ''?>>
                                          <?php foreach ($kanca as $kc) {?>
                                            <option value="<?php echo $kc->kode_kanca;?>" 
                                              <?php echo $data[0]->kode_kanca == $kc->kode_kanca ? 'selected' : ''?> >
                                              <?php echo $kc->nama_kanca;?>
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
                                            <input type="text" name="ip_lan" class="form-control" value="<?php echo $data[0]->ip_lan;?>" data-inputmask="'alias': 'ip'" data-mask >
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label>ADDRESS</label>
                                          <textarea  name="alamat" class="form-control" rows=""><?php echo $data[0]->alamat_uker;?></textarea>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>PIC PINCA</label>
                                          <input type="text" name="pic_pinca" class="form-control" value="<?php echo $data[0]->pic_pinca;?>" <?php echo $data[0]->kode_tipe_uker == 2 ? 'disabled' : ''?>>
                                        </div>
                                        <div class="form-group">
                                          <label>PIC SPO</label>
                                          <input type="text" name="pic_spo" class="form-control" value="<?php echo $data[0]->pic_spo;?>" <?php echo $data[0]->kode_tipe_uker == 2 ? 'disabled' : ''?>>
                                        </div>
                                        <div class="form-group">
                                          <label>PET IT</label>
                                          <input type="text" name="pet_it" class="form-control" value="<?php echo $data[0]->pet_it;?>" <?php echo $data[0]->kode_tipe_uker == 2 ? 'disabled' : ''?>>
                                        </div>
                                        <div class="form-group">
                                          <label>PIC REMOTE</label>
                                          <input type="text" name="pic_uker" class="form-control" value="<?php echo $data[0]->nama_pic;?>">
                                        </div>
                                        <div class="form-group">
                                          <label>TELP. REMOTE</label>
                                          <input type="text" name="telp" class="form-control" value="<?php echo $data[0]->telp_uker;?>">
                                        </div>
                                        <div class="form-group">
                                          <label>NOTE</label>
                                          <textarea name="keterangan" class="form-control" rows="3" placeholder="Enter ..."><?php echo $data[0]->keterangan;?></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.box-body -->

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
                                        }else{
                                          echo '<span class="label label-danger">BRISAT/'.$jar->nickname_provider.'</span><br>';
                                        }
                                      }else{
                                        if ($jar->status==3) {
                                          echo '<span class="label label-success">'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                        }else{
                                          echo '<span class="label label-danger">'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
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
                                  if ($jar->kode_jarkom==1) {
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
                                  ?>
                                </td>
                              </tr>
                          </table>
                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?php echo $jar->kode_jarkom;?>">
                            <i class="fa fa-edit"></i> Edit
                          </button>
                          </div>
                      </div>
                    
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
                                        <label>IP WAN</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-laptop"></i>
                                          </div>
                                          <input type="text" name="ip_wan" class="form-control" value="<?php echo $jar->ip_wan;?>" data-inputmask="'alias': 'ip'" data-mask >
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Network Type</label>
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
                  <?php $no++; }?>
        </div>
    </div>
    </div>
</section>
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
$('.select2').select2();
//Money Euro
$('[data-mask]').inputmask();
//Timepicker
$('.timepicker').timepicker({
  showInputs: false,
  timeFormat: 'H:mm:ss'
});
var map;
function initialize() {
    var mark  = new Array();

    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
   
    var icons = {
      ico0_3: iconBase + 'i0-3.png' ,  ico0_1: iconBase + 'i0-1.png' ,
      ico1_3: iconBase + 'i1-3.png' ,  ico1_1: iconBase + 'i1-1.png' ,
      ico2_3: iconBase + 'i2-3.png' ,  ico2_1: iconBase + 'i2-1.png' ,
      ico3_3: iconBase + 'i3-3.png' ,  ico3_1: iconBase + 'i3-1.png' ,
      ico4_3: iconBase + 'i4-3.png' ,  ico4_1: iconBase + 'i4-1.png' ,
      ico5_3: iconBase + 'i5-3.png' ,  ico5_1: iconBase + 'i5-1.png' ,
      ico6_3: iconBase + 'i6-3.png' ,  ico6_1: iconBase + 'i6-1.png' ,
      ico7_3: iconBase + 'i7-3.png' ,  ico7_1: iconBase + 'i7-1.png', 
      ico8_3: iconBase + 'i8-3.png' ,  ico8_1: iconBase + 'i8-1.png',
      ico9_3: iconBase + 'i9-3.png' ,  ico9_1: iconBase + 'i9-1.png',
      ico10_3: iconBase + 'i10-3.png' , ico10_1: iconBase + 'i10-1.png',
      ico11_3: iconBase + 'i11-3.png' , ico11_1: iconBase + 'i11-1.png',
      ico12_3: iconBase + 'i12-3.png' , ico12_1: iconBase + 'i12-1.png'      
      };

    var mapOptions = {
        mapTypeId: 'roadmap',
        zoom: 15,
        center: new google.maps.LatLng(<?php echo $data[0]->lat;?>, <?php echo $data[0]->long;?>)
    };
    var mark = icons['ico'+<?php echo $data[0]->kode_tipe_uker;?>+'_'+<?php echo $data[0]->status_onoff;?>];;
    var letak = new google.maps.LatLng(<?php echo $data[0]->lat;?>, <?php echo $data[0]->long;?>);
    map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
    var marker=new google.maps.Marker({ position:letak, icon:mark,title:"<?php echo $data[0]->tipe_uker.' '.$data[0]->nama_remote;?>" });
    marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);


</script>
<!-- <div id="map-canvas"></div> -->

<!--comment-->
<!--  <div class="form-group">
                                          <label>START NOP</label>
                                          <br>Hour
                                          <select class="form-control" name="H" style="width: 30%"  >
                                            <?php for ($H=1; $H <=60 ; $H++) {?>
                                              <option value="<?php echo $H;?>" <?php echo $st_H == $H ? 'selected' : ''?> >
                                                <?php echo $H;?>
                                              </option>
                                            <?php }?>
                                          </select><br>
                                          Minute
                                          <select class="form-control" name="i" style="width: 30%"  >
                                            <?php for ($i=1; $i <=60 ; $i++) {?>
                                              <option value="<?php echo $i;?>" <?php echo $st_i == $i ? 'selected' : ''?> >
                                               <?php echo $i;?>
                                              </option>
                                            <?php }?>
                                          </select><br>
                                          Seconds
                                          <select class="form-control" name="s" style="width: 30%"  >
                                            <?php for ($s=1; $s <=60 ; $s++) {?>
                                              <option value="<?php echo $s;?>" <?php echo $st_s == $s ? 'selected' : ''?> >
                                                <?php echo $s;?>
                                              </option>
                                            <?php }?>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label>END NOP</label>
                                          <br>Hour
                                          <select class="form-control" name="H" style="width: 30%"  >
                                            <?php for ($H=1; $H <=60 ; $H++) {?>
                                              <option value="<?php echo $H;?>" <?php echo $end_H == $H ? 'selected' : ''?> >
                                                <?php echo $H;?>
                                              </option>
                                            <?php }?>
                                          </select><br>
                                          Minute
                                          <select class="form-control" name="i" style="width: 30%"  >
                                            <?php for ($i=1; $i <=60 ; $i++) {?>
                                              <option value="<?php echo $i;?>" <?php echo $end_i == $i ? 'selected' : ''?> >
                                               <?php echo $i;?>
                                              </option>
                                            <?php }?>
                                          </select><br>
                                          Seconds
                                          <select class="form-control" name="s" style="width: 30%"  >
                                            <?php for ($s=1; $s <=60 ; $s++) {?>
                                              <option value="<?php echo $s;?>" <?php echo $end_s == $s ? 'selected' : ''?> >
                                                <?php echo $s;?>
                                              </option>
                                            <?php }?>
                                          </select>
                                        </div> -->
