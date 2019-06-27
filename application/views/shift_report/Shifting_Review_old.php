<!-- <script src="<?=base_url()?>assets/myjquery.min.js"></script> -->
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script src="<?=base_url()?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.datetimepicker.css">


<style>
a {color : #777777;}

.formChild{margin-bottom:20px;}	
</style>



<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/ShiftReport/tableShiftReport' ?>">Shifting Report</a></li>
        <li class="active" style="color: #3C8DBC;">Shifting Review</li>
      </ol>
    </div>
</section>

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?=$page?></div>

        <div class="panel-body">

        	<div>
        		<?php 
        			$date=explode( "-",$shift_date );

        			switch($date[1])
        			{
        				case '01' : $date[1]='Jan';break;
        				case '02' : $date[1]='Feb';break;
        				case '03' : $date[1]='Mar';break;
        				case '04' : $date[1]='apr';break;
        				case '05' : $date[1]='Mei';break;
        				case '06' : $date[1]='Jun';break;
        				case '07' : $date[1]='Jul';break;
        				case '08' : $date[1]='Aug';break;
        				case '09' : $date[1]='Sep';break;
        				case '10' : $date[1]='Oct';break;
        				case '11' : $date[1]='Nov';break;
        				case '12' : $date[1]='Des';break;
        			}

        			$shiftDate = $date[2]."-".$date[1]."-".$date[0];
        		?>
	        	<h2>Shift : <?=$shift?> ( <?= $shiftDate?>)</h2>
	        	<hr style="border-color: #cfd2d6" />	
	        </div>

	        <div class="content container col-md-12">

		        <div id="alert_message" class="alert alert-info" style="display:none; ">alert</div>

		        <input type="hidden" id="id_shift" value="<?=$id_shift?>"></input>
		        	<div id="area_button" style="margin-bottom: 10px;">
						
						<?php if($activity !=''){?>
		        		<button class="btn btn-warning" id="btn_convert" onclick="window.location='<?=base_url()?>index.php/ShiftReport/convert2pdf/<?=$id_shift?>'" >
					        <i class="glyphicon glyphicon-save-file"></i>	
					        	Convert
					    </button>&nbsp;

					    <button class="btn btn-info" id="btn_copy" >
					        <i class="glyphicon glyphicon-save-file"></i>	
					        	Copy
					    </button>&nbsp;

						<?php } ?>

			        	<button class="btn btn-danger" onclick=window.location="<?=base_url().'index.php/ShiftReport/tableShiftReport'?>">
			        		<span class="glyphicon glyphicon-log-out"></span>
			        		Back
			        	</button>&nbsp;
			        </div>

			        <div class="report_content" id="report_content">
						

						
						<div id="report_duty" class="col-md-12 bg-info">
							<h4>Shift On Duty</h4>
						
							<?php $data_on_duty = str_replace(array("<p>","</p>"),"",$on_duty)?>
							<?php $data=explode(",", $data_on_duty)?>
							

							<?php for ($a=0;$a<count($data);$a++){ ?>
								<?php $no=$a+1; ?>
									<?php if($data[0] != '') { ?>
										<p><?=$no." - ".$data[$a] ?></p>
									<?php }else { ?>
											<p>data not available</p>
											<?php }?>	
							<?php  } ?>	
							
						</div>
						

			        	<div id="report_team" class="col-md-12 bg-warning" style="margin-right: 15px;margin-top:30px;">	
				        	<div>
				        		<h3>GROUD STATION</h3>
				        		<hr>
				        		<div>
				        			<?=$groud_station?>
				        		</div>
				        		
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>SIMCARD</h3>
				        		<hr>
				        		<div>
				        			<?=$simcard?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />   	
				        	<div>
				        		<h3>TROUBLE TICKET</h3>
				        		<hr>
				        		<div>
				        			<?=$trouble_ticket?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />	        	
				        	<div>
				        		<h3>REMOTE DOWN</h3>
				        		<hr>
				        		<div>
				        			<?=$remote_down?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>ROUTING</h3>
				        		<hr>
				        		<div>
				        			<?=$routing?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>NDC</h3>
				        		<hr>
				        		<div>
				        			<?=$ndc?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>NAC</h3>
				        		<hr>
				        		<div>
				        			<?=$nac?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>JUPITER</h3>
				        		<hr>
				        		<div>
				        			<?=$jupiter?>
				        		</div>
				        	</div>
			        	</div>

			        	<div class="col-md-12" style="margin-top:30px;" id="report_event">		
							<table class="table table-bordered table-striped table-hover col-md-12 text-center">
				        		<thead>
				        			<tr class="bg-primary ">
				        				<td>No</td>
				        				<td>Report Number</td>
				        				<td>create Date</td>
				        				<td>Event Name</td>
				        				<td>Status</td>
				        				<td>Last Update</td>
				        			</tr>
				        		</thead>
				        		<tbody>

							<!-- :::::: jika shift sudah cut off ::::::::  -->
							 <?php if($activity !='' || $activity !=null) { ?>
							 	
				        				
				        				<?php $data_event_closed=json_decode($activity); ?>
										<?php //var_dump($id_shift) ?>

										<?php $no=1; ?>
				        				<?php foreach($data_event_closed->activity->event as $key) {?>
											<tr>
												<td><?=$no?></td>
												<td><?=$key->report_number?></td>
												<td><?=$key->create_at?></td>
												<td><?=$key->event_name?></td>
												<td><?=$key->status?></td>
												<td><?=$key->update_at?></td>
											</tr>
				        				<?php $no++; }?>

				        				<?php $data_event_open_and_inverstigated=json_decode($next_activity); ?>	
													<!-- <?php //var_dump($data->activity->event) ?> -->
													<?php foreach($data_event_open_and_inverstigated->activity->event as $key) {?>
														<tr>
															<td><?=$no?></td>
															<td><?=$key->report_number?></td>
															<td><?=$key->create_at?></td>
															<td><?=$key->event_name?></td>
															<td><?=$key->status?></td>
															<td><?=$key->update_at?></td>
														</tr>
							        				<?php $no++; }?>	

				        			
							
							<!-- :::::: jika shift belum cut off :::::::: -->

										<?php } else { ?>
											
											<?php if( count( $data_event_open_status ) > 0 || count( $data_event_closed_status ) > 0  ) { ?>
												
												<!-- event dengan status open -->
												<?php $no=1; ?>
												<?php foreach($data_event_open_status as $key){ ?>
						        					<tr>
						        						<td>
						        							<?=$no ?>
						        						</td>
						        						<td>
						        							<?=$key->report_number ?>
						        						</td>
						        						<td>
						        							<?=$key->create_at ?>
						        						</td>
						        						<td>
						        							<?=$key->event_name ?>
						        						</td>
						        						<td>
						        							<?=$key->status ?>
						        						</td>
						        						<td>
						        							<?=$key->update_at ?>
						        						</td>
						        					</tr>
						        					<?php $no++ ?>	
						        				<?php } ?>
												
												<!-- event dengan status closed -->	
												<?php //var_dump($data_event_closed_status)?>
						        				<?php foreach($data_event_closed_status as $keyClosed){ ?>
						        					<tr>
						        						<td>
						        							<?=$no ?>
						        						</td>
						        						<td>
						        							<?=$keyClosed->report_number ?>
						        						</td>
						        						<td>
						        							<?=$keyClosed->create_at ?>
						        						</td>
						        						<td>
						        							<?=$keyClosed->event_name ?>
						        						</td>
						        						<td>
						        							<?=$keyClosed->status ?>
						        						</td>
						        						<td>
						        							<?=$keyClosed->update_at ?>
						        						</td>
						        					</tr>
						        					<?php $no++ ?>	
						        				<?php } ?>
												
												<!-- jika data belum atau tidak tersedia -->	
												<?php } else { ?>	
										 		
										 			<tr>
										 				<td colspan="6">
										 					there is no data event
										 				</td>
										 			</tr>
										 		<?php } ?>
										 			
										 <?php } ?>		


				        		</tbody>
				        	</table>
				        </div>

			        </div>


			        
           </div>
        </div>

        
    </div>        
</div>
</section>

<script type="text/javascript">

$(document).on("click","#btn_copy",function(){
	CopyToClipboard("report_content");
})


function CopyToClipboard(containerid) {
	//alert();
if (document.selection) {
	 
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy"); 

} else if (window.getSelection) {

    var range = document.createRange();
     range.selectNode(document.getElementById(containerid));
     r=window.getSelection().addRange(range);
     console.log( r );
     document.execCommand("copy");
     alert("text copied") 
}}

</script>