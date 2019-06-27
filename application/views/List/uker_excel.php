<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=uker.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
<table border="1" width="100%">
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
  </tr>
  <?php $no=1; foreach ($data as $datas) {?>
    <tr>
      <td><?php echo $no;?></td>
      <td><?php echo $datas->nama_remote;
          if ($datas->kode_tipe_uker==7) {
              echo "&nbsp; TID ( ";
              foreach ($tid_atm[$datas->id_remote] as $tid_atms) {
                echo $tid_atms->tid_atm." ";
              }
              echo ")";
          }?></td>
      <td><?php echo $datas->tipe_uker;?></td>
      <td><?php echo $datas->nama_kanwil;?></td>
      <td><?php echo $datas->nama_kanca;?></td>
      <td>'<?php echo $datas->kode_uker;?>'</td>
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
    </tr>
  <?php $no++; }?>
 </table>