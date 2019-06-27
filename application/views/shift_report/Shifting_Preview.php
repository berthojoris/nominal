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
        <li class="active" style="color: #3C8DBC;">Shifting Preview</li>
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

		        		<?php if($activity ==''){ ?>
							<button class="btn btn-primary" id="btn_process_cut_off_shift" data="processing">
				        		<i class="glyphicon glyphicon-floppy-open"></i>	
				        		Processing Data
				        	</button>&nbsp;
		        		<?php } ?>
								
								

		        				
			        	

			        	<button class="btn btn-danger" onclick=window.location="<?=base_url().'index.php/ShiftReport/tableShiftReport'?>">
			        		<span class="glyphicon glyphicon-log-out"></span>
			        		Back
			        	</button>&nbsp;
			        </div>


			        <!-- bootstrap tabulation  -->

			        <ul class="nav nav-tabs" style="margin-top: 40px;">
			        	<li class="active" style="width: 15%;">
			        		<a href="#report_team" data-toggle="tab" class="text-center text-bold">Report Team</a>
			        	</li>
			        	<li style="width: 15%;">
			        		<a href="#report_event" data-toggle="tab" class="text-center text-bold" >Report Event</a>
			        	</li>
			        </ul>

		        	<div class="tab-content">

		        		<div class="tab-pane fade in active" id="report_team" style="padding: 30px;">
		        			
		        			<!-- team report -->
					        	<div class="col-md-12 bg-warning">

					        		
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

		        		</div>

		        		<div class="tab-pane fade" id="report_event" style="padding: 30px;">
		        			
						        	<!-- listing data event -->
							        <div class="container">
							        		
										<table class="table table-bordered table-striped table-hover col-md-12 text-center">
							        		<thead>
							        			<tr class="bg-primary ">
							        				<td>No</td>
							        				<td>Report Number</td>
							        				<td>create Date</td>
							        				<td>Event Name</td>
							        				<td>Status</td>
							        				<td>Last Update</td>
							        				<td>Detail</td>
							        			</tr>
							        		</thead>
							        		<tbody>

										<!-- :::::: jika shift sudah cut off ::::::::  -->
										 <?php if($activity !='' || $activity !=null) { ?>
										 	
							        				
							        				<?php $data_event_closed=json_decode($activity); ?>
													
													<!-- <?php var_dump($data_event_closed->activity->event) ?> -->

													<?php $no=1; ?>
							        				<?php foreach($data_event_closed->activity->event as $key) {?>
														<tr>
															<td><?=$no?></td>
															<!-- <td><?=$key->id_event?></td> -->
															<td><?=$key->report_number?></td>
															<td><?=$key->create_at?></td>
															<td><?=$key->event_name?></td>
															<td><?=$key->status?></td>
															<td><?=$key->update_at?></td>
															<td>
																<button class='btn btn-info btn-xs btn_view' data='<?=$key->id_event?>' >view</button>
															</td>
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
															<td>
																<button class='btn btn-info btn-xs btn_view' data='<?=$key->id_event?>' >view</button>
															</td>
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
									        						<td>
																		<button class='btn btn-info btn-xs btn_view' data='<?=$key->id_event?>' >view</button>
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
									        						<td>
																		<button class='btn btn-info btn-xs btn_view' data='<?=$keyClosed->id_event?>'>view</button>
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
</div>
</section>

<div id="detail_event" class="modal fade" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h3>
					<i class="fa fa-th-list"></i>
					Detail Event
					<button class="close text-white btn_close" style="color:white;font-size:30px;font-weight:bold">&times;</button>
				</h3>
				
			</div>
			<div class="modal-body">
			
				<div id="area_data" style="padding: 50px;">
					<div>
						<h3>Report Number :
							<span id="report_number"></span>	
						</h3><br/>
						<hr style="border:1px solid grey;margin-top: -10px;">	
					</div>	
					

					<div>
						<label>Event Name</label>
						<p id="event_name"></p>
					</div>

					<div>
						<label>Activity</label><br/>
						<p id="activity"></p>
					</div>
					
					<div>
						<label>Start time</label><br/>
						<p id="start_time"></p>	
					</div>
					
					<div>
						<label>End Time</label><br/>
						<p id="end_time"></p>	
					</div>

					<div>
						<label>Emails</label><br/>
						<p id="emails"></p>	
					</div>

					<div id="area_impact" style="display: none;">
						<label>Impact</label><br/>
						<p id="impact"></p>	
					</div>

					<div id="area_root_cause" style="display: none;">
						<label>Root Cause</label><br/>
						<p id="root_cause"></p>	
					</div>

					<div id="area_action" style="display: none;">
						<label>Action</label><br/>
						<p id="action"></p>	
					</div>	

					<div>
						<label>Location</label><br/>
						<p id="location"></p>	
					</div>

					<div>
						<label>Reporter</label><br/>
						<p id="reporter"></p>	
					</div>

					<div id="area_engineer" style="display: none;">
						<label>Engineer</label><br/>
						<p id="engineer"></p>	
					</div>


					<div>
						<label>status</label><br/>
						<p id="status"></p>	
					</div>

					<div>
						<label>Note</label><br/>
						<p id="note"></p>	
					</div>

					<button class="btn btn-danger btn_close"> 
					<span class="fa fa-backward"></span>	
						close 
					</button>

				</div>	
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).on("click",".btn_close",function(){

		$("#area_engineer").slideUp("slow");
		$("#engineer").html("");

		$("#area_impact").slideUp("slow");
		$("#impact").html("");
		$("#area_root_cause").slideUp("slow");
		$("#root_cause").html("");
		$("#area_action").slideUp("slow");
		$("#action").html("");

		$("#detail_event").modal("hide");
	})

	$(document).on("click",".btn_view",function(){
		data = $(this).attr('data');
		//alert(data);
		mode ="preview";

			$.ajax({
				
				url:"<?=base_url()?>index.php/EventReport/updateEvent/"+data+"/"+mode,
				type:"post",
				dataType:"json",
				beforeSend:function()
				{
					$("#ajax_loader").show();
				},
				error:function( error )
				{
					$("#ajax_loader").hide();
					console.log("error message : "+ error);
					alert("error submit");
				},
				success:function(data)
				{
					$("#ajax_loader").hide();

					$("#report_number").html(data.data_preview.report_number);

					switch(data.data_preview.type_report)
					{
						case "1":
							$("#event_name").html(data.data_preview.plan_name);
							$("#activity").html(data.data_preview.activity);	
						break;

						case "2":

							$("#area_impact").slideDown("slow");
							$("#area_root_cause").slideDown("slow");
							$("#area_action").slideDown("slow");

							$("#event_name").html(data.data_preview.incident_name);
							$("#impact").html(data.data_preview.incident[0].impact);
							$("#root_cause").html(data.data_preview.incident[0].root_cause);
							$("#action").html(data.data_preview.incident[0].action);
								
						break;

						case "3":
							$("#event_name").html(data.data_preview.event_name);
							$("#activity").html(data.data_preview.event_detail);	
						break;

						case "4":
							$("#event_name").html(data.data_preview.event_name);
							$("#activity").html(data.data_preview.event_detail);	
						break;

							$("#event_name").html("error event ");
						default:

						break;
					}

					if( data.data_preview.type_report=="1" || data.data_preview.type_report=="2" )
					{
						dataEngineer="";
						for(a=0;a<data.data_preview.enginer.length;a++)
						{
							if(a == data.data_preview.enginer.length-1)
							{
								dataEngineer += " - "+data.data_preview.enginer[a].nama_enginer;
							}else{
								dataEngineer += " - "+data.data_preview.enginer[a].nama_enginer + "<br/>";
							}
						}
						
						$("#area_engineer").slideDown("slow");
						$("#engineer").html(dataEngineer);
					}

					$("#start_time").html(data.data_preview.start_time);
					$("#end_time").html(data.data_preview.end_time);
					//$("#emails").html(data.data_preview.emails);
					$("#location").html(data.data_preview.location);
					//$("#reporter").html(data.data_preview.reporter);
					$("#status").html(data.data_preview.status);
					$("#note").html(data.data_preview.note);

					listEmail = data.data_preview.emails.split(",");
					dataEmail ="";

					for(a=0;a<listEmail.length;a++)
					{
						if(a == listEmail.length-1)
						{
							dataEmail += " - "+listEmail[a];
						}else{
							dataEmail += " - "+listEmail[a] + "<br/>";
						}
					}

					$("#emails").html(dataEmail);


					



					dataReporter="";
					for(a=0;a<data.data_preview.reporter.length;a++)
					{
						if(a == data.data_preview.reporter.length-1)
						{
							dataReporter += " - "+data.data_preview.reporter[a].nama_reporter;
						}else{
							dataReporter += " - "+data.data_preview.reporter[a].nama_reporter + "<br/>";
						}
					}

					$("#reporter").html(dataReporter);
					
					console.log(data.data_preview.reporter);
					$("#detail_event").modal("show");	
				}
			});

		
	})

	$(document).on("click","#btn_process_cut_off_shift",function(){

		status =$(this).attr('data');
		id_shift = $("#id_shift").val();
		param=id_shift+"/"+status;
		//alert($id_shift);

		$.ajax({
		url:"<?=base_url()?>index.php/ShiftReport/shift_preview/"+param,
		type:"get",
		dataType:"json",
		beforeSend:function()
		{
			$("#ajax_loader").show();
		},
		error:function()
		{
			$("#ajax_loader").show();
			alert("error submit");
		},
		success:function(response)
		{
			$("#ajax_loader").hide();
			
			//alert(response.message);
			//console.log(response);

			if(response.status == true )
			{
				window.location.reload();
			}else{

				$("#alert_message").html(" FAILED PROCESS ( Message : "+ response.message+" )" );
				$("#alert_message").removeClass("alert-info");
				$("#alert_message").addClass("alert-danger");
				$("#alert_message").fadeIn(3000);
				$("#alert_message").fadeOut(9000);
			}
		}
	});


	})
</script>