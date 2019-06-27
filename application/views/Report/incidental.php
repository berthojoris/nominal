<style>
a {color : #777777;}
/* tr:hover  #TR{ background-color : #ccd9ff }  */
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active" style="color: #3C8DBC;">Incidental Report</li>
      </ol>
    </div>
</section>
<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Incidental Remote Monitoring</div>
        <div class="panel-body">             
            <div style="width:100%;height:50px;">
				<form method="post">
					<input type="hidden" name="url" id="url" value="<?php echo base_url().'index.php/Report/incidental/'; ?>">
					<select id="sel_kanwil" name="kw" class="sumoselect" multiple="multiple" onchange="javascript:getKanca();"></select>&nbsp;
					<select id="sel_kanca"  name="kc" class="sumoselect" multiple="multiple"></select>&nbsp;
					<input type="submit" id="btn_view" value="view" />
				</form>
			</div>
      <div class="box-body table-responsive no-padding">
        <span style="margin-left:10px;font-size:18px">Total Data : <?php echo $total;?></span>
        <table class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th>No.</th>
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
            <?php $no=$this->uri->segment(3)+1; foreach ($data as $datas) {?>
            <tr id="TR" style="background-color: 
                   <?php 
                        if ($datas->status_onoff==3) {
                          //echo '#00a65a;color:white';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status_onoff==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status_onoff==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          //echo '#3c8dbc;color:white';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status_onoff==1 && $datas->kode_op==1){
                          //echo '#ff9999;';
                          $waktu = $datas->status_fail_date;
                        }else{
                          //echo '#e0e0d1';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>;">
              <td><?php echo $no;?></td>
              <td><?php echo $datas->nama_remote;
                  if ($datas->kode_tipe_uker==7) {
                      echo "<br>TID ( ";
                      foreach ($tid_atm[$datas->id_remote] as $tid_atms) {
                        echo $tid_atms->tid_atm." ";
                      }
                      echo ")";
                  }?>
              </td>
              <td><?php echo $datas->tipe_uker;?></td>
              <td><?php echo $datas->nama_kanwil;?></td>
              <td><?php echo $datas->nama_kanca;?></td>
              <td><?php echo $datas->kode_uker;?></td>
              <td><?php echo $datas->ip_lan;?></td>
              <td>
                <?php 
                  if ($datas->status_onoff==3) {
                    echo '<span class="label label-success">ONLINE</span>';
                    $waktu = $datas->status_rec_date;
                  }else if($datas->status_onoff==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status_onoff==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                    echo '<span class="label label-primary">NOP</span>';
                    $waktu = $datas->status_fail_date;
                  }else if($datas->status_onoff==1 && $datas->kode_op==1){
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
                  foreach ($jarkom[$datas->id_remote] as $jarkoms) {
                    if ($jarkoms->brisat==1) {
                      if ($jarkoms->status==3) {
                        echo '<span class="label label-success">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                      }else if ($jarkoms->status==1) {
                        echo '<span class="label label-danger">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                      }else{
                        echo '<span class="label label" style="color:#3d3d29">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                      }
                    }else{
                      if ($jarkoms->status==3) {
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
              <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px;hight:30px"><i class="fa fa-book"></i> Detail</button></a></td>
            </tr>
            <?php $no++; }?>
          </tbody>
        </table>
        <?php echo $this->pagination->create_links();?>
      </div>
    </div>
    </div>        
</div>
</section>
<script type="text/javascript">
$(document).ready(function()
{
    $(".sumoselect").SumoSelect({ okCancelInMulti: true });    
    
    getKanwil();
    //getJenisUker();
    
});
  function search() {
    kategori = $('#kategori').val();
    input = $('#input').val();
    status = $('#status').val();
    url = $('#url').val();

    if (kategori=='status') {
      window.location = url+kategori+'/'+status;
    }else{
      window.location = url+kategori+'/'+input;
    }
    //alert(location);
  }

  function status() {
    $("#status").hide();
    var pilih = $("#kategori").val(); 
    //alert(pilih);
    if (pilih=='status') {
        $("#status").show();
    }
  }
  
  function getKanca()
{
    $.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/getListKanca'); ?>",
        data: "kanwil="+$("#sel_kanwil").val(),
		dataType:'JSON',
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
            var opt = "";
            //$('#sel_kanwil')[0].sumo.add('all','All');
            for(var j=0 ; j<data['kanca'].length ;j++)
            {
                 opt +=  "<option value='"+data['kanca'][j]['kode_kanca']+"' >"+data['kanca'][j]['nama_kanca']+"</option>";
                 //$('#sel_kanwil')[0].sumo.add(data['kanwil'][j]['kode_kanwil'],data['kanwil'][j]['nama_kanwil']);
            }
            
            $("#sel_kanca").html(opt);
            
            $("#sel_kanca")[0].sumo.reload();
        } 
    });
}

function getKanwil()
{                                     
   $.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/getListKanwil'); ?>",
		dataType:'JSON',
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
            var opt = "";
            //$('#sel_kanwil')[0].sumo.add('all','All');
            for(var j=0 ; j<data['kanwil'].length ;j++)
            {
                 opt +=  "<option value='"+data['kanwil'][j]['kode_kanwil']+"' >"+data['kanwil'][j]['nama_kanwil']+"</option>";
                 //$('#sel_kanwil')[0].sumo.add(data['kanwil'][j]['kode_kanwil'],data['kanwil'][j]['nama_kanwil']);
            }
            
            $("#sel_kanwil").html(opt);
            
            $("#sel_kanwil")[0].sumo.reload();
        } 
    });
}

function view()
{
	
}
</script>