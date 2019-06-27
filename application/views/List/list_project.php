<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Provider List</li>
      </ol>
    </div>
</section>
<section class="content">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Network All Provider</div>
      <div class="panel-body">
        <div style="width:100%;height:50px;">
            <div align="left" style="float: left;">
              <button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#modal-default" style="width: 100px;height:30px"><i class="fa fa-plus"></i> Add Project</button>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped table-hover" id="table_data">
            <thead>
              <tr>
                <th>No.</th>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Note</th>
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
<!-------------- FORM ADD --------------->        

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content" >
              <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Remote</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="" id="formid" method='post'>
                  <div class="box-body">
                    <div class="row">
                      <div class="form-group">
                        <label>Project Name</label>
                        <input type="text" name="nama_project" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Note</label>
                          <textarea name="keterangan" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="save_project()">Save</button>
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
        {data:"Project ID"},
        {data:"Project Name"},
        {data:"Note"},
      ],
      columnDefs:[
        {
          targets:[0,3],
          orderable:false
        }
      ],
      ajax:{
        url:"<?php echo base_url().'index.php/Master/GetData_Project';?>",
        type:"post",
        dataType:"json"

      }
    });
  }

  function save_project() {
    //alert('masoook');
    var url="<?php echo base_url()."index.php/Master/SaveProject/"; ?>";

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