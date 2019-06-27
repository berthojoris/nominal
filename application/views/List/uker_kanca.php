<!-- <section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
    <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kanwil[0]->kode_kanwil; ?>">Main Branch</a></li>
    <li><a href="<?php echo base_url().'index.php/Dashboard/Remote/'.$this->uri->segment(3); ?>">Remote</a></li>
    <li class="active">Remote Table</li>
  </ol>
</section><br> -->
<style>
a {color : #777777;}
</style>

<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kanwil[0]->kode_kanwil; ?>">Main Branch</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Remote/'.$this->uri->segment(3); ?>">Remote Group</a></li>
        <li class="active" style="color: #3C8DBC;">Remote List</li>
      </ol>
    </div>
</section>
<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Network Monitoring - Region <?php echo $kanwil[0]->nama_kanwil;?> - Main Branch <?php echo $nama[0]->nama_kanca;?></div>
        <div class="panel-body">
            <div style="width:100%;height:50px;">
              <span style="float: right;">
                <a href="<?php echo base_url().'index.php/Dashboard/uker_excel/kanca/'.$nama[0]->kode_kanca?>"><button type="button" class="btn btn-primary btn-sm" style="width: 100px">
                Export Excel
                </button></a>&nbsp;<a href="<?php echo base_url();?>index.php/Dashboard/data_uker_kanca2/<?php echo $nama[0]->kode_kanca; ?>"><button type="button" class="btn btn-primary btn-sm" style="width: 100px;">Switch Style </button></a>
              </span>
			  
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="uker_kanca">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Remote Name</th>
                    <th>Remote Type</th>
                    <th>Branch Code</th>
                    <th>IP Address</th>
                    <th>Remote Status</th>
                    <th>Last Change Update</th>
                    <th>Network</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(5)+1; foreach ($data as $datas) {?>
                  <tr style="background-color: 
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
                        }?></td>
                    <td><?php echo $datas->tipe_uker;?></td>
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
                          $kop = '';
                          if ($datas->kode_op==1) {
                            $kop = 'OP';
                          }else{
                            $kop = 'NOP';
                          }
                          echo '<span class="label label-primary">UNKNOWN-'.$kop.'</span>';
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
                    <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a></td>
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
      $('#uker_kanca').DataTable();
  });
</script>