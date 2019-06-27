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
    <div class="panel panel-default" style="float: left;width:48%;margin:5px">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:11pt;"><?php echo "<center>".strtoupper($title_direksi)." | ".$total_direksi." - ".$offline_direksi."  "./*$nop_weekend_banking*/"<br ><center>1-2 & 8-9 Juni</center>";?> </div>
        <div class="panel-body" style="border-style: double;">             
           
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="direksi">
                <thead>
                  <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Address</th>
                    <th>Nearest Site</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $i=0;
                $no=$this->uri->segment(5)+1; foreach ($direksi as $datas) {
                  
                  ?>
                  <tr >
                    <td><?php echo $no;?></td>
                    <td><?php echo $datas->nama;?></td>
                    <td><?php echo $datas->jabatan;?></td>
                    <td><?php echo $datas->lokasi;?></td>
                    <td>
                      <table border="1">
                        <thead>
                         <tr>
                          <th>Remote Name</th>
                          <th>Region</th>
                          <th>Last Change</th>
                          <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                      <?php foreach($data_direksi[$i] as $list_remote){
                        //var_dump($list_remote);
                          if ($list_remote->status==3) {
                            $status = '<span class="label label-success">ONLINE</span>';
                            $waktu = $list_remote->status_rec_date;
                          }else if($list_remote->status==1 && $list_remote->kode_op==2 || ( $list_remote->kode_op==1 && $list_remote->status==1 && in_array($list_remote->kode_tipe_uker, array(10,6,11,13)) ) ){
                            $status = '<span class="label label-primary">NOP</span>';
                            $waktu = $list_remote->status_fail_date;
                          }else if($list_remote->status==1 && $list_remote->kode_op==1){
                            $status = '<span class="label label-danger">OFFLINE</span>';
                            $waktu = $list_remote->status_fail_date;
                          }else{
                            $status = '<span class="label label-primary">UNKNOWN</span>';

                            $waktu = $list_remote->status_fail_date;
                          }



                          $firstTime = strtotime($waktu);
                          $lastTime = strtotime(date('Y-m-d H:i:s'));
                          $lama = (($lastTime - $firstTime) / 3600) / 24;
                          $date_a = new DateTime($waktu);

                          $date_b = new DateTime(date('Y-m-d H:i:s'));
                          
                          $interval = date_diff($date_a, $date_b);

                          $lamane = $interval->format('%ad %hh %im %ss');   
                          //echo $list_remote->nama_remote." - ".$lamane;
                          echo "<tr><td><a href=".base_url()."index.php/Dashboard/detail_uker/".$list_remote->id_remote."/".$list_remote->kode_tipe_uker.">".$list_remote->nama_remote."</a></td><td>".$list_remote->nama_kanwil."</td><td>".$lamane."</td><td>".$status."</td></tr>";
                          
                      }

                      ?>
                      </tbody>
                      </table>
                    </td>            
                  </tr>
                <?php 
                $i++;
                $no++; }?>
                </tbody>
              </table>
            </div>
        </div>
    </div>        


    

    <div class="panel panel-default" style="float: left;width:48%;margin:5px">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:11pt;"><?php echo "<center>".strtoupper($title_komisaris)." | ".$total_komisaris." - ".$offline_komisaris."  "./*$nop_weekend_banking*/"<br ><center>1-2 & 8-9 Juni</center>";?> </div>
        <div class="panel-body" style="border-style: double;">             
           
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="komisaris">
                <thead>
                  <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Address</th>
                    <th>Nearest Site</th>
                  </tr>
                </thead>
                <tbody>
                <?php 

                $i=0;
                $no=$this->uri->segment(5)+1; foreach ($komisaris as $datas) {
                  
                  ?>
                  <tr >
                    <td><?php echo $no;?></td>
                    <td><?php echo $datas->nama;?></td>
                    <td><?php echo $datas->jabatan;?></td>
                    <td><?php echo $datas->lokasi;?></td>
                    <td>
                      <table border="1">
                        <thead>
                         <tr>
                          <th>Remote Name</th>
                          <th>Region</th>
                          <th>Last Change</th>
                          <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                      <?php foreach($data_komisaris[$i] as $list_remote){
                        //var_dump($list_remote);
                          if ($list_remote->status==3) {
                            $status = '<span class="label label-success">ONLINE</span>';
                            $waktu = $list_remote->status_rec_date;
                          }else if($list_remote->status==1 && $list_remote->kode_op==2 || ( $list_remote->kode_op==1 && $list_remote->status==1 && in_array($list_remote->kode_tipe_uker, array(10,6,11,13)) ) ){
                            $status = '<span class="label label-primary">NOP</span>';
                            $waktu = $list_remote->status_fail_date;
                          }else if($list_remote->status==1 && $list_remote->kode_op==1){
                            //$status = '<span class="label label-danger">OFFLINE</span>';
                            $waktu = $list_remote->status_fail_date;
                          }else{
                            $status = '<span class="label label-primary">UNKNOWN</span>';

                            $waktu = $list_remote->status_fail_date;
                          }



                          $firstTime = strtotime($waktu);
                          $lastTime = strtotime(date('Y-m-d H:i:s'));
                          $lama = (($lastTime - $firstTime) / 3600) / 24;
                          $date_a = new DateTime($waktu);

                          $date_b = new DateTime(date('Y-m-d H:i:s'));
                          
                          $interval = date_diff($date_a, $date_b);

                          $lamane = $interval->format('%ad %hh %im %ss');   
                          //echo $list_remote->nama_remote." - ".$lamane;
                          echo "<tr><td><a href=".base_url()."index.php/Dashboard/detail_uker/".$list_remote->id_remote."/".$list_remote->kode_tipe_uker.">".$list_remote->nama_remote."</a></td><td>".$list_remote->nama_kanwil."</td><td>".$lamane."</td><td>".$status."</td></tr>";
                          
                      }?>
                      </tbody>
                      </table>
                    </td>            
                  </tr>
                <?php 
                $i++;
                $no++; }?>
                </tbody>
              </table>
            </div>
        </div>
    </div


</div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
      $('#direksi').DataTable( {
        "pageLength": 20
      } );

      refresh();
  });

  $(document).ready(function() {
      $('#komisaris').DataTable( {
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