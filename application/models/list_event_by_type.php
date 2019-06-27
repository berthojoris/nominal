<style>
a {color : #777777;}
</style>
<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?php echo $judul;?></div>
        <div class="panel-body">            
            <!--<div style="width:100%;height:50px;">
              <span style="float: right;">
                <a href="<?php echo base_url().'index.php/Watch/ExcelListDown/'.$this->uri->segment(3)?>"><button type="button" class="btn btn-primary btn-sm" style="width: 100px">
                Export Excel
                </button></a>
            </div>-->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="uker">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Report Number</th>
                    <th>Create At</th>
                    <th>Event Name</th>
                    <th>Event Start</th>
                    <th>Event End</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(5)+1; foreach ($data as $datas) {?>
                	<tr >
                		<td><?php echo $no;?></td>
                		<td>
							<?php echo $datas->report_number;
								/* switch($datas->id_type_event){
									case 1:
										echo "Planning/Maintenance";
										break;
									case 2:
										echo "Incident";
										break;
									case 3:
										echo "Activity";
										break;
									case 4:
										echo "Request";
										break;
								} */
							?></td>
                		<td><?php echo $datas->create_at;?></td>
                		<td><?php echo $datas->event_name;?></td>
                    <td>
                      <?php 
						echo $datas->event_start;
                      ?>
                    </td>
                	<td>
                      <?php 
						echo $datas->event_end;
					  ?>    
                    </td>
                	<td>
                			<?php 
								
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
      $('#uker').DataTable();
  });
</script>