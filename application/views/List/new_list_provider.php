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
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dash_Provider'; ?>"> Provider</a></li>
        <li class="active">Provider List</li>
      </ol>
    </div>
</section>
<section class="content">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Network - Provider <?php echo $this->uri->segment(6); ?></div>
      <div class="panel-body">
        <div style="width:100%;height:50px;">
          <!-- <span style="float:left;font-size: 25px"><?php echo "Total : "; ?></span> -->
          <span style="float:right;">
            <?php
              $kode_provider = $this->uri->segment(3);
              $kode_jenis_jarkom = $this->uri->segment(4);
              $brisat = $this->uri->segment(5);
              $name = $this->uri->segment(6);
            ?>         
            <div style="float: left; margin-right: 10px">
              <a href="<?php echo base_url().'index.php/Dashboard/uker_excel/provider/'.$kode_provider.'/'.$kode_jenis_jarkom.'/'.$brisat;?>"><button type="button" class="btn btn-primary btn-sm" style="width: 100px">
              Export Excel
              </button></a>
            </div>
          </span>
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
<!--pop up edit jarkom-->

      <div class="modal fade" id="edit_jarkom">
        <div class="modal-dialog">
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Network</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="" id="form_edit" method='post'>
                <div class="box-body">
                  <div class="row">
                    <input type="hidden" name="kode_jarkom"  value="" id="kode_jarkom">
                    <input type="hidden" name="id_remote" value="" id="id_remote">
                    <!-- <div class="col-md-6"> -->
                      <div class="form-group">
                        <label>Provider</label>
                        <select class="form-control" name="kode_provider">
                        <?php foreach ($provider as $p) {?>
                          <option value="<?php echo $p->kode_provider;?>" id="kode_provider<?php echo $p->kode_provider;?>">
                            <?php echo $p->nickname_provider;?>
                          </option>
                        <?php }?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Network Type</label>
                        <select class="form-control" name="kode_jenis_jarkom" id="jenis_jarkom" onchange="pilih_brisat()">
                        <?php foreach ($jenis_jarkom as $jj) {?>
                          <option value="<?php echo $jj->kode_jenis_jarkom;?>" id="kode_jenis_jarkom<?php echo $jj->kode_jenis_jarkom;?>">
                            <?php echo $jj->jenis_jarkom;?>
                          </option>
                        <?php }?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Used Status</label>
                        <select class="form-control" name="used_status">
                          <option value="1" id="used_status1"> Enable
                          </option>
                          <option value="used_status0"> Disable
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>BRISAT Yes/No</label>
                        <select class="form-control" name="brisat" id="brisat">
                          <option id="brisat1" value="1">BRISAT</option>
                          <option id="brisat0" value="0">NON BRISAT</option>
                          <option id="brisat2" value="2">JUPITER</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>IP WAN</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                          </div>
                          <input type="text" name="ip_wan" class="form-control" id="ip_wan" data-inputmask="'alias': 'ip'" data-mask >
                        </div>
                      </div>
                      <div class="form-group">
                        <label>BANDWIDTH</label>
                        <input type="text" name="bandwidth" class="form-control" value="" id="bandwidth">
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

<!--end edit jarkom-->
</section>
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
      <?php 
          $kode_provider = $this->uri->segment(3);
          $kode_jenis_jarkom = $this->uri->segment(4);
          $brisat = $this->uri->segment(5);
          $name = $this->uri->segment(6);
      ?>
      ajax:{
        url:"<?php echo base_url().'index.php/Dashboard/provider_table/'.$kode_provider.'/'.$kode_jenis_jarkom.'/'.$brisat.'/'.$name;?>",
        type:"post",
        dataType:"json"

      }
    });
  }


  function search() {
    search = $('#input').val();
    url = $('#url').val();
    //alert(url+search);
    window.location = url+search;
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

</script>