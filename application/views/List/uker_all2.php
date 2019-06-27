<style>
a {color : #777777;}
td:hover { background-color : #99b3ff }
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
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Remote - All Region</div>
        <div class="panel-body">             
            <div style="width:100%;height:50px;">
              <input type="hidden" name="url" id="url" value="<?php echo base_url().'index.php/Dashboard/All_uker_search/'; ?>">
              <div align="right">
                <table>
                <tr>
                  <td>
                    <select class="form-control" name="kategori" style="width: 150px;height: 30px;margin-right: 5px;" id="kategori">
                      <option value="a.nama_remote">Remote Name</option>
                      <option value="c.tipe_uker">Remote Type</option>
                      <option value="e.nama_kanwil">Region</option>
                      <option value="d.nama_kanca">Main Branch</option>
                      <option value="a.kode_uker">Branch Code</option>
                      <option value="a.ip_lan">IP Address</option>
                    </select>
                  </td>
                <td>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="input" class="form-control pull-right" id="input" placeholder="Search" id="input">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-default" onclick="search()"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </td>
				<td>
					&nbsp;<a href="<?php echo base_url();?>index.php/Dashboard/All_uker"><button type="button" class="btn btn-primary btn-sm" style="width: 100px;">Switch Style </button></a>
				</td>
                </tr>
                </table>
              </div>
            </div>
      <div class="box-body table-responsive no-padding">
        <span style="margin-left:10px;font-size:18px">Total Data : <?php echo $total;?></span>
        <table class="table table-bordered table-striped" >
          <thead>
            <tr>
              <th>No.</th>
              <th>Remote Name</th>
              <th>Remote Type</th>
              <th>Region</th>
              <th>Main Branch</th>
              <th>Branch Code</th>
              <th>IP Address</th>
              <th>Last Change Update</th>
              <th>Network</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=$this->uri->segment(3)+1; foreach ($data as $datas) {?>
            <tr style="background-color: 
                   <?php 
                        if ($datas->status_onoff==3) {
                          echo '#99FF99;';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status_onoff==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status_onoff==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
                          echo '#B0FFF0;';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status_onoff==1 && $datas->kode_op==1){
                          echo '#FFC0F0;';
                          $waktu = $datas->status_fail_date;
                        }else{
                          echo '#DFDFDF';
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
              <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a></td>
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
  function search() {
    kategori = $('#kategori').val();
    input = $('#input').val();
    url = $('#url').val();
    window.location = url+kategori+'/'+input;
    //alert(location);
  }
</script>