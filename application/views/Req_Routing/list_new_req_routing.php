
<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0/jquery-ui.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />

<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List New Request Routing</li>
      </ol>
    </div>
</section>
<section class="content">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List New Request Routing</div>
      <div class="panel-body">
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped table-hover" id="table_data">
            <thead>
              <tr>
                <th>No.</th>
                <th>ID Request</th>
                <th>Remote Name</th>
                <th>Address</th>
                <th>Region</th>
                <th>Remote Type</th>
                <th>IP LAN</th>
                <th>IP Pool</th>
                <th>Status</th>
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

<!-------------- FORM POP UP --------------->        
  <div class="modal fade" id="track">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Track Request Routing</h4>
        </div>
        <div class="modal-body" id="tampil_track">
          
        </div>
        <div class="modal-footer">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-------------- END FORM POP UP --------------->

<!-------------- FORM POP UP --------------->        
  <div class="modal fade" id="rollback">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Request Rollback</h4>
        </div>

        <div class="modal-body">
          <form role="form" id="formrollback">
              <div class="box-body">
                <div class="form-group">
                  <label>PIC</label>
                  <input type="hidden" class="form-control" id="id_req2" name="id">
                  <input type="text" class="form-control" id="pic_rollback" name="pic_rollback" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label>NOTE</label>
                  <textarea name="note" id="note" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              </div>
            </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="ReqRollback()">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-------------- END FORM POP UP --------------->


