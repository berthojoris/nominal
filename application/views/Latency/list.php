
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
        <li class="active">Latency Report</li>
      </ol>
    </div>
</section>
<section class="content">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
        Latency Report
      </div>
      <div class="panel-body">
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-striped table-hover" id="table_data">
            <thead>
              <tr>
                <th>No.</th>
                <th>Remote Name</th>
                <th>IP Remote</th>
                <th>Remote Type</th>
                <th>Network</th>
                <th>MAX</th>
                <th>MIN</th>
                <th>AVG</th>
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
    //alert("test jquery");
    tampilkan_data();
  });

  function tampilkan_data()
  {
    var kategori = "<?php echo $this->uri->segment(3);?>";
    
    $("#table_data").DataTable({
      processing:true,
      serverSide:true,
      columns:[

        {data:"No"},
        {data:"Remote Name"},
        {data:"IP Remote"},
        {data:"Remote Type"},
        {data:"Network"},
        {data:"Max"},
        {data:"Min"},
        {data:"Avg"}
      ],
      columnDefs:[
        {
          targets:[0,3],
          orderable:false
        }
      ],
      ajax:{
        url:"<?php echo base_url().'index.php/Latency/GetData/';?>",
        type:"post",
        dataType:"json"

      }
    });
  }

  

</script>