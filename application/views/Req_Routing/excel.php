<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=list_noc.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
<table border="1" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>User</th>
      <th>Verified Open</th>
      <th>Routing Ready</th>
      <th>SIM Card Ready</th>
      <th>Request Rollback</th>
      <th>Rollback Done</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
  <?php $no=1; foreach ($data as $datas) {
      $total = ($datas->v_open+$datas->routing_r+$datas->simcard_r+$datas->r_rollback+$datas->rollback_d);
      if($total==0){
        continue;
      }
    ?>
    <tr>
      <td><?php echo $no;?></td>
      <td><?php echo $datas->nama;?></td>
      <td><?php echo $datas->v_open;?></td>
      <td><?php echo $datas->routing_r;?></td>
      <td><?php echo $datas->simcard_r;?></td>
      <td><?php echo $datas->r_rollback;?></td>
      <td><?php echo $datas->rollback_d;?></td>
      <td><?php echo ($datas->v_open+$datas->routing_r+$datas->simcard_r+$datas->r_rollback+$datas->rollback_d);?></td>
    </tr>
  <?php $no++; }?>
  </tbody>
  <!-- <tfoot align="right">
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot> -->
 </table>