<div class="modal fade" id="detail">
  <div class="modal-dialog" style="width: 1000px">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Request</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="formid">
            <div class="box-body">
              <input type="hidden" name="id_req" id="id_req">
                <!-- <div class="form-group">
                  <label>Remote</label>
                  <input type="text" name="nama_remote" id="nama_remote" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label>IP LAN</label>
                  <input type="text" name="ip_lan" id="ip_lan" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label>PIC</label>
                  <input type="text" name="pic" id="picc" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label>IP Pool</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-laptop"></i>
                    </div>
                    <input type="text" name="ip_pool" id="ip_pooll" class="form-control" value="" readonly> --> <!-- data-inputmask="'alias': 'ip'" data-mask --> 
                  <!-- </div>
                </div>
                <div class="form-group">
                  <label>Ticket</label>
                  <input type="text" name="ticket_jarkom" id="ticket_jarkom" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label>User</label>
                  <input type="text" name="user" id="user" class="form-control" value="<?php //echo $this->session->userdata('nama');?>" readonly>
                </div> -->
                <div class="form-group">
                  <table class="table">
                    <tr>
                      <th>Remote</th>
                      <td style="width: 10px">:</td>
                      <td><p id="td_remote"></p></td>
                    <!-- </tr>
                    <tr> -->
                      <th>PIC</th>
                      <td style="width: 10px">:</td>
                      <td><p id="td_pic"></p></td>
                    <!-- </tr>
                    <tr> -->
                      <th>User Open</th>
                      <td style="width: 10px">:</td>
                      <td><p id="td_useropen"></p></td>
                    <!-- </tr>
                    <tr> -->
                    </tr>
                    <tr>
                      <th>IP Pool</th>
                      <td style="width: 10px">:</td>
                      <td><p id="td_ip_pool"></p></td>
                    <!-- </tr>
                    <tr> -->
                      <th>Ticket</th>
                      <td style="width: 10px">:</td>
                      <td><p id="td_ticket"></p></td>
                    <!-- </tr>
                    <tr> -->
                      <th>User Routing</th>
                      <td style="width: 10px">:</td>
                      <td><p id="td_userrouting"></p></td>
                    </tr>
                    <tr>
                      <th>IP LAN</th>
                      <td style="width: 10px">:</td>
                      <td><p id="td_ip_lan"></p></td>
                    <!-- </tr>
                    <tr> -->
                      <th></th>
                      <td style="width: 10px"></td>
                      <td></td>
                    <!-- </tr>
                    <tr> -->
                      <th>User SIM Card</th>
                      <td style="width: 10px">:</td>
                      <td><p id="td_usersimcard"></p></td>
                    </tr>
                    <tr>
                      <th>Status Open</th>
                      <td style="width: 10px"></td>
                      <td colspan="6">
                        <select class="form-control" name="status_open" id="status_open" onchange="Cekopen()">
                          <option id="select_open1" value="1">New</option>
                          <option id="select_open2" value="2">Checking</option>
                          <option id="select_open3" value="3">Verified</option>
                          <option id="select_open0" value="0">Rejected</option>
                        </select>
                      </td>
                      <td>
                        <div class="form-group" align="right" id="btn_open">
                          <button type="button" name="save_open" value="submit" class="btn btn-primary" onclick="save_openticket()" id="save_open">
                            Save
                          </button>
                        </div>
                      </td>
                    </tr>
                    <tr  id="routing" style="display: none;">
                      <th>Status Routing</th>
                      <td style="width: 10px"></td>
                      <td colspan="6">
                        <select class="form-control" name="status_routing" id="status_routing" onchange="Cekrouting()" disabled>
                          <option id="select_routing1" value="1">New</option>
                          <option id="select_routing2" value="2">Checking</option>
                          <option id="select_routing3" value="3">Routing Done</option>
                          <option id="select_routing0" value="0">Rejected</option>
                        </select>
                      </td>
                      <td>
                        <div class="form-group" align="right" id="btn_routing" style="display: none;">
                          <button type="button" name="save_rout" value="submit" class="btn btn-primary" onclick="save_routing()"  id="save_rout">
                            Save
                          </button>
                        </div>
                      </td>
                    </tr>
                    <tr id="simcard" style="display: none;">
                      <th>Status SIM Card</th>
                      <td style="width: 10px"></td>
                      <td colspan="6">
                        <select class="form-control" name="status_simcard" id="status_simcard" onchange="Ceksimcard()" disabled>
                          <option id="select_simcard1" value="1">New</option>
                          <option id="select_simcard2" value="2">Checking</option>
                          <option id="select_simcard3" value="3">Simcard Ready</option>
                          <option id="select_simcard0" value="0">Rejected</option>
                        </select>
                      </td>
                      <td>
                        <div class="form-group" align="right" id="btn_simcard" style="display: none;">
                          <button type="button" name="save_simcard" value="submit" class="btn btn-primary" onclick="save_simcard_jarkom()"  id="save_simcard">
                            Save
                          </button>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
                
                <!-- <div class="form-group" id="status_open1">
                  <label>Status Open</label>
                  <select class="form-control" name="status_open" id="status_open" onchange="Cekopen()">
                    <option id="select_open1" value="1">New</option>
                    <option id="select_open2" value="2">Checking</option>
                    <option id="select_open3" value="3">Verified</option>
                    <option id="select_open0" value="0">Rejected</option>
                  </select>
                </div> -->
                <div class="form-group" id="txt_reason1" style="display: none;">
                  <label>Reason (Open)</label>
                  <textarea  name="reason" class="form-control" id="reason_open"></textarea>
                </div>
                <!-- <div class="form-group" align="right" id="btn_open">
                  <button type="button" name="save_open" value="submit" class="btn btn-primary" onclick="save_openticket()" id="save_open">
                    Save
                  </button>
                </div> -->
                <!-- <div class="form-group" id="status_open2" style="display: none;">
                  <label>Status Open</label>
                  <input type="text" name="open" id="open" class="form-control" value="" readonly>
                </div> -->
                <!-- <div class="form-group" id="routing" style="display: none;">
                  <label>Status Routing</label>
                  <select class="form-control" name="status_routing" id="status_routing" onchange="Cekrouting()" disabled>
                    <option id="select_routing1" value="1">New</option>
                    <option id="select_routing2" value="2">Checking</option>
                    <option id="select_routing3" value="3">Routing Done</option>
                    <option id="select_routing0" value="0">Rejected</option>
                  </select>
                </div> -->
                <div class="form-group" id="txt_reason2" style="display: none;">
                  <label>Reason (Routing)</label>
                  <textarea  name="reason" class="form-control" id="reason_routing"></textarea>
                </div>
                <!-- <div class="form-group" align="right" id="btn_routing" style="display: none;">
                  <button type="button" name="save_rout" value="submit" class="btn btn-primary" onclick="save_routing()"  id="save_rout">
                    Save
                  </button>
                </div> -->
                <!-- <div class="form-group" id="status_routing2" style="display: none;">
                  <label>Status Routing</label>
                  <input type="text" name="routing" id="routing" class="form-control" value="" readonly>
                </div> -->
                
                <!-- <div class="form-group" id="simcard" style="display: none;">
                  <label>Status SIM Card</label>
                  <select class="form-control" name="status_simcard" id="status_simcard" onchange="Ceksimcard()" disabled>
                    <option id="select_simcard1" value="1">New</option>
                    <option id="select_simcard2" value="2">Checking</option>
                    <option id="select_simcard3" value="3">Simcard Ready</option>
                    <option id="select_simcard0" value="0">Rejected</option>
                  </select>
                </div> -->
                <div class="form-group" id="txt_reason3" style="display: none;">
                  <label>Reason (SIM Card)</label>
                  <textarea  name="reason" class="form-control" id="reason_simcard"></textarea>
                </div>
                <!-- <div class="form-group" align="right" id="btn_simcard" style="display: none;">
                  <button type="button" name="save_simcard" value="submit" class="btn btn-primary" onclick="save_simcard_jarkom()"  id="save_simcard">
                    Save
                  </button>
                </div> -->
                <!-- <div class="form-group" id="status_simcard2" style="display: none;">
                  <label>Status SIM Card</label>
                  <input type="text" name="simcard" id="simcard" class="form-control" value="" readonly>
                </div> -->


                <div class="form-group" id="btn_rollback" style="display: none;">
                  <label style="margin-right: 50px">Rollback</label>
                  <button type="button" class="btn btn-success" onclick="AppRollback()"><i class="fa fa-check"></i> Approve</button>
                  <button type="button" class="btn btn-danger" onclick="ReRollback()"><i class="fa  fa-close"></i> Reject</button>
                </div>

                <div class="form-group" id="btn_rollback2" style="display: none;">
                  <label style="margin-right: 50px">Rollback</label>
                  <button type="button" class="btn btn-success" onclick="DoneRollback()"><i class="fa fa-check"></i> Done Rollback</button>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
      <div class="modal-footer">
      </div>
  </div>
