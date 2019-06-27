
<script src="<?=base_url()?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.datetimepicker.css">






<style>
a {color : #777777;}



</style>


<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        
       <li><a href="<?php echo base_url().'index.php/ShiftReport/tableShiftReport' ?>">Shifting Report</a></li>
        <li class="active" style="color: #3C8DBC;"><?=$page?></li>
      </ol>
    </div>
</section>

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?=$page?></div>
        <div class="panel-body">

        

            <div class="box-body table-responsive no-padding">           		
				
				<div class="container" >
			        
			        <ul class="nav nav-tabs">

			        	<?php if($data_groud_station=='') { ?>			        	
			        		<li class="active" ><a href="#groud_station" data-toggle="tab" data="groud_station" style="color: red;font-weight:bold">Groud Station</a></li>
			        		<?php } else { ?>
			        			<li class="active" ><a href="#groud_station" data-toggle="tab" data="groud_station" style="color: blue;font-weight:bold">Groud Station</a></li>
			        			<?php } ?>

			            <?php if($data_simcard=='') { ?>
			            	<li><a href="#simcard" data-toggle="tab" data="simcard" style="color: red;font-weight:bold">Simcard</a></li>
			            	<?php } else { ?>
			            		<li><a href="#simcard" data-toggle="tab" data="simcard" style="color: blue;font-weight:bold">Simcard</a></li>
			            		<?php } ?>

			            <?php if($data_trouble_ticket=='') { ?>
			            	<li><a href="#trouble_ticket" data-toggle="tab" data="trouble_ticket" style="color: red;font-weight:bold">Trouble Ticket</a></li>
			            	<?php } else { ?>
			            		<li><a href="#trouble_ticket" data-toggle="tab" data="trouble_ticket" style="color: blue;font-weight:bold">Trouble Ticket</a></li>
			            		<?php } ?>

			            <?php if($data_remote_down=='') { ?>
			            	<li><a href="#remote_down" data-toggle="tab" data="remote_down" style="color: red;font-weight:bold">Remote Down</a></li>
			            	<?php } else { ?>
			            		<li><a href="#remote_down" data-toggle="tab" data="remote_down" style="color: blue;font-weight:bold">Remote Down</a></li>
			            		<?php } ?>

			             <?php if($data_routing=='') { ?>
			            	<li><a href="#routing" data-toggle="tab" data="routing" style="color: red;font-weight:bold">Routing</a></li>
			            	<?php } else { ?>
			            		<li><a href="#routing" data-toggle="tab" data="routing" style="color: blue;font-weight:bold">Routing</a></li>
			            		<?php } ?>
			            		
			            <?php if($data_ndc=='') { ?>
			            	<li><a href="#ndc" data-toggle="tab" data="ndc" style="color: red;font-weight:bold">NDC</a></li>
			            	<?php } else { ?>
			            		<li><a href="#ndc" data-toggle="tab" data="ndc" style="color: blue;font-weight:bold">NDC</a></li>
			            		<?php } ?>
			            		
			            <?php if($data_nac=='') { ?>
			            	<li><a href="#nac" data-toggle="tab" data="nac" style="color: red;font-weight:bold">NAC</a></li>
			            	<?php } else { ?>
			            		<li><a href="#nac" data-toggle="tab" data="nac" style="color: blue;font-weight:bold">NAC</a></li>
			            		<?php } ?>
			            		
			            <?php if($data_jupiter=='') { ?>
			            	<li><a href="#jupiter" data-toggle="tab" data="jupiter" style="color: red;font-weight:bold">Jupiter</a></li>
			            	<?php } else { ?>
			            		<li><a href="#jupiter" data-toggle="tab" data="jupiter" style="color: blue;font-weight:bold">Jupiter</a></li>
			            		<?php } ?>
			        </ul>
			        
			        <div class="tab-content">
			            <div class="tab-pane active" style="height:300px;" id="groud_station">
			               <div class="col-md-12 area_report" style="padding: 50px;" >
								<h2> Report Name: GROUD STATION</h2>
								<p> shift <?=$shift?> ( <?=$shift_date?> ) </p>
								
								<form class="form_team" id="groud_station_form" method="post" data="groud_station">
									<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="groud_station_textarea" name="groud_station_textarea">
										<?=$data_groud_station?>
									</textarea><br>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-backward"></span>
										BACK
									</button>&nbsp;	

									<?php if($data_activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>

									
								</form>
								
							</div>
			            </div>

			            <div class="tab-pane" style="height:300px;" id="simcard">
			               	
			               	 <div class="col-md-12 area_report" style="padding: 50px;"  >	
			               		<h2> Report Name: SIMCARD</h2>
								<p> shift <?=$shift?> ( <?=$shift_date?> ) </p>

								<form class="form_team" id="simcard_form" method="post" data="simcard">
									<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="simcard_textarea" name="simcard_textarea">
										<?=$data_simcard?>
									</textarea><br>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-backward"></span>	
										BACK
									</button>&nbsp;

									<?php if($data_activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>

									
								</form>
								
							</div>	

			            </div>

			            <div class="tab-pane" style="height:300px;" id="trouble_ticket">
			              <div class="col-md-12 area_report" style="padding: 50px;"  >	
			               		<h2> Report Name: TROUBLE TICKET</h2>
			               		<p> shift <?=$shift?> ( <?=$shift_date?> ) </p>
			               		<form class="form_team" id="trouble_ticket_form" method="post" data="trouble_ticket" >
			               			<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="trouble_ticket_textarea" name="trouble_ticket_textarea">
										<?=$data_trouble_ticket?>
									</textarea><br>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-backward"></span>
										BACK
									</button>&nbsp;

									<?php if($data_activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>

									
								</form>	
							</div>	
			            </div>

			            <div class="tab-pane" style="height:300px;" id="remote_down">
			              <div class="col-md-12 area_report" style="padding: 50px;"  >	
			               		<h2> Report Name: REMOTE DOWN</h2>
			               		<p> shift <?=$shift?> ( <?=$shift_date?> ) </p>
			               		<form class="form_team" id="remote_down_form" method="post" data="remote_down" >
			               			<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="remote_down_textarea" name="remote_down_textarea">
										<?=$data_remote_down?>
									</textarea><br>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-backward"></span>
										BACK
									</button>&nbsp;

									<?php if($data_activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>

									
								</form>	
							</div>	
			            </div>

			            <div class="tab-pane" style="height:300px;" id="routing">
			              <div class="col-md-12 area_report" style="padding: 50px;"  >	
			               		<h2> Report Name: ROUTING</h2>
			               		<p> shift <?=$shift?> ( <?=$shift_date?> ) </p>
			               		<form class="form_team" id="routing_form" method="post" data="routing" >
			               			<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="routing_textarea" name="routing_textarea">
										<?=$data_routing?>
									</textarea><br>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-backward"></span>
										BACK
									</button>&nbsp;

									<?php if($data_activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>

									
								</form>	
							</div>	
			            </div>

			            <div class="tab-pane" style="height:300px;" id="ndc">
			              <div class="col-md-12 area_report" style="padding: 50px;"  >	
			               		<h2> Report Name: NDC</h2>
			               		<p> shift <?=$shift?> ( <?=$shift_date?> ) </p>
			               		<form class="form_team" id="ndc_form" method="post" data="ndc" >
			               			<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="ndc_textarea" name="ndc_textarea">
										<?=$data_ndc?>
									</textarea><br>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-backward"></span>
										BACK
									</button>&nbsp;

									<?php if($data_activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>

									
								</form>	
							</div>	
			            </div>
						
						<div class="tab-pane" style="height:300px;" id="nac">
			              <div class="col-md-12 area_report" style="padding: 50px;"  >	
			               		<h2> Report Name: NAC</h2>
			               		<p> shift <?=$shift?> ( <?=$shift_date?> ) </p>
			               		<form class="form_team" id="nac_form" method="post" data="nac" >
			               			<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="nac_textarea" name="nac_textarea">
										<?=$data_nac?>
									</textarea><br>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-backward"></span>
										BACK
									</button>&nbsp;

									<?php if($data_activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>

									
								</form>	
							</div>	
			            </div>

			            <div class="tab-pane" style="height:300px;" id="jupiter">
			              <div class="col-md-12 area_report" style="padding: 50px;"  >	
			               		<h2> Report Name: JUPITER</h2>
			               		<p> shift <?=$shift?> ( <?=$shift_date?> ) </p>
			               		<form class="form_team" id="jupiter_form" method="post" data="jupiter" >
			               			<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="jupiter_textarea" name="jupiter_textarea">
										<?=$data_jupiter?>
									</textarea><br>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-backward"></span>
										BACK
									</button>&nbsp;

									<?php if($data_activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>
									
									
								</form>	
							</div>	
			            </div>

			        </div>
			        <!--/tab-content-->
			    </div> <!-- /container -->  
			</div>
    	</div> 


   

</div>
</section>






<script type="text/javascript">

$(document).ready(function(){
	tinymceSetup("groud_station");
});

$(document).on("click","a",function(){
  	
  	data=$(this).attr("data");
  	tinymceSetup(data);
  });

$(document).on("submit",".form_team",function(event){
	event.preventDefault();
	data_input=$(this).serialize();
	data=$(this).attr("data");

	data_input +="&dataForm="+data;
	

	$.ajax({
		url:"<?=base_url()?>index.php/ShiftReport/update_data_report",
		data:data_input,
		type:"post",
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
			if(response.process_update == true)
			{
				alert("success");
			}else{
				alert("failed");
			}
		}
	});
})


	

	function tinymceSetup(id)
	{
		tinymce.init({
	    selector: "#"+id+"_textarea",
	    menubar: "file edit view insert format",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],  
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

	    table_default_attributes: {
		    'border': '1'
		},
		table_default_styles: {
		    'border-collapse': 'collapse',
		    'width': '100%'
		},

		table_toolbar:"tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",

	    height:300
	});
	}

</script>











