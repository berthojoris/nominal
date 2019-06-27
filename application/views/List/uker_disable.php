<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Remote Disable</li>
      </ol>
    </div>
</section>

<section class="content">
 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header"> 
              <div style="float: left;">
              <h3 class="box-title" style="font-weight: bold ">List Remote Disable</h3>
              </div>
              <div style="float: right;">
                <a href="<?php echo base_url().'index.php/Dashboard/uker_excel/disable/';?>"><button type="button" class="btn btn-block btn-primary btn-sm" style="width: 250px">
                Export Excel
                </button></a>
              </div>
            </div>
            <!-- /.box-header -->
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
                    <!-- <th>Remote Status</th>
                    <th>Last Change Update</th> -->
                    <th>Network</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(5)+1; foreach ($data as $datas) {?>
                	<tr>
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
                    <td><?php echo $datas->nama_kanwil;?></td>
                    <td><?php echo $datas->nama_kanca;?></td>
                		<td><?php echo $datas->kode_uker; ?></td>
                		<td><?php echo $datas->ip_lan;?></td>
                		<td>
                			<?php 
                				foreach ($jarkom[$datas->id_remote] as $jarkoms) {
                          if ($jarkoms->brisat==1) {
                            if ($jarkoms->status==3) {
                              echo '<span class="label label-success">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }else if ($jarkoms->status==1) {
                              echo '<span class="label label-danger">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }else{
                              echo '<span class="label label-primary">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                            }
                          }else{
                            if ($jarkoms->status==3) {
                              echo '<span class="label label-success">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                            }else if ($jarkoms->status==1) {
                              echo '<span class="label label-danger">'.$jarkoms->nickname_provider.'</span><br>';
                            }else{
                              echo '<span class="label label-primary">'.$jarkoms->nickname_provider.'</span><br>';
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
</section>

<script type="text/javascript">
  $(document).ready(function() {
      $('#uker').DataTable();
  });
</script>