<table class="table table-bordered table-striped table-hover" id="table_track">
  <thead>
    <tr>
      <th>No.</th>
      <th>Status</th>
      <th>User</th>
      <th>Reason</th>
      <th>Time Response</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach ($data as $datas) {?>
      <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $datas->status_description;?></td>
        <td><?php echo $datas->user_create; ?></td>
        <td><?php echo $datas->reason;?></td>
        <td><?php echo $datas->create_at;?></td>
      </tr>
    <?php $no++;}?>
  </tbody>
</table>