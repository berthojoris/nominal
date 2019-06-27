
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

<script type="text/javascript">

function edit_jarkom(kodeja="") {
  //alert('masoook');
  var url="<?php echo base_url(); ?>index.php/Dashboard/edit_jarkom";

    //ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $("#form_edit").serialize(),
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

function pilih_brisat() {
  //alert('test');
  var jenis_jarkom = $("#jenis_jarkom").val();
  if (jenis_jarkom != 1) {
    document.getElementById('brisat').selectedIndex = '1';
    $('#brisat').attr('disabled',true);
  }else{
    document.getElementById('brisat').selectedIndex = '0';
    $('#brisat').attr('disabled',false);
  }
}
</script>
<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">

<!-- test:<br>
  <div>
  <select name="pilih" style="width: 100%;"></select>
</div> -->


    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Dash_Prov'; ?>"> Provider</a></li>
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
              <button type="button" class="btn btn-primary" onclick="getID()">
                <i class="fa fa-plus-square"></i> Add Network
              </button>
              <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah" onclick="getID()">
                <i class="fa fa-plus-square"></i> Add Network
              </button> -->
            </div>
        </div>
        <div class="box box-primary" style="width: 50%;display:none;" id="formRemote">
            <div class="box-header with-border">
              <h3 class="box-title">Add Network</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="formid">
              <div class="box-body">
                  <div class="form-group">
                    <label>Remote</label>
                    <select class="form-control select2" name="remote" id="nama_remote" style="width: 100%;">
                        <option value="">
                          -- Change Remote --
                        </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>SPK</label>
                    <select class="form-control select2" name="spk" id="spk" style="width: 100%;">
                        <option value="">
                          -- Change SPK --
                        </option>
                    </select>
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
                      <input type="text" name="ip_wan" class="form-control" value="" data-inputmask="'alias': 'ip'" data-mask >
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
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeForm()">Close</button>
                <button type="button" name="submit" value="submit" class="btn btn-primary pull-right" onclick="saveNet()">Save</button>
              </div>
            </form>
          </div>

        <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover" id="table_data">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Network ID</th>
                    <th>Remote Name</th>
                    <th>Remote Type</th>
                    <th>Region</th>
                    <th>Main Branch</th>
                    <th>Branch Code</th>
                    <th>IP WAN</th>
                    <th>Network Status</th>
                    <th>Last Change Update</th>
                    <th>Bandwidth</th>
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

<!--ADD JARKOM-->
<!-- <div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Network</h4>
      </div>
      <div class="modal-body">
          <form role="form" action="" method='post' id="formid">
            <div class="box-body">
              <div class="row">
                  <div class="form-group">
                    <label>Remote</label>
                    <select class="form-control select2" id="nama_remote" style="width: 100%;" name="nama_remote"></select>
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
                      <input type="text" name="ip_wan" class="form-control" value="" data-inputmask="'alias': 'ip'" data-mask >
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
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="saveNet()">Save</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div> -->

<script type="text/javascript">

  $(document).ready(function(){
    //alert("test jquery");
    tampilkan_data();
    //pilih_data();
    $('[data-mask]').inputmask();

    $("#nama_remote").select2({
      minimumInputLength:5,
      placeholder:'Remote Name',
      //allowClear:true,
      ajax:{

        url: "<?php echo base_url().'index.php/Master/GetRemote';?>",
          dataType: 'JSON',
          type: "GET",
          data: function (params) {
            console.log(params);
             return{
              nama_remote:params.term
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


    $("#spk").select2({
      minimumInputLength:5,
      placeholder:'Choose SPK',
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

  });

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

  function tampilkan_data()
  {
    $("#table_data").DataTable({
      processing:true,
      serverSide:true,
      columns:[

        {data:"No"},
        {data:"Network ID"},
        {data:"Remote Name"},
        {data:"Remote Type"},
        {data:"Region"},
        {data:"Main Branch"},
        {data:"Branch Code"},
        {data:"IP WAN"},
        {data:"Network Status"},
        {data:"Last Change Update"},
        {data:"Bandwidth"},
        {data:"Action"}
      ],
      columnDefs:[
        {
          targets:[0,11],
          orderable:false
        }
      ],
      ajax:{
        url:"<?php echo base_url().'index.php/Dashboard/provider_table/all';?>",
        type:"post",
        dataType:"json"

      }
    });
  }

  function getdata_jarkom(kode_jarkom){
    //alert('masoook');
    var url="<?php echo base_url(); ?>index.php/Dashboard/Getdata_jarkom";

    //ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: {kodejarkom:kode_jarkom},
        dataType: "JSON",
        success: function(data)
        {
            //alert(data.kode_jarkom);
            document.getElementById("kode_provider"+data.kode_provider).selected = "true";
            document.getElementById("brisat"+data.brisat).selected = "true";
            document.getElementById("used_status"+data.used_status).selected = "true";
            document.getElementById("kode_jenis_jarkom"+data.kode_jenis_jarkom).selected = "true";
            document.getElementById("ip_wan").value = data.ip_wan;
            document.getElementById("bandwidth").value = data.bandwidth;
            document.getElementById("kode_jarkom").value = data.kode_jarkom;
            document.getElementById("id_remote").value = data.id_remote;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error Get Data');
 
        }
    });
  }

  function getID() {
    $("#formRemote").toggle();
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

  function closeForm() {
    $("#formRemote").toggle();
  }

  function GetRemote() {
    $("select[name='nama_remote']").select2({
      minimumInputLength: 5,
      allowClear:true,
      ajax: {
          url: "<?php echo base_url().'index.php/Master/GetRemote';?>",
          dataType: 'JSON',
          type: "GET",
          data: function (params) {
            console.log(params);
             return{
              nama_remote:params.term
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
  }

  function saveNet() {
    // tgl = $('#tanggal_spk').val();
    // alert(tgl);
    var url="<?php echo base_url()."index.php/Master/SaveNet"; ?>";

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