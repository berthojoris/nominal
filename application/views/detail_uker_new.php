<script type="text/javascript">
function isEven(n) {
   return n % 2 == 0;
}

function isOdd(n) {
   return Math.abs(n % 2) == 1;
}

$(document).ready(function() {
    // initialize();
    var formData = $("#formTicketRemedy").serialize();
    var urlCreateTicket="<?php echo base_url(); ?>index.php/Dashboard/insertTicket";
    var ticketApi = "<?php echo base_url(); ?>index.php/Dashboard/tiketapi/"+$("#txtIPLan").val();
    $("#formCounter").val(0);
    $("#appendData").empty();
    $("#createTicket").prop("disabled", false);

    $('#tiketRemedy').on('hide.bs.modal', function (e) {
        $("#appendData").empty();
        $("#formCounter").val(0);
        $("#addForm").show();
        $("#deleteForm").hide();
    });

    $("#deleteForm").click(function (e) { 
        e.preventDefault();
        $("#formCounter").val(0);
        $("#appendData").empty();
        $("#addForm").show();
        $(this).hide();
    });

    $("#addForm").click(function (e) {
        e.preventDefault();
        var cloneElement = `
            <div class="panelGanjil">
                <div class="form-group">
                    <label>Jenis</label>
                    <select class="form-control" id="type" name="type[]">
                        <option value="remote">Remote</option>
                        <option value="jarkom">Jarkom</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ID Remote</label>
                    <input type="text" name="remote_id[]" id="remote_id" class="form-control">
                </div>
                <div class="form-group">
                    <label>User Creator</label>
                    <input type="text" name="created_by[]" id="created_by" value="<?php echo $this->session->userdata('nama'); ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Last Check</label>
                    <input type="text" name="last_check[]" id="last_check" class="form-control">
                </div>
                <div class="form-group">
                    <label>Status Ticket</label>
                    <input type="text" name="status_ticket[]" id="status_ticket" class="form-control">
                </div>
                <div class="form-group">
                    <label>Incident Number</label>
                    <input type="text" name="incident_number[]" id="incident_number" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="remote_ticket_description[]" id="remote_ticket_description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="remote_ticket_notes[]" id="remote_ticket_notes" class="form-control"></textarea>
                </div>
                <div class="panelGenap">
                    <div class="form-group">
                        <label>Branch</label>
                        <input type="text" name="branch" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>IP Address</label>
                        <input type="text" name="ip_address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Uker</label>
                        <input type="text" name="nama_uker" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Provide Jarkom</label>
                        <input type="text" name="provider_jarkom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Permasalahan</label>
                        <input type="text" name="permasalahan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Action</label>
                        <input type="text" name="action" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Pool</label>
                        <input type="text" name="pool" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>PIC</label>
                        <input type="text" name="pic" class="form-control">
                    </div>
                </div>
            </div>
        `;
        $("#formCounter").val(1);
        $("#appendData").append(cloneElement);
        $("#deleteForm").show();
        $(this).hide();
    });

    $("#submitTiketRemedy").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: urlCreateTicket,
            data: formData,
            dataType: "json",
            success: function (response) {
                console.log(response)
            }
        });
    });

    $('#tiketRemedy').on('show.bs.modal', function (e) {
        $("#createTicket").prop("disabled", true);
        $.ajax({
            type: "GET",
            url: ticketApi,
            dataType: "json",
            success: function (response) {
                $("#createTicket").prop("disabled", false);
                $("#incident_number").val(response.incident_number);
                $("#status_ticket").val(response.status);
                $("#remote_ticket_description").val(response.description);
                $("#remote_ticket_notes").val(response.notes);
            },
            error: function(response) {
                
            }
        });
    });

});
</script>
<style type="text/css">
th {
    width: 180px;
    font-size: 14px;
}
td {
    font-size: 14px;
}
a {
    color : #777777;
}
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
.loader {
    border: 5px solid #f3f3f3; /* Light grey */
    border-top: 5px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
}
@keyframes spin {
0% { transform: rotate(0deg); }
100% { transform: rotate(360deg); }
}
.panelGanjil {
    background-color: #D6F2FF;
    padding: 20px;
}
.panelGenap {
    background-color: #FFE8D6;
    padding: 20px;
}
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
    $(function () {
      $('.selectpicker').selectpicker();
    }); 
    
    
    $(document).ready(function(){
    	$("#loading").hide();
    	$("#panel-for-ports").hide();
    	$("#div-graph").hide();
        $("#appendData").empty();
    });
    
    function edit_jarkom(kodeja) {
      //alert('masoook');
      var url="<?php echo base_url(); ?>index.php/Dashboard/edit_jarkom";
    
        //ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_edit').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                swal({
                    title:"Edit Data Network Success!", 
                    type: "success",
                    timer: 20000,   
                    confirmButtonText: "Ok"},
                  function(){
                    location.reload();
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops","Error Edit Data Network", "error");
     
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
        document.getElementById("form_brisat").disabled = true;
      }else{
        document.getElementById('form_brisat').selectedIndex = '0';
        document.getElementById("form_brisat").disabled = false;
      }
    }
    
    function cek_brisat() {
      //alert('test');
      var brisat = $("#form_brisat").val();
      if (brisat != '2') {
        document.getElementById("form_brisatbat").disabled = true;
      }else{
        document.getElementById("form_brisatbat").disabled = false;
      }
    }
    
    function pilih_brisat2() {
      //alert('test');
      var jenis_jarkom = $("#edit-kode_jenis_jarkom").val();
      if (jenis_jarkom != 1) {
        document.getElementById('edit-brisat').selectedIndex = '1';
        document.getElementById("edit-brisat").disabled = true;
      }else{
        document.getElementById('edit-brisat').selectedIndex = '0';
        document.getElementById("edit-brisat").disabled = false;
      }
    }
    
    function cek_brisat2() {
      //alert('test');
      var brisat = $("#edit-brisat").val();
      if (brisat != '2') {
        document.getElementById("edit-brisat_batch").disabled = true;
      }else{
        document.getElementById("edit-brisat_batch").disabled = false;
      }
    }
    
    function cek_jenis_jarkom() {
      //alert('test');
      var jenis_jarkom = $("#form_network_type2").val();
      if (jenis_jarkom != 1) {
        document.getElementById('form_brisat2').selectedIndex = '1';
        document.getElementById("form_brisat2").disabled = true;
      }else{
        document.getElementById('form_brisat2').selectedIndex = '0';
        document.getElementById("form_brisat2").disabled = false;
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
                        <td>
                        <?php echo $data[0]->ip_lan;?>
                        <input type="hidden" name="txtIPLan" id="txtIPLan" value="<?php echo $data[0]->ip_lan ?>">
                        </td>
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
                    <?php
                        if ($data[0]->kode_tipe_uker==7) {
                        ?>
                    <tr>
                        <th>CRO</th>
                        <td style="width: 10px">:</td>
                        <td><?php foreach ($tid_atm[$data[0]->id_remote] as $tid_atms) {
                            echo $tid_atms->name_head." | ".$tid_atms->name_head." | ".$tid_atms->telp."<br>"; break;
                             }?>
                        </td>
                    </tr>
                    <?php }?>
                    <tr>
                        <th>NOTE REMOTE</th>
                        <td style="width: 10px">:</td>
                        <td><?php echo $data[0]->keterangan;?></td>
                    </tr>
                    <?php if (isset($militan)) {
                        echo $militan;
                        } ?>
                    <tr>
                        <th>NOTE ALARM</th>
                        <td style="width: 10px">:</td>
                        <td><?php echo $data[0]->notes_alarm;?></td>
                    </tr>
                    <tr>
                        <th>STATUS ALARM</th>
                        <td style="width: 10px">:</td>
                        <td>
                            <div style="float: left;margin-right: 5px">
                                <?php
                                    if ($data[0]->status_alarm==2 || ($data[0]->status_alarm==3 && $data[0]->id_alarm_type<=0) || ($data[0]->status_alarm==4 && $data[0]->id_alarm_type<=0)) {
                                    echo '<span class="label label-danger">UNACKED</span>';
                                    }else
                                     if( ($data[0]->status_alarm==3 && $data[0]->id_alarm_type>0) || ($data[0]->status_alarm==4 && $data[0]->id_alarm_type>0) ){
                                    echo '<span class="label label-warning">ACKED</span>';
                                    }else{
                                    echo '<span class="label label-default">NONE</span>';
                                    }
                                    ?>
                                <?php if($data[0]->status_onoff==1){?>
                                <button type="button" class="btn-xs btn-primary" data-toggle="modal" data-target="#detail_alarm" onclick="DetailAlarm(<?php echo $data[0]->id_remote;?>)">
                                Detail Alarm
                                </button>
                                <?php }?>
                                <button type="button" class="btn-xs btn-primary" data-toggle="modal" data-target="#HISTORY">
                                History Alarm
                                </button>
                                <?php
                                    if($data[0]->kode_op==1) {
                                        echo '<button type="button" class="btn-xs btn-primary" data-toggle="modal" data-target="#tiketRemedy">Tiket Remedy</button>';
                                    }
                                ?>
                            </div>
                            <?php if($data[0]->status_onoff==1 && in_array($this->session->userdata('role'),array(1,5))){?>
                            <div class="input-group-btn">
                                <button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
                                <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    <!-- <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" onclick="ActionAckByRemote('<?php //echo base_url().'index.php/Master/ActionAckByRemote/'.$data[0]->id_remote.'/'.$data[0]->status_alarm;?>')">Ack</button></li> -->
                                    <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" data-toggle="modal" data-target="#edit_alarm" onclick="GetAlarmRemote(<?php echo $data[0]->id_remote;?>)">Edit Alarm</button></li>
                                </ul>
                            </div>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <?php if (in_array($this->session->userdata('role'),array(1,5,6,7))) {?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-edit"></i> Edit
                            </button>
                            <?php }?>
                            <button type="button" class="btn btn-primary" onclick="ping_sweep('<?php echo $data[0]->ip_lan;?>','#show_data')" data-toggle="modal" data-target="#PING">
                            <i class="fa fa-search"></i> Check Device Online
                            </button>
                            <button type="button" class="btn btn-primary" onclick="get_ports('<?php echo $data[0]->ip_lan;?>');" >
                            <i class="fa fa-plus-square"></i> Show Ports
                            </button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_ipmonitoring">
                            <i class="fa fa-edit"></i> Edit IP Monitoring
                            </button>
                            <div class="loader" style="float:right;" id="loading" ></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!--Edit IP Monitoring-->
        <div class="modal fade" id="edit_ipmonitoring">
            <div class="modal-dialog" style="width: 400px">
                <div class="modal-content" >
                    <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit IP Monitoring</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="" id="form_ipmonitoring" method='post'>
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label>IP Monitoring</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-laptop"></i>
                                            </div>
                                            <input type="text" name="ip_monitoring" class="form-control" value="<?php echo $data[0]->ip_monitoring;?>" data-inputmask="'alias': 'ip'" data-mask>
                                            <input type="hidden" name="ip_monitoring_old" class="form-control" value="<?php echo $data[0]->ip_monitoring;?>">
                                            <input type="hidden" name="id_remote" value="<?php echo $data[0]->id_remote;?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                                <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="Edit_ipmonitoring()">Save</button>
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
                                            <input type="text" name="nama_remote" class="form-control" value="<?php echo $data[0]->nama_remote;?>" <?php if( !in_array($this->session->userdata('role'),array(1,5)) ) { echo 'readonly';}?>>
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
                                            <select class="form-control" name="kode_op"<?php if( !in_array($this->session->userdata('role'),array(1,5)) ) { echo 'disabled';}?>>
                                                <option <?php echo $data[0]->kode_op== 1 ? 'selected' : ''?> value="1">
                                                    <span class="label label-success">OP</span>
                                                </option>
                                                <option <?php echo $data[0]->kode_op== 2 ? 'selected' : ''?> value="2">
                                                    <span class="label label-primary">NOP</span>
                                                </option>
                                                <?php if($this->session->userdata('role')==1) { ?>
                                                <option <?php echo $data[0]->kode_op== 0 ? 'selected' : ''?> value="0">
                                                    <span class="label label-danger">DISABLE</span>
                                                </option>
                                                <?php }?>
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
                                            <input type="text" name="kode_uker" maxlength="5" class="form-control" value="<?php echo $data[0]->kode_uker;?>" <?php echo $this->session->userdata('role') != 1 ? 'readonly' : ''?>">
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
                                            <input type="hidden" name="kode_kanca2" class="form-control" value="<?php echo $data[0]->kode_kanca;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>IP LAN</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-laptop"></i>
                                                </div>
                                                <input type="text" name="ip_lan" class="form-control" value="<?php echo $data[0]->ip_lan;?>" data-inputmask="'alias': 'ip'" data-mask <?php echo $this->session->userdata('role') != 1 ? 'readonly' : ''?>>
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
                                            <textarea name="pic_kanwil" id="pic_kanwil" class="form-control" rows="3" placeholder="Enter ..." <?php if( !in_array($this->session->userdata('role'),array(1,5,6)) ) { echo 'readonly';}?>><?php echo $data[0]->pic_kanwil;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC PINCA</label>
                                            <input type="text" name="pic_pinca" id="pic_pinca" class="form-control" value="<?php echo $data[0]->pic_pinca;?>" <?php if( !in_array($this->session->userdata('role'),array(1,5,6)) ) { echo 'readonly';}?>>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC SPO</label>
                                            <input type="text" name="pic_spo" id="pic_spo" class="form-control" value="<?php echo $data[0]->pic_spo;?>" <?php if( !in_array($this->session->userdata('role'),array(1,5,6)) ) { echo 'readonly';}?>>
                                        </div>
                                        <div class="form-group">
                                            <label>PET IT</label>
                                            <!-- <input type="text" name="pet_it" class="form-control" value="<?php //echo $data[0]->pet_it;?>" <?php //if( !in_array($this->session->userdata('role'),array(1,6)) ) { echo 'disabled';}?>> -->
                                            <textarea name="pet_it" id="pet_it" class="form-control" rows="3" placeholder="Enter ..." <?php if( !in_array($this->session->userdata('role'),array(1,5,6)) ) { echo 'readonly';}?>><?php echo $data[0]->pet_it;?></textarea>
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
                        <h4 class="modal-title">Edit Alarm Remote</h4>
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
                                                <option id="alarm_type0" value="XXX">--Choose Type--</option>
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
                                        <textarea  name="note" class="form-control" rows="" <?php echo $this->session->userdata('role') == 10 ? 'readonly' : ''?>></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="SaveNoteAlarm()" <?php echo $this->session->userdata('role') == 10 ? 'disabled' : ''?>>Save</button>
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
                        <h4 class="modal-title">Detail Alarm Remote</h4>
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
                                        <div class="form-group">
                                            <label>PIC Remote</label>
                                            <input type="text" name="main_branch" id="pic_uko2" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC PINCA</label>
                                            <input type="text" name="main_branch" id="pic_pinca2" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Start Alarm</label>
                                            <input type="text" name="start_alarm" id="start_alarm" class="form-control" disabled>
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
                                        <div class="form-group">
                                            <label>PIC Region</label>
                                            <input type="text" name="main_branch" id="pic_kanwil2" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC SPO</label>
                                            <input type="text" name="main_branch" id="pic_spo2" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Stop Alarm</label>
                                            <input type="text" name="stop_alarm" id="stop_alarm" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PET IT</label>
                                            <input type="text" name="main_branch" id="pet_it2" class="form-control" disabled>
                                        </div>
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
                                                <option id="id_alarm_type0" value="0">--Choose Type--</option>
                                                <?php foreach ($type_alarm as $ta) {?>
                                                <option value="<?php echo $ta->id;?>" id="id_alarm_type<?php echo $ta->id;?>">
                                                    <?php echo $ta->alarm_type;?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Clear Time</label>
                                            <input type="text" name="stop_at" id="stop_at2" class="form-control" value="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Priority</label>
                                            <input type="text" name="priority" id="priority" class="form-control" value="" disabled>
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
                                    <th>Alarm Type</th>
                                    <th>Provider</th>
                                    <th>Network Type</th>
                                    <th>Current State</th>
                                    <th>Ack Time</th>
                                    <th>Acked By</th>
                                    <th>Alarm Start</th>
                                    <th>Alarm End</th>
                                    <th>Last Note</th>
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

        <div class="modal fade" id="tiketRemedy">
            <div class="modal-dialog" style="width: 800px">
                <div class="modal-content" >
                    <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Tiket Remedy</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="formTicketRemedy" action="<?php echo base_url(); ?>index.php/Dashboard/insertTicket" method='post'>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jenis</label>
                                            <select class="form-control" id="type" name="type[]">
                                                <option value="remote">Remote</option>
                                                <option value="jarkom">Jarkom</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ID Remote</label>
                                            <input type="text" name="remote_id[]" id="remote_id" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>User Creator</label>
                                            <input type="text" name="created_by[]" id="created_by" value="<?php echo $this->session->userdata('nama'); ?>" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Check</label>
                                            <input type="text" name="last_check[]" id="last_check" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Status Ticket</label>
                                            <input type="text" name="status_ticket[]" id="status_ticket" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Incident Number</label>
                                            <input type="text" name="incident_number[]" id="incident_number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="remote_ticket_description[]" id="remote_ticket_description" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Notes</label>
                                            <input type="hidden" id="formCounter" name="formCounter">
                                            <textarea name="remote_ticket_notes[]" id="remote_ticket_notes" class="form-control"></textarea>
                                        </div>
                                        <hr>
                                        <div id="appendData"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="deleteForm" class="btn btn-danger" style="display: none;">Delete Notes</button>
                                <button id="addForm" class="btn btn-success">Add Notes</button>
                                <input id="createTicket" type="submit" class="btn btn-primary" value="Create Ticket">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default" style="width:49%;float: right;">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">REMOTE LOCATION</div>
            <div id="map-canvas" style="width:100%; height:400px;"></div>
        </div>
        <div class="panel panel-default" style="width:49%;float: right;" id="panel-for-ports">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">ROUTER PORTS
                <a style="float:right;color:white;" onclick="closePorts();" ><i class='fa fa-close' style="cursor:pointer;"></i></a>
            </div>
            <div id="ports-table" style="width:100%; height:272px;overflow:auto;">
                <table class="table table-bordered table-striped table-hover" id="table_ports" >
                    <thead>
                        <tr>
                            <th style='width:20px;'>No</th>
                            <th style='width:100px;'>Port Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row" id="div-graph">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <span id="portname"></span>&nbsp;-&nbsp;GRAPH<a style="float:right;color:white;" onclick="closeGraph();" ><i class='fa fa-close' style="cursor:pointer;"></i></a>
            </div>
            <div style="width:100%;height:100%;position:relative;" id="panel-graph">
            </div>
        </div>
    </div>
    <!-------------------->
    <div class="row">
        <div class="panel panel-default" style="width:100%;">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">NETWORK DETAIL</div>
            <div class="panel-body">
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
                                        $time = '';
                                           // if ($jar->brisat==1) {
                                           //   if ($jar->status==3) {
                                           //     echo '<span class="label label-success">BRISAT/'.$jar->nickname_provider.'</span><br>';
                                           //     $time = $jar->status_rec_date_l;
                                           //   }else if ($jar->status==1) {
                                           //     echo '<span class="label label-danger">BRISAT/'.$jar->nickname_provider.'</span><br>';
                                           //     $time = $jar->status_fail_date_l;
                                           //   }else {
                                           //     echo '<span class="label label-primary">BRISAT/'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                           //     $time = $jar->status_fail_date_l;
                                           //   }
                                           // }else{
                                             if ($jar->status==3) {
                                               echo '<span class="label label-success">'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                               $time = $jar->status_rec_date_l;
                                             }else if ($jar->status==1) {
                                               echo '<span class="label label-danger">'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                               $time = $jar->status_fail_date_l;
                                             }else {
                                               echo '<span class="label label-primary">'.$jar->jenis_jarkom.'/'.$jar->nickname_provider.'</span><br>';
                                               $time = $jar->status_fail_date_l;
                                             }
                                           // }
                                         
                                        ?>
                                </td>
                            </tr>
                            <tr>
                                <th>LAST CHANGE STATUS</th>
                                <td style="width: 10px">:</td>
                                <td><?php 
                                    //echo $datas->last_up;
                                    $firstTime = strtotime($time);
                                    $lastTime = strtotime(date('Y-m-d H:i:s'));
                                    $lama = (($lastTime - $firstTime) / 3600) / 24;
                                    $date_a = new DateTime($time);
                                    
                                    $date_b = new DateTime(date('Y-m-d H:i:s'));
                                    
                                    $interval = date_diff($date_a, $date_b);
                                    
                                    $lamane = $interval->format('%ad %hh %im %ss');   
                                    echo $lamane;?>		
                                </td>
                            </tr>
                            <tr>
                                <th>MEDIA</th>
                                <td style="width: 10px">:</td>
                                <td><?php echo $jar->media; ?></td>
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
                                    <?php echo $jar->brisat_name; ?>
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
                            <tr>
                                <th>STATUS ALARM</th>
                                <td style="width: 10px">:</td>
                                <td>
                                    <?php
                                        if ($jar->status_alarm==2) {
                                          echo '<span class="label label-danger">UNACKED</span>';
                                        }else if($jar->status_alarm==3 || $jar->status_alarm==4){
                                          echo '<span class="label label-warning">ACKED</span>';
                                        }else{
                                          echo '<span class="label label-default">NONE</span>';
                                        }
                                        ?>
                                </td>
                            </tr>
                            <tr>
                                <th>NOTE NETWORK</th>
                                <td style="width: 10px">:</td>
                                <td>
                                    <?php 
                                        echo $jar->keterangan;
                                        ?>
                                </td>
                            </tr>
                            <tr>
                                <th>NOTE ALARM</th>
                                <td style="width: 10px">:</td>
                                <td>
                                    <?php 
                                        echo $jar->notes_alarm;
                                        ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div style="float: left;margin-right: 5px">
                                        <?php if($jar->status==1){?>
                                        <button type="button" class="btn-xs btn-primary" data-toggle="modal" data-target="#detail_alarm2" onclick="DetailAlarm2('<?php echo $jar->id_jarkom;?>')">
                                        Detail Alarm
                                        </button>
                                        <?php }?>
                                        <button type="button" class="btn-xs btn-primary" data-toggle="modal" data-target="#table_history<?php echo $jar->id_jarkom;?>" onclick="AlarmJarkom('<?php echo $jar->id_jarkom;?>')">
                                        History Alarm
                                        </button>
                                    </div>
                                    <?php if($jar->status==1 && in_array($this->session->userdata('role'),array(1,5))){?>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
                                        <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" onclick="ActionAckByJarkom('<?php echo base_url().'index.php/Master/ActionAckByJarkom/'.$jar->id_jarkom.'/'.$jar->status_alarm;?>')">Ack</button></li>
                                            <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" data-toggle="modal" data-target="#edit_alarm" onclick="GetAlarmJarkom(<?php echo $jar->id_jarkom;?>)">Edit Alarm</button></li>
                                        </ul>
                                    </div>
                                    <?php }else if($jar->status==1 && $this->session->userdata('role')==10){
                                        if($this->session->userdata('provider')==$jar->kode_provider){
                                        ?>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
                                        <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu">
                                            <!-- <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" onclick="ActionAckByJarkom('<?php //echo base_url().'index.php/Master/ActionAckByJarkom/'.$jar->id_jarkom.'/'.$jar->status_alarm;?>')">Ack</button></li> -->
                                            <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" data-toggle="modal" data-target="#edit_alarm" onclick="GetAlarmJarkom(<?php echo $jar->id_jarkom;?>)">Edit Alarm</button></li>
                                        </ul>
                                    </div>
                                    <?php }}?>
                                </td>
                            </tr>
                        </table>
                        <?php if (in_array( $this->session->userdata('role'), array(1,5))) {?>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#form_edit_jarkom" onclick="Get_Jarkom('<?php echo $jar->kode_jarkom;?>')">
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
            <?php if (in_array( $this->session->userdata('role'), array(1,5))) {?>
            <button type="button" style="margin-left:20px;margin-bottom:20px;" class="btn btn-primary" data-toggle="modal" data-target="#tambah" onclick="getID()">
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
                                    <select class="form-control" name="brisat"  id="form_brisat" onchange="cek_brisat()" disabled>
                                        <option value="1"> BRISAT </option>
                                        <option value="2"> BRISAT JUPITER </option>
                                        <option value="0"> NON BRISAT </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>PHASE</label> 
                                    <select class="form-control" name="brisat"  id="form_brisatbat" disabled>
                                        <option value="A"> A </option>
                                        <option value="B"> B </option>
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
                                        <input type="text" name="ip_wan" class="form-control" value="<?php echo $data[0]->ip_lan;?>" data-inputmask="'alias': 'ip'" data-mask>
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
<!--EDIT JARKOM-->
<div class="modal fade" id="form_edit_jarkom">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Network</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="" id="form_edit<?php //echo $jar->kode_jarkom;?>" method='post'>
                    <div class="box-body">
                        <div class="row">
                            <input type="hidden" name="id_jarkom" id="edit-id_jarkom" value="<?php //echo $jar->id_jarkom;?>">
                            <input type="hidden" name="brisat_awal" id="edit-brisat_awal" value="<?php //echo $jar->brisat;?>">
                            <input type="hidden" name="id_remote"id="edit-id_remote" value="<?php //echo $jar->id_remote;?>">
                            <!-- <div class="col-md-6"> -->
                            <div class="form-group">
                                <label>Network ID</label>
                                <input type="text" name="kode_jarkom" id="edit-kode_jerkom" class="form-control" value="<?php //echo $jar->kode_jarkom;?>">
                            </div>
                            <div class="form-group">
                                <label>Provider</label>
                                <select class="form-control" name="kode_provider" id="edit-kode_provider">
                                    <?php foreach ($provider as $p) {?>
                                    <option value="<?php echo $p->kode_provider;?>" id="edit-kode_provider<?php echo $p->kode_provider;?>"
                                        <?php //echo $jar->kode_provider == $p->kode_provider ? 'selected' : ''?> >
                                        <?php echo $p->nickname_provider;?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Network Type</label>
                                <select class="form-control" name="kode_jenis_jarkom"  id="edit-kode_jenis_jarkom" onchange="pilih_brisat2()">
                                    <?php foreach ($jenis_jarkom as $jj) {?>
                                    <option value="<?php echo $jj->kode_jenis_jarkom;?>" id="edit-kode_jenis_jarkom<?php echo $jj->kode_jenis_jarkom;?>" 
                                        <?php //echo $jar->kode_jenis_jarkom == $jj->kode_jenis_jarkom ? 'selected' : ''?> >
                                        <?php echo $jj->jenis_jarkom;?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Used Status</label>
                                <select class="form-control" name="used_status" id="edit-used_status">
                                    <option value="1" id="edit-used_status1"
                                        <?php //echo $jar->used_status == 1 ? 'selected' : ''?> > Enable
                                    </option>
                                    <option value="0" id="edit-used_status2"
                                        <?php //echo $jar->used_status == 0 ? 'selected' : ''?> > Disable
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>BRISAT Yes/No</label>
                                <select class="form-control" name="brisat" id="edit-brisat" onchange="cek_brisat2()" disabled>
                                    <option value="1" id="edit-brisat1"
                                        <?php //echo $jar->brisat == "1" ? 'selected' : ''?> > BRISAT
                                    </option>
                                    <option value="2" id="edit-brisat2"
                                        <?php //echo $jar->brisat == "2"? 'selected' : ''?> > BRISAT JUPITER
                                    </option>
                                    <option value="0" id="edit-brisat0"
                                        <?php //echo $jar->brisat == "0" ? 'selected' : ''?> > NON BRISAT
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>PHASE</label> 
                                <select class="form-control" name="brisat_batch" id="edit-brisat_batch" disabled>
                                    <option value="A" id="edit-brisat_batchA" <?php //echo $jar->brisat_batch == "A" ? 'selected' : ''?> > A </option>
                                    <option value="B" id="edit-brisat_batchB" <?php //echo $jar->brisat_batch == "B" ? 'selected' : ''?> > B </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>IP WAN</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <input type="text" name="ip_wan" id="edit-ip_wan" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>BANDWIDTH</label>
                                <input type="text" name="bandwidth" id="edit-bandwidth" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="keterangan" id="edit-keterangan" class="form-control" rows="3"  value="" placeholder="Enter ..."></textarea>
                            </div>
                            <!-- /.input group -->
                            <!-- </div> -->
                        </div>
                    </div>
            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="edit_jarkom()">Save</button>
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
<?php $no=1; foreach ($jarkom[$data[0]->id_remote] as $jar){?>
<!--HISTORY ALARM-->
<div class="modal fade" id="table_history<?php echo $jar->id_jarkom;?>">
    <div class="modal-dialog" style="width: 1200px">
        <div class="modal-content" >
            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">History Alarm Network</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped table-hover" id="table_data_alarm<?php echo $jar->id_jarkom;?>" >
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
                            <th>Alarm Type</th>
                            <th>Provider</th>
                            <th>Network Type</th>
                            <th>Current State</th>
                            <th>Ack Time</th>
                            <th>Acked By</th>
                            <th>Alarm Start</th>
                            <th>Alarm End</th>
                            <th>Last Note</th>
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
<?php }?>
<!--DETAIL ALARM-->
<div class="modal fade" id="detail_alarm2">
    <div class="modal-dialog" style="width: 1000px">
        <div class="modal-content" >
            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Alarm Network</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="" method='post'>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Remote Name</label>
                                    <input type="text" name="remote_name" id="remote_name3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Remote Type</label>
                                    <input type="text" name="remote_type" id="remote_type3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Region</label>
                                    <input type="text" name="region" id="region3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Main Branch</label>
                                    <input type="text" name="main_branch" id="main_branch3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>PIC Remote</label>
                                    <input type="text" name="pic_uko" id="pic_uko3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>PIC PINCA</label>
                                    <input type="text" name="pic_pinca" id="pic_pinca3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Start Alarm</label>
                                    <input type="text" name="start_alarm" id="start_alarm2" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Branch Code</label>
                                    <input type="text" name="branch_code" id="branch_code3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>IP Address</label>
                                    <input type="text" name="ip_address" id="ip_address3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Provider</label>
                                    <input type="text" name="provider" id="provider3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Network Type</label>
                                    <input type="text" name="jenis_jarkom" id="jenis_jarkom3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>PIC Region</label>
                                    <input type="text" name="pic_kanwil" id="pic_kanwil3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>PIC SPO</label>
                                    <input type="text" name="pic_spo" id="pic_spo3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Stop Alarm</label>
                                    <input type="text" name="stop_alarm" id="stop_alarm2" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>PET IT</label>
                                    <input type="text" name="pet_it" id="pet_it3" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Current State</label>
                                    <input type="text" name="current_state" id="current_state3" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Ack Time</label>
                                    <input type="text" name="ack_at" id="ack_at3" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Ack By</label>
                                    <input type="text" name="ack_by" id="ack_by3" class="form-control" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Type Alarm</label>
                                    <select class="form-control" name="alarm_type3" disabled>
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
                                <div class="form-group">
                                    <label>Priority</label>
                                    <input type="text" name="priority" id="priority2" class="form-control" value="" disabled>
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
<!-- PORT GRAPHS -->
<div id="port-graph" style="height:200px;width:200px;"></div>
<!-- END PORT GRAPHS -->
<script type="text/javascript">
    $(document).ready(function(){
        // Bertho nonaktif AlarmRemote
    	AlarmRemote(<?php echo $data[0]->id_remote;?>);
    	initialize();
    });
    
    
    function Get_Jarkom(kode_jarkom="") {
    	document.getElementById("edit-brisat").disabled = true;
    	document.getElementById("edit-brisat_batch").disabled = true;
    	$.ajax({
          url   : "<?php echo site_url('Dashboard/Get_Jarkom') ?>",
          type  : 'POST',
          dataType: 'JSON',
          data  : {kode_jarkom:kode_jarkom},
          success : function(data){
            
          	//alert(data.id_jarkom);
          	document.getElementById("edit-id_jarkom").value = data.id_jarkom;
          	document.getElementById("edit-id_remote").value = data.id_remote;
          	document.getElementById("edit-ip_wan").value = data.ip_wan;
          	document.getElementById("edit-brisat_awal").value = data.brisat;
          	document.getElementById("edit-keterangan").value = data.keterangan;
          	document.getElementById("edit-bandwidth").value = data.bandwidth;
          	document.getElementById("edit-kode_jerkom").value = data.kode_jarkom;
          	document.getElementById("edit-kode_provider"+data.kode_provider).selected = "true";
          	document.getElementById("edit-used_status"+data.used_status).selected = "true";
          	document.getElementById("edit-kode_jenis_jarkom"+data.kode_jenis_jarkom).selected = "true";
          	document.getElementById("edit-brisat"+data.brisat).selected = "true";
          	document.getElementById("edit-brisat_batch"+data.brisat_batch).selected = "true";
    
          	if (data.kode_jenis_jarkom==1) {
          		document.getElementById("edit-brisat").disabled = false;
          	}
    
          	if (data.brisat==2) {
          		document.getElementById("edit-brisat_batch").disabled = false;
          	}
    
          }
        });
    
    }
    
    
    
    
    	function Edit_ipmonitoring() {
    
        	var url="<?php echo base_url()."index.php/Dashboard/Edit_ipmonitoring/"; ?>";
    
          //ajax adding data to database
          $.ajax({
              url : url,
              type: "POST",
              data: $('#form_ipmonitoring').serialize(),
              dataType: "JSON",
              success: function(data)
              {
                if (data==true) {
                  swal({
                      title:"Insert Data Success!", 
                      type: "success",
                      timer: 2000,   
                      confirmButtonText: "Ok"},
                    function(){
                      location.reload();
                  });
                }else{
                  swal("Oops","Error Insert Data", "error");
                }
                  
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error Insert Data');
                  swal("Oops","Error Insert Data", "error");
       
              }
          });
      	}
    
      function ping_sweep(ip,id){
          //alert('tes');
    	  $("#loading").show();
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
    			  $("#loading").hide();
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
          {data:"Alarm Type"},
          {data:"Provider"},
          {data:"Network Type"},
          {data:"Current Type"},
          {data:"Ack Time"},
          {data:"Acked By"},
          {data:"Alarm Start"},
          {data:"Alarm End"},
          {data:"Last Note"}
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
    
    function AlarmJarkom(id_jarkom=''){
      //alert(id_jarkom);
    
      $.fn.dataTable.ext.errMode = 'throw';
    
      $("#table_data_alarm"+id_jarkom).DataTable({
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
          {data:"Alarm Type"},
          {data:"Provider"},
          {data:"Network Type"},
          {data:"Current Type"},
          {data:"Ack Time"},
          {data:"Acked By"},
          {data:"Alarm Start"},
          {data:"Alarm End"},
          {data:"Last Note"}
        ],
        columnDefs:[
          {
            targets:[0,3],
            orderable:false
          }
        ],
        ajax:{
          url:"<?php echo base_url().'index.php/Master/GetAlarmJarkom/';?>"+id_jarkom,
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
      
      //cek graphs begin
        function get_ports(ip_lan) {
        $.ajax({
            type  : 'POST',
            url   : "<?php echo base_url().'index.php/Dashboard/get_ports/';?>"+ip_lan,
            //async : false,
            dataType : 'JSON',
            success : function(data){
                //console.log(data);
    			var html = "";
    			for(var i=0 ; i<data["ports"].length ; i++)
    			{
    				html += "<tr >";
    				html += "<td style='width:20px;'>"+(i+1)+"</td>";
    				html += "<td onclick=\"get_graph('"+ip_lan+"','"+data["ports"][i]["ifName"]+"');\" style='width:100px;'>"+data["ports"][i]["ifDescr"]+"</td>";
    				html += "<td>"+data["ports"][i]["ifAlias"]+"</td>";
    				html += "</tr>";
    			}
                $("#table_ports tbody").html(html);
    			$("#panel-for-ports").show();
    			//return data;
            }
    
        });
      }
      
    	function get_graph(ipaddr,iface) {
    		$.ajax({
    			type  : 'POST',
    			url   : "<?php echo base_url().'index.php/Dashboard/get_graphs/';?>"+ipaddr+"/"+iface,
    			//async : false,
    			//dataType:"image/jpeg",
    			success : function(data){
    				
    				$("#panel-graph").html(data);
    				$("#portname").html(iface);
    				
    				$("#div-graph").show();
    			}
    
    		});
    	}
      //cek graphs end
      
      function closePorts()
      {
    	  $("#panel-for-ports").hide();
    	  $("#table_ports tbody").html("");
      }
      
      function closeGraph()
      {
    	  $("#div-graph").hide();
    	  $("#panel-graph").html("");
      }
      
      
    
      function GetAlarmRemote(id){
        //alert('masoook');
        var url="<?php echo base_url(); ?>index.php/Master/Getdata_AlarmRemote";
    
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
                document.getElementById("alarm_type"+data.id_alarm_type).selected = "true";
    
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
    
      function GetAlarmJarkom(id){
        //alert('masoook');
        var url="<?php echo base_url(); ?>index.php/Master/Getdata_AlarmJarkom";
    
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
      var url="<?php echo base_url(); ?>index.php/Master/DetailAlarmById";
    
      //ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: {id:id,kode:'R'},
          dataType: "JSON",
          success: function(data)
          {
              //alert(data.kode_jarkom);
              if (data.id_alarm_type==null) {data.id_alarm_type=0;}
              document.getElementById("id_alarm_type"+data.id_alarm_type).selected = "true";
    
              if (data.current_state == 1 || data.current_state == 2) {data.current_state='Active,Unack';}
              if (data.current_state == 3 || data.current_state == 4) {data.current_state='Active,Ack';}
              if (data.current_state == 9) {data.current_state='Cleared,Unack';}
              if (data.current_state == 10) {data.current_state='CLeared,Ack';}
    
              document.getElementById("id_alarm_type"+data.id_alarm_type).selected = "true";
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
              document.getElementById("pic_uko2").value = data.pic_uko;
              document.getElementById("pic_kanwil2").value = data.pic_kanwil;
              document.getElementById("pic_spo2").value = data.pic_spo;
              document.getElementById("pet_it2").value = data.pet_it;
              document.getElementById("pic_pinca2").value = data.pic_pinca;
              document.getElementById("stop_alarm").value = data.stop_at;
              document.getElementById("start_alarm").value = data.start_at;
              document.getElementById("priority").value = data.priority;
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              swal("Oops","Error Get Data", "error");
    
          }
      });
    }
    
    function DetailAlarm2(id){
      //alert(id);
      var url="<?php echo base_url(); ?>index.php/Master/DetailAlarmById";
    
      //ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: {id:id,kode:'N'},
          dataType: "JSON",
          success: function(data)
          {
              //alert(data.kode_jarkom);
              if (data.alarm_type==null) {data.alarm_type=0;}
    
              if (data.current_state == 1 || data.current_state == 2) {data.current_state='Active,Unack';}
              if (data.current_state == 3 || data.current_state == 4) {data.current_state='Active,Ack';}
              if (data.current_state == 9) {data.current_state='Cleared,Unack';}
              if (data.current_state == 10) {data.current_state='CLeared,Ack';}
    
              document.getElementById("pic_uko3").value = data.pic_uko;
              document.getElementById("pic_kanwil3").value = data.pic_kanwil;
              document.getElementById("pic_spo3").value = data.pic_spo;
              document.getElementById("pet_it3").value = data.pet_it;
              document.getElementById("pic_pinca3").value = data.pic_pinca;
              document.getElementById("alarm_type3"+data.id_alarm_type).selected = "true";
              document.getElementById("remote_name3").value = data.remote_name;
              document.getElementById("remote_type3").value = data.remote_type;
              document.getElementById("jenis_jarkom3").value = data.jenis_jarkom;
              document.getElementById("region3").value = data.region;
              document.getElementById("main_branch3").value = data.main_branch;
              document.getElementById("branch_code3").value = data.branch_code;
              document.getElementById("provider3").value = data.provider;
              document.getElementById("ip_address3").value = data.ip_address;
              document.getElementById("current_state3").value = data.current_state;
              document.getElementById("ack_by3").value = data.user_acked;
              document.getElementById("ack_at3").value = data.ack_at;
              document.getElementById("stop_at3").value = data.stop_at;
              document.getElementById("stop_alarm2").value = data.stop_at;
              document.getElementById("start_alarm2").value = data.start_at;
              document.getElementById("priority2").value = data.priority;
              //alert(data.pic_uko);
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
    
      function ActionAckByJarkom(url=''){
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
    
    function SaveAlarm() {
      // tgl = $('#tanggal_spk').val();
      // alert(tgl);
      var url="<?php echo base_url()."index.php/Master/SaveAlarm"; ?>";
    
        //ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#formid1').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              if (data==1) {
                swal({
                    title:"Update Data Success!", 
                    type: "success",
                    timer: 20000,   
                    confirmButtonText: "Ok"},
                  function(){
                    //location.reload();
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
    
    function SaveNoteAlarm() {
      // tgl = $('#tanggal_spk').val();
      // alert(tgl);
      var url="<?php echo base_url()."index.php/Master/SaveNoteAlarm"; ?>";
    
        //ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#formid2').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              if (data==true) {
                swal({
                    title:"Insert Data Success!", 
                    type: "success",
                    timer: 20000,   
                    confirmButtonText: "Ok"},
                  function(){
                    location.reload();
                });
              }else{
                swal("Oops","Error Insert Data", "error");
              }
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error Insert Data');
                swal("Oops","Error Insert Data", "error");
     
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
    
    var mymap;
    var osmUrl;
    var osmAttrib;
    var lat    = <?php echo $latitude;?>;
    var lng    = <?php echo $longitude;?>;
    var latinduk = <?php echo $locinduk[$data[0]->id_remote][0]->latitude; ?>;
    var lnginduk = <?php echo $locinduk[$data[0]->id_remote][0]->longitude; ?>;
    
    function initialize()
    {
    	var centerlat = <?php echo $data[0]->latitude;?>;
    	var centerlng = <?php echo $data[0]->longitude;?>;
        Bertho nonaktifkan map
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
