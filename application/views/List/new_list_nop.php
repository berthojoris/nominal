<style>
a {color : #777777;}
/* tr:hover  #TR{ background-color : #ccd9ff }  */
</style>

<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li class="active" style="color: #3C8DBC;">Remote List</li>
      </ol>
    </div>
</section>
<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Remote - All Region NOP</div>
        <div class="panel-body">
          <div class="box-body table-responsive no-padding">
            <table class="table table-bordered table-striped table-hover" id="table_data">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Remote Id</th>
                  <th>Remote Name</th>
                  <th>Remote Type</th>
                  <th>Region</th>
                  <th>Main Branch</th>
                  <th>Branch Code</th>
                  <th>IP Address</th>
                  <th>Remote Status</th>
                  <th>Last Change Update</th>
                  <th>Network</th>
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


<script>

  $(document).ready(function(){
    //alert("test jquery");
    tampilkan_data();
  });

  function tampilkan_data()
  {
    $("#table_data").DataTable({
      orderMulti: true,
      processing:true,
      serverSide:true,
      columns:[

        {data:"No"},
        {data:"Remote Id"},
        {data:"Remote Name"},
        {data:"Remote Type"},
        {data:"Region"},
        {data:"Main Branch"},
        {data:"Branch Code"},
        {data:"IP Address"},
        {data:"Remote Status"},
        {data:"Last Change Update"},
        {data:"Network"},
        {data:"Action"}
      ],
      columnDefs:[
        {
          targets:[0,11],
          orderable:true
        }
      ],

      ajax:{
        url:"<?php echo base_url().'index.php/Dashboard/tampil_table/nop';?>",
        type:"post",
        dataType:"json"

      }
    });
  }

</script>