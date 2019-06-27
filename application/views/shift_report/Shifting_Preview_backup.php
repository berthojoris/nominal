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
		        		<?php }else { ?>
								
								<button class="btn btn-warning" id="btn_convert" >
					        		<i class="glyphicon glyphicon-save-file"></i>	
					        		Convert
					        	</button>&nbsp;

		        			<?php }?>	
			        	

			        	<button class="btn btn-danger" onclick=window.location="<?=base_url().'index.php/ShiftReport/tableShiftReport'?>">
			        		<span class="glyphicon glyphicon-log-out"></span>
			        		Back
			        	</button>&nbsp;
			        </div>
		        	
		        	<!-- team report -->
		        	<div class="col-md-6 bg-warning" style="margin-right: 15px;">

		        		
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
		        	

			        	<!-- listing data event -->
			        <div class="col-md-5">
			        	<!-- <?php //var_dump($data_event)?> -->
			        	<?php if( count( $data_event_open_status ) > 0 || count( $data_event_closed_status ) > 0  ) { ?>

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
			        						        			 
			        			</tbody>
			        		</table>

			        	<?php } else { ?>
			        		<div>
			        			<p>
			        				there is no data event
			        			</p>
			        		</div>
			        	<?php } ?>

			        </div>
	        	
	        </div>
        </div>

        
    </div>        
</div>
</section>

<script type="text/javascript">
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
				buttonConvert="<button class='btn btn-warning' id='btn_convert'>";
				buttonConvert+="<i class='glyphicon glyphicon-floppy-open'></i>";
				buttonConvert+="Convert";	
				buttonConvert+="</button>&nbsp;";

				$("#btn_process_cut_off_shift").remove();
				$("#area_button").append(buttonConvert);
				$("#alert_message").html(response.message);
				$("#alert_message").fadeIn(3000);
				$("#alert_message").fadeOut(6000);
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