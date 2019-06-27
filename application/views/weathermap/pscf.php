<!-- <section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <?php //$kode_kanwil = $this->uri->segment(3);?>
    <li><a href="<?php //echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php //echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
    <li><a href="<?php //echo base_url().'index.php/Dashboard/Kanca/'.$kode_kanwil; ?>">Main Branch</a></li>
    <li class="active">Remote Table</li>
  </ol>
</section><br> -->
<style>
a {color : #777777;}

</style>

<section class="content" style="font-size: 12px;">
<!-- <div class="row"  style="height: 10px">
  <iframe height="2048px" width="1152px" src="http://172.18.65.227/plugins/Weathermap/Core-Edge-PSCF.html?zoom=50" name="iframe_a"></iframe>
</div> -->
<div style="position:relative;padding-top:56.25%;">
  <iframe src="http://172.18.65.227/plugins/Weathermap/Core-Edge-PSCF.html?zoom=10" frameborder="0" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
</div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
      $('#weekend_banking').DataTable( {
        "pageLength": 20
      } );

      refresh();
  });

  $(document).ready(function() {
      $('#layanan_terbatas').DataTable( {
        "pageLength": 20
      } );

      refresh();
  });
  $(document).ready(function() {
      $('#atm_prioritas').DataTable( {
        "pageLength": 20
      } );

      refresh();
  });

  $(document).ready(function() {
      $('#posko').DataTable( {
        "pageLength": 20
      } );

      refresh();
  });

  function refresh()
  {
      setTimeout(function(){
        window.location.reload(1);
         refresh();
      }, 60000);
  }

  function search(){
    search =  $("#search").val();
    
    if(type=='prev'){
      page = parseInt($("#page_info").val()) - 5;
    }else if(type=='next'){
      page = parseInt($("#page_info").val()) + 5;
    }else{
      page = 0; 
    }
   
   
    data = {key:key_value,page:page};
    $.ajax({
      url:"<?php echo base_url() ?>index.php/home/search_parkir",
      type:"POST",
      data:data,
      success: function(data){
          $("#daftarparkir").html(data);
        
      }
    });
  }
</script>