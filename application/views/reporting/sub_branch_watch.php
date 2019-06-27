
<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kode_kanwil; ?>">Main Branch</a></li>
        <li class="active" style="color: #3C8DBC;">Remote List</li>
      </ol>
    </div>
</section>
<?php $now = strtotime(date('Y-m-d H:i:s'));?>
<section class="content">
<div class="row">
    <div class="panel panel-default " style="float: left;width:49%;">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?php echo $watch_1;?> Network Monitoring</div>
		<span style="margin-left:15px;"><?php echo "Total Data : ".count($main_branch)." Remotes";?></span>
        <div class="panel-body">             
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="main_branch">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Remote Name</th>
                    <!--<th>Remote Type</th>-->
                    <th>Region</th>
                    <!--<th>Main Branch</th>-->
                    <!--<th>Branch Code</th>-->
                    <th>IP Address</th>
                    <th>Remote Status</th>
                    <th>Last Change Update</th>
                    <th>Network</th>
                    <!--<th>Action</th>-->
                  </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($main_branch as $datas) {?>
                  <tr style="background-color: 
                   <?php 
                        if ($datas->status==3 || ($datas->status==1 && strtotime($datas->status_fail_date)>($now-900))) {
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status==1 && $datas->kode_op==1){
                          $waktu = $datas->status_fail_date;
                        }else{
                          //echo '#e0e0d1';
						  //echo '#e0e0d1';
                          $waktu = $datas->status_fail_date;
                        }
						
						$firstTime = strtotime($waktu);
                        $lastTime = strtotime(date('Y-m-d H:i:s'));
                        $lama = (($lastTime - $firstTime) / 3600) / 24;
                        $date_a = new DateTime($waktu);

                        $date_b = new DateTime(date('Y-m-d H:i:s'));
                        
                        $interval = date_diff($date_a, $date_b);

                        $lamane = $interval->format('%ad %hh %im %ss');
                      ?>;">
                    <td><?php echo $no;?></td>
                    <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><?php echo $datas->nama_remote;?></a></td>
                    <!--<td><?php echo $datas->tipe_uker;?></td>-->
                    <td><?php echo $datas->nama_kanwil;?></td>
                    <!--<td><?php echo $datas->nama_kanca;?></td>-->
                    <!--<td><?php 
                        if ($datas->kode_tipe_uker==7) {
                            foreach ($tid_atm[$datas->id_remote] as $tid_atms) {
                              echo $tid_atms->tid_atm."<br>";
                            }
                        }else{echo $datas->kode_uker;}?></td>-->
                    <td><?php echo $datas->ip_lan;?></td>
                    <td>
                      <?php 
                        if ($datas->status==3 || ($datas->status==1 && strtotime($datas->status_fail_date)>($now-900))) {
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
                    <td>
                      <?php 
                        //echo $datas->last_up;
                          
                        echo $lamane;
                      ?>    
                    </td>
                    <td>
                      <?php 
                        foreach ($jarkom_main_branch[$datas->id_remote] as $jarkoms) {
                          if ($jarkoms->brisat==1) {
                            if ($jarkoms->status==3 || ($datas->status==1 && strtotime($jarkoms->status_fail_date)>($now-900))) {
                              echo '<span class="label label-success">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }else if ($jarkoms->status==1) {
                              echo '<span class="label label-danger">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }else{
                              echo '<span class="label label" style="color:#3d3d29">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }
                          }else{
                            if ($jarkoms->status==3 || ($datas->status==1 && strtotime($jarkoms->status_fail_date)>($now-900))) {
                              echo '<span class="label label-success">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }else if ($jarkoms->status==1) {
                              echo '<span class="label label-danger">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }else{
                              echo '<span class="label label" style="color:#3d3d29">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }
                          }
                        }
                      ?>
                    </td>
                    <!--<td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a></td>-->
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

	
	
	<div class="panel panel-default " style="float: right;width:49%;">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?php echo $watch_2;?> Network Monitoring</div>
		<span style="margin-left:15px;"><?php echo "Total Data : ".count($submain_branch)." Remotes";?></span>
        <div class="panel-body">             
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="submain_branch">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Remote Name</th>
                    <!--<th>Remote Type</th>-->
                    <th>Region</th>
                    <!--<th>Main Branch</th>-->
                    <!--<th>Branch Code</th>-->
                    <th>IP Address</th>
                    <th>Remote Status</th>
                    <th>Last Change Update</th>
                    <th>Network</th>
                    <!--<th>Action</th>-->
                  </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($submain_branch as $datas) {
					
                        //echo $datas->last_up;					
					?>
                  <tr style="background-color: 
                   <?php 
                        if ($datas->status==3 || ($datas->status==1 && strtotime($datas->status_fail_date)>($now-900))) {
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
						
						 $firstTime = strtotime($waktu);
                        $lastTime = strtotime(date('Y-m-d H:i:s'));
                        $lama = (($lastTime - $firstTime) / 3600) / 24;
                        $date_a = new DateTime($waktu);

                        $date_b = new DateTime(date('Y-m-d H:i:s'));
                        
                        $interval = date_diff($date_a, $date_b);

                        $lamane = $interval->format('%ad %hh %im %ss');   
                        
						
                      ?>;">
                    <td><?php echo $no;?></td>
                    <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><?php echo $datas->nama_remote;?></a></td>
                    <!--<td><?php echo $datas->tipe_uker;?></td>-->
                    <td><?php echo $datas->nama_kanwil;?></td>
                    <!--<td><?php echo $datas->nama_kanca;?></td>-->
                    <!--<td><?php 
                        if ($datas->kode_tipe_uker==7) {
                            foreach ($tid_atm[$datas->id_remote] as $tid_atms) {
                              echo $tid_atms->tid_atm."<br>";
                            }
                        }else{echo $datas->kode_uker;}?></td>-->
                    <td><?php echo $datas->ip_lan;?></td>
                    <td>
                      <?php 
                        if ($datas->status==3 || ($datas->status==1 && strtotime($datas->status_fail_date)>($now-900))) {
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
                    <td>
                      <?php     
                        echo $lamane;
                      ?>    
                    </td>
                    <td>
                      <?php 
                        foreach ($jarkom_submain_branch[$datas->id_remote] as $jarkoms) {
                          if ($jarkoms->brisat==1) {
                            if ($jarkoms->status==3 || ($datas->status==1 && strtotime($jarkoms->status_fail_date)>($now-900))) {
                              echo '<span class="label label-success">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }else if ($jarkoms->status==1) {
                              echo '<span class="label label-danger">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }else{
                              echo '<span class="label label" style="color:#3d3d29">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }
                          }else{
                            if ($jarkoms->status==3 || ($datas->status==1 && strtotime($jarkoms->status_fail_date)>($now-900))) {
                              echo '<span class="label label-success">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }else if ($jarkoms->status==1) {
                              echo '<span class="label label-danger">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }else{
                              echo '<span class="label label" style="color:#3d3d29">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }
                          }
                        }
                      ?>
                    </td>
                    <!--<td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a></td>-->
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
      $('#main_branch').DataTable( {
        "pageLength": 25
      } );

      refresh();
  });
  
    $(document).ready(function() {
      $('#submain_branch').DataTable( {
        "pageLength": 25
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