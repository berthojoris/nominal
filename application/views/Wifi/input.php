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
        <li class="active" style="color: #3C8DBC;">Wifi Complaint</li>
      </ol>
    </div>
</section>
<section class="content">
    <div class="row">
      <div class="panel panel-default"  style="float: left;width:49%;">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Wifi Complaint</div>
        <div class="panel-body">

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Input Wifi Complaint</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" id="formid">
                <div class="box-body">
                  <div class="form-group">
                    <label>Complaint</label>
                    <select class="form-control" name="complaint">
                      <option value="1">Kendala Login</option>
                      <option value="2">Lambat</option>
                      <option value="3">Sinyal Wifi Tidak Terdeteksi</option>
					  <option value="10">Lain-lain</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Complaint Detail</label>
                    <textarea class="form-control" name="complaint_detail" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                  <div class="form-group">
                    <label>Contact</label>
                    <input type="text" class="form-control" name="contact" placeholder="Enter ...">
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" class="btn btn-primary" onclick="SaveComplaint()">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
        </div>
      </div>

      <div class="panel panel-default"  style="width:49%;float: right;">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Wifi</div>
        <div class="panel-body">
          <div class="box-body table-responsive no-padding">
            <table class="table table-bordered table-striped table-hover" id="table_data">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Id Complaint</th>
                  <th>Complaint</th>
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
</section>

<script type="text/javascript">

  $(document).ready(function(){
    tampilkan_data();
  });

  function tampilkan_data()
  {
    $("#table_data").DataTable({
      processing:true,
      serverSide:true,
      columns:[
        {data:"No"},
        {data:"Id Complaint"},
        {data:"Complaint"},
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
        url:"<?php echo base_url().'index.php/Wifi/GetComplaint';?>",
        type:"post",
        dataType:"json"

      }
    });
  }


  function SaveComplaint() {
    var url="<?php echo base_url()."index.php/Wifi/SaveComplaint/"; ?>";

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
</script>
