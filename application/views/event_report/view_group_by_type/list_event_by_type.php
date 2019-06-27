<style>
a {color : #777777;}
</style>

<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        
       <li>Event List</li>
        <!-- <li class="active" style="color: #3C8DBC;">list Report</li> -->
      </ol>
    </div>
</section>

<section class="content" style="height:1000px">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Event List <?php echo $event;?></div>
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
						switch($datas->status)
						{
							case 1:
								echo "<input type='button' class='btn btn-danger btn-xs' value='open'/>";
							break;

							case 4:
								echo "<input type='button' class='btn btn-success btn-xs' value='closed'/>";
							break;

							case 2:
								echo "<input type='button' class='btn btn-warning btn-xs' value='investigation'/>";
							break;

							case 3:
								echo "<input type='button' class='btn btn-secondary btn-xs' value='cancel'/>";
							break;

							default:
								$button_status = "<input type='button btn-xs' value='error button'/>";
							break;	


						}
					?>
                	</td>
					<?php
					
					?>
					
					<td>
						<?php echo "<a target='_blank' href='".base_url()."index.php/EventReport/updateEvent/$datas->id_event/edit' class='btn btn-primary btn-xs' title='edit data'><i class='fa fa-pencil'></i></a>&nbsp;<a target='_blank' href='".base_url()."index.php/EventReport/updateEvent/$datas->id_event/show' class='btn btn-warning btn-xs' title='show data'><i class='glyphicon glyphicon-eye-open'></i></a>"; ?>
					</td>
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