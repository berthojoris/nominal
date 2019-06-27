<?php
 
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=uker.xls");

header("Pragma: no-cache");

header("Expires: 0");
 
?>

<table  border="1" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Network ID</th>
            <th>Remote Name</th>
            <th>Remote Type</th>
            <th>Region</th>
            <th>Main Branch</th>
            <th>Branch Code</th>
            <th>IP WAN</th>
            <th>Network Status</th>
            <th>Last Change Update</th>
            <th>Bandwidth</th>
          </tr>
        </thead>
        <tbody>
        <?php $no=$this->uri->segment(7)+1; foreach ($remote as $datas) {?>
        	<tr>
        		<td><?php echo $no;?></td>
            <td><?php echo $datas->kode_jarkom;?></td>
            <td><?php echo $datas->nama_remote;?></td>
            <td><?php echo $datas->tipe_uker;?></td>
            <td><?php echo $datas->nama_kanwil;?></td>
            <td><?php echo $datas->nama_kanca;?></td>
            <td><?php echo $datas->kode_uker;?></td>
            <td><?php echo $datas->ip_wan;?></td>
            <td><?php 
                if ($datas->status==3) {
                  echo '<span class="label label-success">ONLINE</span>';
                  $waktu = $datas->status_rec_date;
                }else if( ($datas->status==1 && $datas->kode_op==2) || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) ) ){
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
            <td><?php 
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
            <td><?php echo $datas->bandwidth; ?>&nbsp;Kbps</td>
        	</tr>
        <?php $no++; }?>
        </tbody>
      </table>