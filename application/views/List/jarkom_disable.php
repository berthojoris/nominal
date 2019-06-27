<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Network Disable</li>
      </ol>
    </div>
</section>

<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-default">
    <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Network Un Used</div>
    <div class="panel-body">
      <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover" id="uker">
          <thead>
            <tr>
              <th>No.</th>
              <th>Remote Name</th>
              <th>Remote Type</th>
              <th>Region</th>
              <th>Main Branch</th>
              <th>Branch Code</th>
              <th>IP Address</th>
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
          		<td><?php echo $datas->kode_uker; ?></td>
          		<td><?php echo $datas->ip_lan;?></td>
          		<td>
          			<?php 
                    if ($datas->status_jarkom==3) {
                      echo '<span class="label label-success">'.$datas->jenis_jarkom.' / '.$datas->nickname_provider.'</span><br>';
                    }else if ($datas->status_jarkom==1) {
                      echo '<span class="label label-danger">'.$datas->jenis_jarkom.' / '.$datas->nickname_provider.'</span><br>';
                    }else{
                      echo '<span class="label label-primary">'.$datas->jenis_jarkom.' / '.$datas->nickname_provider.'</span><br>';
                    }
          			?>
          		</td>
  		        <td><a href="<?php echo base_url();?>index.php/Dashboard/Edit_jarkom_disable/<?php echo $datas->kode_jarkom.'/'.$datas->kode_tipe_uker;?>"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Edit</button></a></td>
          	</tr>
          <?php $no++; }?>
          </tbody>
        </table>
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