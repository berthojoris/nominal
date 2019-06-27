<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=uker.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
<table class="table table-bordered table-striped table-hover" id="uker">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Remote Name</th>
                    <th>Branch Code</th>
                    <th>Remote Type</th>
                    <th>IP Address</th>
                    <th>Downtime (second)</th>
                    <th>Total Down</th>
                    <!-- <th>Last Change Update</th>
                    <th>Network</th>
                    <th>Last Alarm Updated</th>
                    <th>Status Alarm</th> -->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(5)+1; foreach ($data as $datas) {?>
                  <tr >
                    <td><?php echo $no;?></td>
                    <td><?php echo $datas->remote_name;?></td>
                    <td><?php echo $datas->branch_code;?></td>
                    <td><?php echo $datas->remote_type;?></td>
                    <td><?php echo $datas->ip_address;?></td>
                    <td><?php echo $datas->downtime;?></td>
                    <td><?php echo $datas->total;?></td>
                    <!-- <td>
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
                    <td> 
                      <?php
                        echo substr($datas->notes_alarm,1,19); 
                      ?>
                    </td> 
            <td>
              <?php 
                
                switch ($datas->status_alarm) {
                  case 2:
                  {
                    echo '<span class="label label-danger">Unacknowledge</span> ';
                    break;
                  }
                  case 3:
                  {
                    /*echo '<span class="label label-success">Acknowledge</span> ';
                    if(is_null($datas->id_alarm_type)){
                      echo '<span class="label label-danger">Undefined</span>';
                    }else{
                      echo '<span class="label label-success">Defined</span>';
                    }*/
                    if(is_null($datas->id_alarm_type)){
                      echo '<span class="label label-danger">Unacknowledge</span>';
                    }else{
                      echo '<span class="label label-success">Acknowledge</span><br>'.$datas->alarm_type;
                    }
                    break;
                  }
                  default:
                  {
                    echo '<span class="label label" style="color:#3d3d29">No Alarm</span>';
                  }
                }
                
              ?>
            </td>-->
                    <td><a href="<?php echo base_url();?>index.php/Dashboard/detail_uker/<?php echo $datas->id_remote.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a></td>
                  </tr>
                <?php $no++; }?>
                </tbody>
              </table>