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
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
        	<?=$page?>
        </div>

        <div class="panel-body">
        	<div class="container">

        		<ul class="nav nav-tabs">
        			<li class="active" >
        				<?php if($before_next_duty =='') { ?>
        					<a href="#onDuty" data-toggle="tab" data="onDuty" style="color: red;font-weight:bold ">On Duty</a>
        					<?php } else if($db_onDuty ==''){ ?>
        						<a href="#onDuty" data-toggle="tab" data="onDuty" style="color: #b2af07;font-weight:bold ">On Duty ( Temporary or have no set) </a>
        					<?php } else{ ?>
        							<a href="#onDuty" data-toggle="tab" data="onDuty" style="color: blue;font-weight:bold ">On Duty</a>
        						<?php } ?>	
        			</li>

        			<li>
        				<?php if($after_next_duty =='') { ?>
        					<a href="#nextDuty" data-toggle="tab" data="nextDuty" style="color: red;font-weight:bold ">Next Duty</a>
        				<?php } else{ ?>
        						<a href="#nextDuty" data-toggle="tab" data="nextDuty" style="color: blue;font-weight:bold ">Next Duty</a>
        					<?php } ?>		
        			</li>
        		</ul>
				
				<div class="tab-content">
					
					<div class="tab-pane active" style="height:300px;" id="onDuty">
				           <div class="col-md-12 area_report" style="padding: 50px;"  >	
				              <h2> Personil On Duty</h2>
				              <p>  </p>
				              <form class="form_duty" id="onDuty" method="post" data="on_duty" >
						            <input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
									<textarea id="onDuty_textarea" name="on_duty_textarea">
										<?=$before_next_duty?>
									</textarea><br>

									<?php if($activity =='' ){ ?>
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-floppy-disk"></span>
										SAVE
									</button>&nbsp;
									<?php } ?>

									<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
										<span class="glyphicon glyphicon-log-out"></span>
										BACK
									</button>&nbsp;
								</form>	
							</div>	
				      </div>

				      

				    <div class="tab-pane" style="height:300px;" id="nextDuty">
				           <div class="col-md-12 area_report" style="padding: 50px;"  >	
				              <h2> Personil Next Duty</h2>
				              <p>  </p>
				              <form class="form_duty" id="nextDuty" method="post" data="next_duty" >
				      				<input type="hidden" name="id_shift" value="<?=$id_shift?>"/>
				      				<textarea id="nextDuty_textarea" name="next_duty_textarea">
				      					<?=$after_next_duty?>
				      				</textarea><br>

				      				<?php if($activity =='' ){ ?>
				      				<button type="submit" class="btn btn-primary">
				      					<span class="glyphicon glyphicon-floppy-disk"></span>
				      					SAVE
				      				</button>&nbsp;
				      				<?php } ?>
				      				
				      				<button type="button" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >
				      					<span class="glyphicon glyphicon-log-out"></span>
				      					BACK
				      				</button>&nbsp;
				      			</form>	
				      		</div>	
				    </div>
				</div>
        	</div>

        	<div class="container">
        		<div id="warning_message" class="alert alert-warning" style="display: none">warning</div>	
        	</div>

        	

        </div>        
	</div>
</div>	
</section>

<script>
	
	$(document).ready(function(){
		tinymceSetup("onDuty");
	});

	$(document).on("click","a",function(){
	  	
	  	data=$(this).attr("data");
	  	tinymceSetup(data);
	  });


	$(document).on("submit",".form_duty",function(event){

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
						//alert("success");
						$("#warning_message").html("DATA SAVED !");


					}else{
						//alert("failed");
						$("#warning_message").html("DATA CAN'T BE EMPTY !");
						$("#warning_message").removeClass("alert-warning");
						$("#warning_message").addClass("alert-danger");
					}

					$("#warning_message").fadeIn(3000);
					$("#warning_message").fadeOut(3000);


				}
			});
	})



	function tinymceSetup(id)
	{
		tinymce.init({
		    // selector: "#report_1",
		    selector: "#"+id+"_textarea",
		    plugins: [
		        "advlist autolink lists link image charmap print preview anchor",
		        "searchreplace visualblocks code fullscreen",
		        "insertdatetime media table contextmenu paste"
		    ],
		    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		    height:300
		});
	}
	

</script>

