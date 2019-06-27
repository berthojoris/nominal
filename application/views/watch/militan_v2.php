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
<div class="row"  style="height: 10px">
    <div class="panel panel-default" style="float: left;width:31%;margin:5px">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:11pt;"><?php echo "<center>".strtoupper($title_weekend_banking)." | ".$total_weekend_banking." - ".$offline_weekend_banking."  "./*$nop_weekend_banking*/"<br ><center>1-2 & 8-9 Juni</center>";?> </div>
        <div class="panel-body" style="border-style: double;">             
           
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="weekend_banking">
                <thead>
                  <tr>
                    <th></th>
                    <th>Remote Name</th>
                    <th>Region</th>
                    <th>Duration Last Change</th>
                    <th>Remote Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(5)+1; foreach ($weekend_banking as $datas) {?>
                  <tr style="background-color: 
                   <?php 
                        if ($datas->status==3) {
                          //echo '#00a65a;color:white';
						  //echo '#99FF99;color:#000000';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          //echo '#3c8dbc;color:white';
						  //echo '#DFDFDF;color:#000000';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status==1 && $datas->kode_op==1){
                          //echo '#ff9999;';
						  //echo '#FFD0F0;color:#000000';
                          $waktu = $datas->status_fail_date;
                        }else{
                          //echo '#e0e0d1';
						  //echo '#e0e0d1';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>;">
                    <td><?php echo $no;?></td>
                    <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><?php echo $datas->tipe_uker." - ".$datas->nama_remote." (".$datas->ip_lan.")";?></a></td>
                    <td><?php echo $datas->nama_kanwil;?></td>
                    <td>
                      <?php 
                        //echo $datas->last_up;
                        $firstTime = strtotime($waktu);
                        $lastTime = strtotime(date('Y-m-d H:i:s'));
                        $lama = (($lastTime - $firstTime) / 3600) / 24;
                        $date_a = new DateTime($waktu);

                        $date_b = new DateTime(date('Y-m-d H:i:s'));
                        
                        $interval = date_diff($date_a, $date_b);

                        $lamane = $interval->format('%ad %hh %im %ss');   
                        echo $lamane;
                      ?>   
                    </td>
                    <td>
                      <?php 
                        if ($datas->status==3) {
                          echo '<span class="label label-success">ONLINE</span>';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          echo '<span class="label label-primary">NOP</span>';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status==1 && $datas->kode_op==1){
                          echo '<span class="label label-danger">OFFLINE</span>';
                          $waktu = $datas->status_fail_date;
                        }else{
                          echo '<span class="label label-primary">UNKNOWN</span>';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>
                    </td>                
                  </tr>
                <?php $no++; }?>
                </tbody>
              </table>
            </div>
        </div>
    </div>        


    <div class="panel panel-default" style="float: left;width:33%;margin:5px">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:11pt;"><?php echo "<center>".strtoupper($title_layanan_terbatas)." | ".$total_layanan_terbatas." - ".$offline_layanan_terbatas." "/*.$nop_layanan_terbatas*/."<br >3-7 Juni</center>";?></div>
        <div class="panel-body" style="border-style: double;">  
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="layanan_terbatas">
                <thead>
                  <tr>
                    <th width="1%"></th>
                    <th>Remote Name</th>
                    <th>Region</th>
                    <th>Duration Last Change</th>
                    <th>Remote Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(5)+1; foreach ($layanan_terbatas as $datas) {?>
                  <tr style="background-color: 
                   <?php 
                        if ($datas->status==3) {
                          //echo '#00a65a;color:white';
              //echo '#99FF99;color:#000000';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          //echo '#3c8dbc;color:white';
              //echo '#DFDFDF;color:#000000';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status==1 && $datas->kode_op==1){
                          //echo '#ff9999;';
              //echo '#FFD0F0;color:#000000';
                          $waktu = $datas->status_fail_date;
                        }else{
                          //echo '#e0e0d1';
              //echo '#e0e0d1';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>;">
                    <td><?php echo $no;?></td>
                    <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><?php echo $datas->tipe_uker." - ".$datas->nama_remote." (".$datas->ip_lan.")";?></a></td>
                    <td><?php echo $datas->nama_kanwil;?></td>
                    <td>
                      <?php 
                        //echo $datas->last_up;
                        $firstTime = strtotime($waktu);
                        $lastTime = strtotime(date('Y-m-d H:i:s'));
                        $lama = (($lastTime - $firstTime) / 3600) / 24;
                        $date_a = new DateTime($waktu);

                        $date_b = new DateTime(date('Y-m-d H:i:s'));
                        
                        $interval = date_diff($date_a, $date_b);

                        $lamane = $interval->format('%ad %hh %im %ss');   
                        echo $lamane;
                      ?>   
                    </td>
                    <td>
                      <?php 
                        if ($datas->status==3) {
                          echo '<span class="label label-success">ONLINE</span>';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          echo '<span class="label label-primary">NOP</span>';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status==1 && $datas->kode_op==1){
                          echo '<span class="label label-danger">OFFLINE</span>';
                          $waktu = $datas->status_fail_date;
                        }else{
                          echo '<span class="label label-primary">UNKNOWN</span>';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>
                    </td>                
                  </tr>
                <?php $no++; }?>
                </tbody>
              </table>
              <?php //echo $this->pagination->create_links();?>
             <!--  <ul class="pagination pull-right">
                  <?php //echo $this->pagination->create_links(); ?>
              </ul> -->
            </div>
        </div>
    </div>    

    <div class="panel panel-default" style="float: left;width:33%;margin:5px">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:11pt;"><?php echo "<center>".strtoupper($title_posko)." | ".$total_posko." - ".$offline_posko.""./*$nop_posko.*/"<br >30-31 Mei s/d 1-9 Juni</center>";?></div>
        <div class="panel-body" style="border-style: double;">  
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="posko">
                <thead>
                  <tr>
                    <th></th>
                    <th>Remote Name</th>
                    <th>Region</th>
                    <th>Duration Last Change</th>
                    <th>Remote Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(5)+1; foreach ($posko as $datas) {?>
                  <tr style="background-color: 
                   <?php 
                        if ($datas->status==3) {
                          //echo '#00a65a;color:white';
              //echo '#99FF99;color:#000000';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          //echo '#3c8dbc;color:white';
              //echo '#DFDFDF;color:#000000';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status==1 && $datas->kode_op==1){
                          //echo '#ff9999;';
              //echo '#FFD0F0;color:#000000';
                          $waktu = $datas->status_fail_date;
                        }else{
                          //echo '#e0e0d1';
              //echo '#e0e0d1';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>;">
                    <td><?php echo $no;?></td>
                    <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><?php echo $datas->lokasi." (".$datas->tipe_uker." - ".$datas->ip_lan.")";?></a></td>
                    <td><?php echo $datas->nama_kanwil;?></td>
                    <td>
                      <?php 
                        //echo $datas->last_up;
                        $firstTime = strtotime($waktu);
                        $lastTime = strtotime(date('Y-m-d H:i:s'));
                        $lama = (($lastTime - $firstTime) / 3600) / 24;
                        $date_a = new DateTime($waktu);

                        $date_b = new DateTime(date('Y-m-d H:i:s'));
                        
                        $interval = date_diff($date_a, $date_b);

                        $lamane = $interval->format('%ad %hh %im %ss');   
                        echo $lamane;
                      ?>   
                    </td>
                    <td>
                      <?php 
                        if ($datas->status==3) {
                          echo '<span class="label label-success">ONLINE</span>';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          echo '<span class="label label-primary">NOP</span>';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status==1 && $datas->kode_op==1){
                          echo '<span class="label label-danger">OFFLINE</span>';
                          $waktu = $datas->status_fail_date;
                        }else{
                          echo '<span class="label label-primary">UNKNOWN</span>';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>
                    </td>                
                  </tr>
                <?php $no++; }?>
                </tbody>
              </table>
              <?php //echo $this->pagination->create_links();?>
             <!--  <ul class="pagination pull-right">
                  <?php //echo $this->pagination->create_links(); ?>
              </ul> -->
            </div>
        </div>
    </div>    


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