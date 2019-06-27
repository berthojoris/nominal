<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<!-- daterange picker -->
<script src="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List SPK</li>
      </ol>
    </div>
</section>
<section class="content">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List SPK</div>
      <div class="panel-body">
        <div style="width:100%;height:50px;">
            <div align="left" style="float: left;">
              <button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px;height:30px" onclick="showForm()"><i class="fa fa-plus"></i>&nbsp;Add SPK</button>
            </div>
        </div>
        <div class="box box-primary" style="width: 50%;display:none;" id="form_spk">
            <div class="box-header with-border">
              <h3 class="box-title">Add SPK</h3>
            </div>
            <form role="form" action="" id="formid" method='post'>
              <div class="box-body">
                <div class="row">
                  <div class="form-group">
                    <label>No SPK</label>
                    <input type="text" name="no_spk" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>SPK Type</label>
                    <select class="form-control" name="jenis_spk" id="jenis_spk" onchange="cekJenis()">
                      <option value="1">Pengadaan</option>
                      <option value="2">Perpanjangan</option>
                      <option value="3">Adendum</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>No SPK Perpanjangan</label>
                    <select class="form-control select2" name="no_spk_perpanjangan" id="no_spk_perpanjangan" style="width: 100%;" disabled>
                        <option value="">
                          -- Change SPK --
                        </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Date:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="tanggal_spk" name="tanggal_spk">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <label>Due Date:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="jatuh_tempo" name="jatuh_tempo">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <label>Provider</label>
                    <select class="form-control" name="kode_provider">
                    <?php foreach ($provider as $p) {?>
                      <option value="<?php echo $p->kode_provider;?>">
                        <?php echo $p->nama_provider;?>
                      </option>
                    <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Project</label>
                    <select class="form-control select2" name="id_project" id="id_project" style="width: 100%">
                      <option value="">
                        -- Choose Project --
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal" onclick="closeForm()">Cancel</button>
                <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="save_spk()">Save</button>
              </div>
            </form>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped table-hover" id="table_data">
            <thead>
              <tr>
                <th>No.</th>
                <th>No SPK</th>
                <th>Provider</th>
                <th>Date</th>
                <th>Due Date</th>
                <th>SPK Type</th>
                <th>Project</th>
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
                <h4 class="modal-title">Add SPK</h4>
              </div>
              <div class="modal-body">
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

    //Date picker
    $('#tanggal_spk').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('#jatuh_tempo').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });


    $("#no_spk_perpanjangan").select2({
      minimumInputLength:5,
      placeholder:'Choose No SPK',
      //allowClear:true,
      ajax:{

        url: "<?php echo base_url().'index.php/Master/GetSpk';?>",
          dataType: 'JSON',
          type: "GET",
          data: function (params) {
            console.log(params);
             return{
              spk:params.term
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


    $("#id_project").select2({
      minimumInputLength:3,
      placeholder:'Choose Project',
      //allowClear:true,
      ajax:{

        url: "<?php echo base_url().'index.php/Master/GetProject';?>",
          dataType: 'JSON',
          type: "GET",
          data: function (params) {
            console.log(params);
             return{
              id_project:params.term
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
        {data:"No SPK"},
        {data:"Provider"},
        {data:"Date"},
        {data:"Due Date"},
        {data:"SPK Type"},
        {data:"Project"}
      ],
      columnDefs:[
        {
          targets:[0,3],
          orderable:false
        }
      ],
      ajax:{
        url:"<?php echo base_url().'index.php/Master/GetData_SPK';?>",
        type:"post",
        dataType:"json"

      }
    });
  }

  function showForm() {
    $("#form_spk").toggle();
  }

  function closeForm() {
    $("#form_spk").toggle();
  }

  function cekJenis() {
    //alert("test");
    var jenis = $("#jenis_spk").val();
    if (jenis!=1) {document.getElementById("no_spk_perpanjangan").disabled=false;}
  }

  function save_spk() {
    // tgl = $('#tanggal_spk').val();
    // alert(tgl);
    var url="<?php echo base_url()."index.php/Master/SaveSPK/"; ?>";

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