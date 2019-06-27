<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<style>
a {color : #777777;}
/* tr:hover  #TR{ background-color : #ccd9ff }  */
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Wifi'; ?>">Wifi Complaint</a></li>
        <li class="active" style="color: #3C8DBC;">Wifi Comment</li>
      </ol>
    </div>
</section>
<section class="content">
    <div class="row">

      <div class="panel panel-default"  style="float: left;width:52%;">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Wifi Comment</div>
        <div class="panel-body">
          <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary direct-chat direct-chat-primary" style="width: 600px">
                    <div class="box-header with-border">
                      <h3 class="box-title"></h3>
                      <div class="box-tools pull-right">
                        <div style="float: left;margin-right: 5px">
                          <label type="button" class="btn btn-block btn-default btn-xs" id="status"><?php echo $complaint->status?></label>
                        </div>
                        <div style="float: left;margin-right: 5px">
                          <label class="btn btn-block btn-default btn-xs"><?php echo $complaint->create_at?></label>
                        </div>
                        <div style="float: left;margin-right: 5px">
                          <label class="btn btn-block btn-default btn-xs"><?php echo $complaint->user_contact?></label>
                        </div>
                        <?php if($complaint->status_complaint<3 && in_array($this->session->userdata('role'),array(1,5)) ){?>
                          <div style="float: left;margin-right: 5px">
                            <button type="button" class="btn btn-block btn-success btn-xs" onclick="ReqClose()">Request Closed</button>
                          </div>
                        <?php }else if($complaint->status_complaint==3 && in_array($this->session->userdata('role'),array(1,5)) ){?>
                        <div style="float: right;margin-right: 5px">
                          <button type="button" class="btn btn-block btn-danger btn-xs" onclick="RejectReq()">Reject Request Closed</button>
                        </div>
                        <?php } if($complaint->status_complaint==3 && in_array($this->session->userdata('role'),array(1,5)) ){?>
                        <div style="float: right;margin-right: 5px">
                          <button type="button" class="btn btn-block btn-success btn-xs" onclick="Close()">Close Complaint</button>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="box">
                      <!-- Conversations are loaded here -->
                      <div class="direct-chat-messages" id="chatting">

                        

                      </div>
                      <!--/.direct-chat-messages-->

                    </div>
                    <div id="loading" style="display:none"><center><i class="fa fa-spinner fa-spin"></i> Loading...</center></div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <form action="#" method="post" id="formid">
                        <div class="input-group">
                          <input type="text" name="message" id="pesan" placeholder="Type Message ..." class="form-control" required>
                          <input type="hidden" name="id_complaint" id="id_complaint" value="<?php echo $id_complaint;?>">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-flat" onclick="SaveChat()">Send</button>
                          </span>
                        </div>
                      </form>
                    </div>
                    <!-- /.box-footer-->
              </div>
              <!-- /.box -->
          </div>
        </div>
      </div>

      <div class="panel panel-default" style="float: right; width: 45%;">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Detail Complaint</div>     
          <div style="width:100%;height:100%;position:relative;">                          
                <table class="table table-hover">
                  <tr>
                    <th>Status Complaint</th>
                    <td>:</td>
                    <td><?php echo $complaint->status?></td>
                  </tr>
                  <tr>
                    <th>Complaint Detail</th>
                    <td>:</td>
                    <td><?php echo $complaint->complaint_detail?></td>
                  </tr>
                  <tr>
                    <th>User Create</th>
                    <td>:</td>
                    <td><?php echo $complaint->user_create?></td>
                  </tr>
                  <tr>
                    <th>Date</th>
                    <td>:</td>
                    <td><?php echo $complaint->create_at?></td>
                  </tr>
                </table>            
          </div>
      </div>
      </div>


    </div>
</section>

<script type="text/javascript">
  $(document).ready(function(){

    getChatAll('<?php echo $id_complaint;?>');
  
  });

  function getChatAll(id_complaint=''){
    $.ajax({
      url   : "<?php echo site_url('Wifi/GetComment') ?>",
      type  : 'POST',
      dataType: 'html',
      data  : {id_complaint:id_complaint},
      success : function(result){
        $("#chatting").html(result);
        //$(".panel-footer").show();
        //autoScroll();
        document.getElementById('pesan').focus();
      }
    });
  }

  function refreshStatus(id_complaint='') {
    $.ajax({
      url   : "<?php echo site_url('Wifi/GetStatus') ?>",
      type  : 'POST',
      dataType: 'html',
      data  : {id_complaint:id_complaint},
      success : function(result){
        var status;
        switch (result) {
          case '1':
            status = "New Complaint";
            break;
          case '2':
            status = "Compliant Investigated";
            break;
          case '3':
            status = "Request Closed";
            break;
          case '4':
            status = "Closed";
            break;
        }
        document.getElementById("status").innerHTML = status;
      }
    });
  }

  function SaveChat() {
    var url="<?php echo base_url()."index.php/Wifi/SaveComment/"; ?>";

    if($("#pesan").val()!=''){
      //ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: $('#formid').serialize(),
          dataType: "JSON",
          success: function(data)
          {
            if (data==true) {
              getChatAll('<?php echo $id_complaint;?>');
              refreshStatus('<?php echo $id_complaint;?>');
              $("#pesan").val('');
              autoScroll();
              // swal({
              //     title:"Insert Data Success!", 
              //     type: "success",
              //     timer: 20000,   
              //     confirmButtonText: "Ok"},
              //   function(){
              //   location.reload();
              // });
            }else{
              swal("Oops","Error Send Data", "error");
            }
              
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              //alert('Error Insert Data');
              swal("Oops","Error Send Data", "error");

          }
      });
    }else{
      swal("Oops","Message Empty", "error");
    }

  }

  function autoScroll(){
    var elem = document.getElementById('box');
    elem.scrollTop = elem.scrollHeight;
  }

  function ReqClose() {

    var id_complaint = '<?php echo $id_complaint;?>';

    var url="<?php echo base_url()."index.php/Wifi/ReqClose/"; ?>";

    $.ajax({
      url : url,
      type: "POST",
      data  : {id_complaint:id_complaint},
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
          refreshStatus('<?php echo $id_complaint;?>');
          getChatAll('<?php echo $id_complaint;?>');
        }else{
          swal("Oops","Error Request", "error");
        }
          
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          //alert('Error Insert Data');
          swal("Oops","Error Request", "error");

      }
    });
  }

  function Close() {

    var id_complaint = '<?php echo $id_complaint;?>';

    var url="<?php echo base_url()."index.php/Wifi/Close/"; ?>";

    $.ajax({
      url : url,
      type: "POST",
      data  : {id_complaint:id_complaint},
      dataType: "JSON",
      success: function(data)
      {
        if (data==true) {
          swal({
              title:"Close Complaint Success!", 
              type: "success",
              timer: 20000,   
              confirmButtonText: "Ok"},
            function(){
            location.reload();
          });
          refreshStatus('<?php echo $id_complaint;?>');
          getChatAll('<?php echo $id_complaint;?>');
        }else{
          swal("Oops","Error Close Complaint", "error");
        }
          
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          //alert('Error Insert Data');
          swal("Oops","Error Close Complaint", "error");

      }
    });
  }

  function RejectReq() {

    var id_complaint = '<?php echo $id_complaint;?>';

    var url="<?php echo base_url()."index.php/Wifi/RejectReq/"; ?>";

    $.ajax({
      url : url,
      type: "POST",
      data  : {id_complaint:id_complaint},
      dataType: "JSON",
      success: function(data)
      {
        if (data==true) {
          swal({
              title:"Reject Request Success!", 
              type: "success",
              timer: 20000,   
              confirmButtonText: "Ok"},
            function(){
            location.reload();
          });
          refreshStatus('<?php echo $id_complaint;?>');
          getChatAll('<?php echo $id_complaint;?>');
        }else{
          swal("Oops","Error Reject Request", "error");
        }
          
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          //alert('Error Insert Data');
          swal("Oops","Error Reject Request", "error");

      }
    });
  }


</script>
