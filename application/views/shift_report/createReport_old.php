
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
        
       <li><a href="<?php echo base_url().'index.php/Dashboard/tableEvent/' ?>"><?=$page?></a></li>
        <li class="active" style="color: #3C8DBC;"><?=$page?></li>
      </ol>
    </div>
</section>

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?=$page?> <?php echo strtoupper($this->uri->segment(3));?></div>
        <div class="panel-body">

        	<div id="warning" style="display: none;"></div>

            <div class="box-body table-responsive no-padding">           		
				  <div class="col-md-3" style="clear:both;">
				  	
				  	<button id="button_add_report" type="button" class="btn btn-primary dropdown-toggle" data="closed">
				  		<i class="fa fa-th-list"></i>	
				        Create Report 
				    </button>

				   

				    <button id="button_back" type="button" class="btn btn-danger dropdown-toggle" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' ">
				  		<i class="fa fa-th-list"></i>	
				        BACK
				    </button>


				    <div id="type_report" style="display: none;">
				    	<div class='list-group-item list-group-item-action list_type_report' style='cursor:pointer;background:#edeeef;' data='1'> report 1</div>
				    	<div class='list-group-item list-group-item-action list_type_report' style='cursor:pointer;background:#edeeef;' data='2'> report 2</div>
				    	<div class='list-group-item list-group-item-action list_type_report' style='cursor:pointer;background:#edeeef;' data='3'> report 3</div>
				    	<div class='list-group-item list-group-item-action list_type_report' style='cursor:pointer;background:#edeeef;' data='4'> report 4</div>
				    	<div class='list-group-item list-group-item-action list_type_report' style='cursor:pointer;background:#edeeef;' data='5'> report 5</div>
				    </div>
				   

				    <br/><br/>
				  
				  </div>
			             
            </div>


             <div class ="report container col-md-12">
			
				<div class="col-md-12 area_report" id="area_report_1" style="display: none;">
					<label> Report Name: report 1</label><br>
					<textarea id="report_1"></textarea><br>

					<button type="submit" class="btn btn-primary">SAVE</button>&nbsp;
					<button type="reset" class="btn btn-danger">RESET</button>&nbsp;
					<button type="button" class="btn btn-warning" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' ">BACK</button>&nbsp;	
				</div>

				<div class="col-md-12 area_report" id="area_report_2" style="display: none;">
					<label> Report Name: report 2</label><br>
					<textarea id="report_2"></textarea><br>

					<button type="submit" class="btn btn-primary">SAVE</button>&nbsp;
					<button type="reset" class="btn btn-danger">RESET</button>&nbsp;
					<button type="button" class="btn btn-warning" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' " >BACK</button>&nbsp;	
				</div>

				<div class="col-md-12 area_report" id="area_report_3" style="display: none;">
					<label> Report Name: report 3</label><br>
					<textarea id="report_3"></textarea><br>

					<button type="submit" class="btn btn-primary">SAVE</button>&nbsp;
					<button type="reset" class="btn btn-danger">RESET</button>&nbsp;
					<button type="button" class="btn btn-warning" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' ">BACK</button>&nbsp;	
				</div>

				<div class="col-md-12 area_report" id="area_report_4" style="display: none;">
					<label> Report Name: report 4</label><br>
					<textarea id="report_4"></textarea><br>

					<button type="submit" class="btn btn-primary">SAVE</button>&nbsp;
					<button type="reset" class="btn btn-danger">RESET</button>&nbsp;
					<button type="button" class="btn btn-warning" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' ">BACK</button>&nbsp;	
				</div>

				<div class="col-md-12 area_report" id="area_report_5" style="display: none;">
					<label> Report Name: report 5</label><br>
					<textarea id="report_5"></textarea><br>

					<button type="submit" class="btn btn-primary">SAVE</button>&nbsp;
					<button type="reset" class="btn btn-danger">RESET</button>&nbsp;
					<button type="button" class="btn btn-warning" onclick="window.location='<?=base_url()?>index.php/ShiftReport/tableShiftReport' ">BACK</button>&nbsp;	
				</div>
			

			</div>

        </div>


        

    </div> 


   

</div>
</section>






<script type="text/javascript">

	$(document).on("click","#button_add_report",function(){
  	
  	data=$(this).attr("data");
  	//alert(data);

  	switch(data)
  	{
  		case 'closed' :
  			$(this).attr('data','open');
  			$("#type_report").slideDown('slow');
  		break;

  		case 'open' :
  			$(this).attr('data','closed');
  			$("#type_report").slideUp('slow');
  		break;
  	}
  	
  	

  });


	$(document).on("click",".list_type_report",function(){
			
		element=$(".area_report");

		//alert(element.length);
		
		for(a=0;a<element.length;a++)
		{
			element.eq(a).slideUp('slow');
		}	

		data=$(this).attr('data');
		area="report_"+data;
		tinymceSetup(area);
		
		$("#type_report").slideUp('slow');
		$("#button_add_report").attr('data','closed');
		$("#area_report_"+data).slideDown("slow");
	});

	function tinymceSetup(area)
	{
		tinymce.init({
	    // selector: "#report_1",
	    selector: "#"+area,
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




<script>
	/*tinymce.init({
	    selector: "#report_1",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});*/
</script>