</div>

</section>

<script type="text/javascript">

  $(document).ready(function(){
    //alert("test jquery");
    tampilkan_data();

    $('[data-mask]').inputmask();

    $("#remote").select2({
      minimumInputLength:5,
      placeholder:'Remote Name / IP LAN',
      //allowClear:true,
      ajax:{

        url: "<?php echo base_url().'index.php/Req_Routing/GetRemote';?>",
          dataType: 'JSON',
          type: "GET",
          data: function (params) {
            console.log(params);
             return{
              search:params.term
             }
          },
          processResults: function (data) {
            console.log(data)
            return{
              results:data
            }
          }

      }
    });

  });

  function tampilkan_data()
  {
    $("#table_data").DataTable({
      processing:true,
      serverSide:true,
      columns:[

        {data:"No"},
        {data:"Id Request"},
        {data:"Remote Name"},
        {data:"Address"},
        {data:"Region"},
        {data:"Remote Type"},
        {data:"IP LAN"},
        {data:"IP Pool"},
        {data:"Status"},
        {data:"Action"}
      ],
      columnDefs:[
        {
          targets:[0,3],
          orderable:false
        }
      ],
      ajax:{
        url:"<?php echo base_url().'index.php/Req_Routing/GetData_ReqRouting/new';?>",
        type:"post",
        dataType:"json"

      }
    });
  }

  function show_form() {
    $("#form").toggle();
  }

  function closeForm() {
    $("#form").toggle();
  }

  function save_req() {
    //alert($('#nama_remote').val());
    var url="<?php echo base_url()."index.php/Req_Routing/SaveReq/"; ?>";

    if ($("#remote").val()=='' || $("#pic").val()=='' || $("#ip_pool").val()=='' || $("#ticket").val()=='' || $("#ip_pool").val()=='') {swal("Oops","Error Insert Data", "error");}
    else{
      //ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: $('#formid').serialize(),
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
            }else if(data==2){
              swal("Oops","Duplicate Data Insert", "error");
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
  }

  function TrackReq(id=''){
    $.ajax({
      url   : "<?php echo site_url('Req_Routing/TrackReq') ?>",
      type  : 'POST',
      dataType: 'html',
      data  : {id:id},
      success : function(result){
        $("#tampil_track").html(result);
        $('#table_track').DataTable();
      }
    });
  }

  function DetailReq(id='') {
    $("#routing").hide();
    $("#simcard").hide();
    $("#btn_routing").hide();
    $("#btn_simcard").hide();
    $("#txt_reason1").hide();
    $("#txt_reason2").hide();
    $("#txt_reason2").hide();
    var user = '<?php echo $this->session->userdata('username');?>'; 
    $.ajax({
      url   : "<?php echo site_url('Req_Routing/DetailReq') ?>",
      type  : 'POST',
      dataType: 'JSON',
      data  : {id:id},
      success : function(data){
        //alert(data);
        document.getElementById("id_req").value = data.id;
        // document.getElementById("nama_remote").value = data.nama_remote;
        // document.getElementById("ip_pooll").value = data.ip_pool;
        // document.getElementById("ip_lan").value = data.ip_lan;
        // document.getElementById("ticket_jarkom").value = data.ticket_jarkom;
        // document.getElementById("picc").value = data.pic;
        document.getElementById("select_open"+data.status_open).selected = "true";


        document.getElementById("td_remote").innerHTML = data.nama_remote;
        document.getElementById("td_ip_pool").innerHTML = data.ip_pool;
        document.getElementById("td_ip_lan").innerHTML = data.ip_lan;
        document.getElementById("td_pic").innerHTML = data.pic;
        document.getElementById("td_ticket").innerHTML = data.ticket_jarkom;

        document.getElementById("td_useropen").innerHTML = data.namaopen;
        document.getElementById("td_userrouting").innerHTML = data.namarout;
        document.getElementById("td_usersimcard").innerHTML = data.namasimcard;

        if(data.status==11){

          $("#routing").show();
          $("#simcard").show();
          $("#btn_routing").hide();
          $("#btn_simcard").hide();
          $("#btn_routing").hide();
          $("#btn_open").hide();
          document.getElementById("status_open").disabled = true;
          document.getElementById("status_routing").disabled = true;
          document.getElementById("status_simcard").disabled = true;
          document.getElementById("select_routing"+data.status_routing).selected = "true";
          document.getElementById("select_simcard"+data.status_simcard).selected = "true";

          $("#btn_rollback").show();

        }else if(data.status==12){

          $("#routing").show();
          $("#simcard").show();
          $("#btn_routing").hide();
          $("#btn_simcard").hide();
          $("#btn_routing").hide();
          $("#btn_open").hide();
          document.getElementById("status_open").disabled = true;
          document.getElementById("status_routing").disabled = true;
          document.getElementById("status_simcard").disabled = true;
          document.getElementById("select_routing"+data.status_routing).selected = "true";
          document.getElementById("select_simcard"+data.status_simcard).selected = "true";

          $("#btn_rollback2").show();

        }else if(data.status==13){

          $("#routing").show();
          $("#simcard").show();
          $("#btn_routing").hide();
          $("#btn_simcard").hide();
          $("#btn_routing").hide();
          $("#btn_open").hide();
          document.getElementById("status_open").disabled = true;
          document.getElementById("status_routing").disabled = true;
          document.getElementById("status_simcard").disabled = true;
          document.getElementById("select_routing"+data.status_routing).selected = "true";
          document.getElementById("select_simcard"+data.status_simcard).selected = "true";

        }
        // else if (data.user_open==user || data.user_open=='' || !data.user_open){
        //   document.getElementById("status_open").disabled = false;
        //   $("#btn_open").show();
        // }else{
        //   document.getElementById("status_open").disabled = true;
        //   $("#btn_open").hide();
        // }

        if (data.status_open==3 && data.status<11) {

          $("#routing").show();
          $("#simcard").show();

          //if(data.status_routing>=2){
            //if (data.user_routing==user || data.user_routing=='' || !data.user_routing){
              document.getElementById("status_routing").disabled = false;
              $("#btn_routing").show();
            // }else{
            //   $("#btn_routing").hide();
            // }
            document.getElementById("select_routing"+data.status_routing).selected = "true";
          //}

          //if(data.status_simcard>=2){
            //if (data.user_simcard==user || data.user_simcard=='' || !data.user_simcard) {
              document.getElementById("status_simcard").disabled = false;
              $("#btn_simcard").show();
            // }else{
            //   $("#btn_simcard").hide();
            // }
            document.getElementById("select_simcard"+data.status_simcard).selected = "true";
          //}

        }

      }
    });
  }

  function Cekopen() {
    var x = document.getElementById("status_open").value;
    if (x == 0) {$("#txt_reason1").show();}
  }

  function Cekrouting() {
    var x = document.getElementById("status_routing").value;
    if (x == 0) {$("#txt_reason2").show();}
  }

  function Ceksimcard() {
    var x = document.getElementById("status_simcard").value;
    if (x == 0) {$("#txt_reason3").show();}
  }

  function save_openticket() {
    //alert($('#status_open').val());
    var url="<?php echo base_url()."index.php/Req_Routing/SaveOpen/"; ?>";
    var id = $("#id_req").val();
    var status_open = $("#status_open").val(); 
    var reason = $("#reason_open").val();

      //ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: {id:id,status_open:status_open,reason:reason},
          dataType: "JSON",
          success: function(data)
          {
            if (data==true) {
              swal({
                  title:"Update Data Success!", 
                  type: "success",
                  timer: 2000,   
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

  function save_routing() {
    //alert($('#status_open').val());
    var url="<?php echo base_url()."index.php/Req_Routing/SaveRouting/"; ?>";
    var id = $("#id_req").val();
    var status_routing = $("#status_routing").val();  
    var reason = $("#reason_routing").val();

      //ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: {id:id,status_routing:status_routing,reason:reason},
          dataType: "JSON",
          success: function(data)
          {
            if (data==true) {
              swal({
                  title:"Update Data Success!", 
                  type: "success",
                  timer: 2000,   
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

  function save_simcard_jarkom() {
    //alert($('#status_open').val());
    var url="<?php echo base_url()."index.php/Req_Routing/SaveSimcard/"; ?>";
    var id = $("#id_req").val();
    var status_simcard = $("#status_simcard").val();  
    var reason = $("#reason_simcard").val();

      //ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: {id:id,status_simcard:status_simcard,reason:reason},
          dataType: "JSON",
          success: function(data)
          {
            if (data==true) {
              swal({
                  title:"Update Data Success!", 
                  type: "success",
                  timer: 2000,   
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

  function DeleteReq(id='') {

      var url="<?php echo base_url()."index.php/Req_Routing/DeleteReq/"; ?>";

      swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({
              url : url,
              type: "POST",
              data: {id:id},
              dataType: "JSON",
              success: function(data)
              {
                if (data==true) {
                  swal({
                      title:"Delete Data Success!", 
                      type: "success",
                      timer: 2000,   
                      confirmButtonText: "Ok"},
                    function(){
                      location.reload();
                  });
                }else{
                  swal("Oops","Error Delete Data", "error");
                }
                  
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error Insert Data');
                  swal("Oops","Error Delete Data", "error");
       
              }
          });    
        } else {
          swal("Cancelled", "", "error");
        }
      });
  }


  function ReqRollback() {
    var url="<?php echo base_url()."index.php/Req_Routing/ReqRollback/"; ?>";

    $.ajax({
      url : url,
      type: "POST",
      data  : $('#formrollback').serialize(),
      dataType: "JSON",
      success: function(data)
      {
        if (data==true) {
          swal({
              title:"Request Rollback Success!", 
              type: "success",
              timer: 20000,   
              confirmButtonText: "Ok"},
            function(){
              location.reload();
          });
        }else{
          swal("Oops","Error Request Rollback", "error");
        }
          
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          //alert('Error Insert Data');
          swal("Oops","Error Request Rollback", "error");

      }
    });
  }


  function Rollback(id) {
    swal({
      title: "Note",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      animation: "slide-from-top",
      inputPlaceholder: "Write something"
    }, function(inputValue) {

        var url="<?php echo base_url()."index.php/Req_Routing/Rollback/"; ?>";

        $.ajax({
          url : url,
          type: "POST",
          data  : {id:id,note:inputValue},
          dataType: "JSON",
          success: function(data)
          {
            if (data==true) {
              swal({
                  title:"Request Success!", 
                  type: "success",
                  timer: 20000,   
                  confirmButtonText: "Ok"},
                function(){
                  location.reload();
              });
            }else{
              swal("Oops","Error Rollback", "error");
            }
              
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              //alert('Error Insert Data');
              swal("Oops","Error Rollback", "error");

          }
        });
    });
  }

  function DetailRollback(id='') { 
    $.ajax({
      url   : "<?php echo site_url('Req_Routing/DetailReq') ?>",
      type  : 'POST',
      dataType: 'JSON',
      data  : {id:id},
      success : function(data){
        document.getElementById("pic_rollback").value = data.pic;
        document.getElementById("id_req2").value = data.id;

      }
    });
  }

  function AppRollback() {

    var id = $("#id_req").val();
    var url="<?php echo base_url()."index.php/Req_Routing/AppRollback/"; ?>";

    $.ajax({
      url : url,
      type: "POST",
      data  : {id:id},
      dataType: "JSON",
      success: function(data)
      {
        if (data==true) {
          swal({
              title:"Approve Success!", 
              type: "success",
              timer: 20000,   
              confirmButtonText: "Ok"},
            function(){
            location.reload();
          });
        }else{
          swal("Oops","Error Approve", "error");
        }
          
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          //alert('Error Insert Data');
          swal("Oops","Error Approve", "error");

      }
    });
  }

  function ReRollback() {

    var id = $("#id_req").val();
    var url="<?php echo base_url()."index.php/Req_Routing/ReRollback/"; ?>";

    $.ajax({
      url : url,
      type: "POST",
      data  : {id:id},
      dataType: "JSON",
      success: function(data)
      {
        if (data==true) {
          swal({
              title:"Reject Success!", 
              type: "success",
              timer: 20000,   
              confirmButtonText: "Ok"},
            function(){
            location.reload();
          });
        }else{
          swal("Oops","Error Reject", "error");
        }
          
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          //alert('Error Insert Data');
          swal("Oops","Error Reject", "error");

      }
    });
  }

  function DoneRollback() {

    var id = $("#id_req").val();
    var url="<?php echo base_url()."index.php/Req_Routing/DoneRollback/"; ?>";

    $.ajax({
      url : url,
      type: "POST",
      data  : {id:id},
      dataType: "JSON",
      success: function(data)
      {
        if (data==true) {
          swal({
              title:"Done Rollback Success!", 
              type: "success",
              timer: 20000,   
              confirmButtonText: "Ok"},
            function(){
            location.reload();
          });
        }else{
          swal("Oops","Error Done Rollback", "error");
        }
          
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          //alert('Error Insert Data');
          swal("Oops","Error Done Rollback", "error");

      }
    });
  }

</script>