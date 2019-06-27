<style>
a {color : #777777;}
</style>
<section>
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kanwil[0]->kode_kanwil; ?>">Main Branch</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Remote/'.$this->uri->segment(3); ?>">Remote Group</a></li>
        <li class="active" style="color: #3C8DBC;">Remote List</li>
      </ol>
    </div>
</section>
<section class="content" style="margin-top: -20px">
 <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Monitoring Network <?php echo($nama_uker[0]->tipe_uker); ?> - Main Branch <?php echo $kanca[0]->nama_kanca;?></div>
        <div class="panel-body">             
            <div style="width:100%;height:50px;">
              <span style="float: right;">
                <a href="<?php if($data) {echo base_url().'index.php/Dashboard/uker_excel/uker/'.$data[0]->kode_kanca.'/'.$data[0]->kode_tipe_uker;}?>">
                    <button type="button" class="btn btn-block btn-primary btn-sm" style="width: 250px">Export Excel</button>
                </a>
              </span>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="uker">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Remote Name</th>
                    <th>Remote Type</th>
                    <th>Region</th>
                    <th>Main Branch</th>
                    <?php
                        if($data){
                      
                          if ($data[0]->kode_tipe_uker==7) {
                              echo "<th>ATM TID</th>";
                          }else{
                              echo "<th>Branch Code</th>";
                          }
                      
                      }
                    ?>
                    <th>IP Address</th>
                    <th>Remote Status</th>
                    <th>Last Change Update</th>
                    <th>Network</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(5)+1; foreach ($data as $datas) {?>
                	<tr>
                		<td><?php echo $no;?></td>
                		<td><?php echo $datas->nama_remote;?></td>
                    <td><?php echo $datas->tipe_uker;?></td>
                    <td><?php echo $datas->nama_kanwil;?></td>
                    <td><?php echo $datas->nama_kanca;?></td>
                		<td><?php 
                        if ($datas->kode_tipe_uker==7) {
                          foreach ($tid_atm[$datas->id_remote] as $tid_atms) {
                            echo $tid_atms->tid_atm."<br>";
                          }
                        }else{
                            echo $datas->kode_uker;
                        }
                      ?>
                    </td>
                		<td><?php echo $datas->ip_lan;?></td>
                		<td>
                			<?php 
	                			if ($datas->status_onoff==3) {
                          echo '<span class="label label-success">ONLINE</span>';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status_onoff==1 && $datas->kode_op==1){
                          echo '<span class="label label-danger">OFFLINE</span>';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status_onoff==1 && $datas->kode_op==2){
                          echo '<span class="label label-primary">NOP</span>';
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

                        //if ($a->tt_closetime == NULL) {
                          $date_b = new DateTime(date('Y-m-d H:i:s'));
                          //echo date("Y-m-d H:i:s",time());
                        //} else {
                          //$date_b = new DateTime($a->tt_closetime);
                        //}
                        $interval = date_diff($date_a, $date_b);

                        $lamane = $interval->format('%ad %hh %im %ss');   
                        echo $lamane;
                      ?>    
                    </td>
                		<td>
                			<!-- <ul class="sidebar-menu" data-widget="tree">
						        <li class="treeview">
									<a href="#">
										<i class="fa fa-list" style="color: #0099ff"></i> <span>Jarkom</span>
										<span class="pull-right-container">
										</span>
									</a>
									<ul class="treeview-menu">
										<?php 
			                				// foreach ($jarkom[$datas->id_remote] as $jarkoms) {
			                				// 	echo '<li><a href="#"><span class="label label-success" >'.$jarkoms->jenis_jarkom.'</span></a></li>';
			                				// }
			                			?>
										
									</ul>
								</li>
							</ul> -->
                			<?php 
                				foreach ($jarkom[$datas->id_remote] as $jarkoms) {
                          if ($jarkoms->brisat==1) {
                            if ($jarkoms->status==3) {
                              echo '<span class="label label-success">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }else{
                              echo '<span class="label label-danger">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }
                          }else{
                            if ($jarkoms->status==3) {
                              echo '<span class="label label-success">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }else{
                              echo '<span class="label label-danger">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }
                          }
                        }
                			?>
                		</td>
                		<td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a></td>
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
      $('#uker').DataTable();
  });
</script>