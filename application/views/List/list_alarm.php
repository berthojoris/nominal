<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<!-- daterange picker -->
<script src="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<style>
a {color : #777777;}
td { font-size: 12px; }

.hover:hover {background-color: #e7e7e7;color: black;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Alarm</li>
      </ol>
    </div>
</section>
<section class="content">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Alarm</div>
      <div class="panel-body">
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped table-hover" id="table_data">
            <thead>
              <tr>
                <th>No.</th>
                <th>Site Id</th>
                <th>Remote Name</th>
                <th>Remote Type</th>
                <th>Region</th>
                <th>Main Branch</th>
                <th>Branch Code</th>
                <th>IP Address</th>
                <th>Priority</th>
                <th>Provider</th>
                <th>Network Type</th>
                <th>Current State</th>
                <th>Ack Time</th>
                <th>Acked By</th>
                <th>Alarm Start</th>
                <th>Alarm End</th>
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


<div class="modal fade" id="modal-default">
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
                <div class="form-group">
                  <label>PIC Remote</label>
                  <input type="text" name="pic_uko" id="pic_uko2" class="form-control" disabled>
                </div>
                <div class="form-group">
                  <label>PIC PINCA</label>
                  <input type="text" name="pic_pinca" id="pic_pinca2" class="form-control" disabled>
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
                  <input type="text" name="pic_kanwil" id="pic_kanwil2" class="form-control" disabled>
                </div>
                <div class="form-group">
                  <label>PIC SPO</label>
                  <input type="text" name="pic_spo" id="pic_spo2" class="form-control" disabled>
                </div>
                <div class="form-group">
                  <label>Stop Alarm</label>
                  <input type="text" name="stop_alarm" id="stop_alarm" class="form-control" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>PET IT</label>
                  <input type="text" name="pet_it" id="pet_it2" class="form-control" disabled>
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

<script type="text/javascript">

  $(document).ready(function(){
    //alert("test jquery");
    tampilkan_data();
  });

  function tampilkan_data()
  {
    $("#table_data").DataTable({
      processing:true,
      serverSide:true,
      columns:[
        {data:"No"},
        {data:"Site Id"},
        {data:"Remote Name"},
        {data:"Remote Type"},
        {data:"Region"},
        {data:"Main Branch"},
        {data:"Branch Code"},
        {data:"IP Address"},
        {data:"Priority"},
        {data:"Provider"},
        {data:"Network Type"},
        {data:"Current Type"},
        {data:"Ack Time"},
        {data:"Acked By"},
        {data:"Alarm Start"},
        {data:"Alarm End"},
        {data:"Action"}
      ],
      columnDefs:[
        {
          targets:[0,3],
          orderable:false
        }
      ],
      ajax:{
        url:"<?php echo base_url().'index.php/Master/GetAlarm';?>",
        type:"post",
        dataType:"json"

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
            // document.getElementById("id_jarkom2").value = data.id_jarkom;
            // document.getElementById("id_remote2").value = data.id_remote;
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

            document.getElementById("pic_uko2").value = data.pic_uko;
            document.getElementById("pic_kanwil2").value = data.pic_kanwil;
            document.getElementById("pic_spo2").value = data.pic_spo;
            document.getElementById("pet_it2").value = data.pet_it;
            document.getElementById("pic_pinca2").value = data.pic_pinca;
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


  function ActionAck(url=''){
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