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
        <li><a href="<?php echo base_url().'index.php/eventReport/tableEvent' ?>">Event Report</a></li>

        <?php if($mode_report == 'edit' ) { ?>
        	<li class="active" style="color: #3C8DBC;">edit event</li>
        	<?php } else { ?>
        		<li class="active" style="color: #3C8DBC;">show event</li>
        	<?php } ?>

      </ol>
    </div>
</section>

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?=$page?></div>
        <div class="panel-body">
				
				
				
				<?php if($type_report=="1"){?>

					<div class="col-md-9">
						<?php
							if($mode_report =='edit')
							{
								include('plan_and_maintenance_update_form.php');	
							}else
								{
									include('plan_and_maintenance_show_data.php');
								} 							
						?>
					</div>
				
				<?php }?>

				<!-- end off page -->
				
				<?php if($type_report=="2"){?>
					
					<div class="col-md-9">
						
						<?php
							if($mode_report =='edit')
							{
								include('incident_update_form.php');	
							}else
								{
									include('incident_show_data.php');
								} 							
						?>
					</div>

						

				<?php }?>

				<!-- end off page -->

				<?php if($type_report=="3"){?>
					<div class="col-md-9">
						<?php
							if($mode_report =='edit')
							{
								include('activity_update_form.php');	
							}else
								{
									include('activity_show_data.php');
								} 							
						?>
					</div>
				<?php }?>

				<!-- end off page -->

				<?php if($type_report=="4"){?>
					<div class="col-md-9">
						<!-- <?php //include('request_update_form.php');?> -->
						<?php
							if($mode_report =='edit')
							{
								include('request_update_form.php');	
							}else
								{
									include('request_show_data.php');
								} 							
						?>						
					</div>
				<?php }?>

			<div class="container col-md-12" style="margin-top: 5px;">
					<div  id="process_alert" class="alert col-md-12" style="display:none;">
						<span id="process_message"></span>
						<!-- <button class="close" data-dismiss="alert">&times;</button> -->
					</div>
			</div>	
        	
        </div>
    </div>        
</div>
</section>





<!-- 
::
::================================
:: tinyMce set TextArea 
::==================================
::
:: Author : Idris
::
 -->

<script>

	tinymce.init({
	    selector: "#plan_detail_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	
	tinymce.init({
	    selector: "#activity_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});


	tinymce.init({
	    selector: "#note_request",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	tinymce.init({
	    selector: "#request_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});
	


	tinymce.init({
	    selector: "#note_incident",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	

	tinymce.init({
	    selector: "#note_activity",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	

	tinymce.init({
	    selector: "#root_cause_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	

	tinymce.init({
	    selector: "#action_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

</script>
