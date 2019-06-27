
<script src="<?=base_url()?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.min.css">
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
        
       <!-- <li><a href="<?php echo base_url().'index.php/ShiftReport/tableShiftReport' ?>"><?=$page?></a></li> -->
        <li class="active" style="color: #3C8DBC;"><?=$page?></li>
      </ol>
    </div>
</section>

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?=$page?> <?php echo strtoupper($this->uri->segment(3));?></div>
        <div class="panel-body container">

        	<div id="warning" style="display: none;"></div>

            <div class="box-body table-responsive no-padding">           		
				  <div class="col-md-3" style="clear:both;">
				  	
				  	<button id="button_add_report" type="button" class="btn btn-primary dropdown-toggle" data="closed">
				  		<i class="fa fa-th-list"></i>	
				        Add Report 
				    </button>
				    
				   

				    <br/><br/>
				  
				  </div>
			  <br/><br/>
	              <div class="container col-md-12" style="clear:both;">
	              	<table class="table table-bordered table-striped table-hover text-center" id="table_data_shift_report">
		                <thead>
		                  <tr>
		                    <th class="col-md-1">No</th>  
		                    <th class="col-md-4">Tanggal</th>
		                    <th class="col-md-4">Shift</th>
		                    <th class="col-md-3">Action</th>	                    
		                  </tr>
		                </thead>
		                <tbody></tbody>

		             </table>
	              </div>            
            </div>
        </div>
    </div>        
</div>
</section>





<!-- form request event -->
<div class="modal fade" id="form_add_report" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3>
					<i class="fa fa-th-list"></i>	
					Add Reporting
					<button class="close" data-dismiss="modal" style="color:white;font-size:30px;font-weight:bold">&times;</button>
				</h3>
				
			</div>

			<div class="modal-body col-md-12">
	
				<form class="col-md-12" id="formShiftReport" data="4">
					
					<div class="col-md-12">
						<label>Shift </label><br/>
						<select name="shift" id="shift" class="form-control">
							<option value=''>-- pilih shift --</option>
							<option value='1'>shift 1</option>
							<option value='2'>shift 2</option>
							<option value='3'>shift 3</option>
						</select><br/>
						<span class="error_message" id="shift" style="display: none">message error</span>			
					</div>

					<div class="col-md-12">
						<label>Tanggal Shift :  </label><br>
						<div class='input-group date'>
							<input type="text" name="tanggal_shift" id="tanggal_shift" class="form-control end_time"></input><br>
							<span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>
						</div>
						 
						 <span class="error_message" id="tanggal_shift" style="display: none">message error</span>						
					</div>

					
	
					<div class="col-md-12">
						<br/><input type="submit" class="btn btn-primary" value="Add Report"/>&nbsp;
						<input type="reset" id="btn_cancel" name="btn_cancel" class="btn btn-danger" value="cancel" data-dismiss="modal" />&nbsp;
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>


<!-- [end] form request event -->


					


<script type="text/javascript">
	$(document).ready(function(){
		showTableDataReport();
		//showCalendar();		
	});

	$(document).on("click","#btn_cancel",function(){
		$("#shift").val('');
		$("#tanggal_shift").val('');
	})


	$(document).on("submit","#formShiftReport",function(event){
		event.preventDefault();
		
		data=$(this).serialize();
		
		$.ajax({
			// url:"<?=base_url()?>index.php/ShiftReport/insertDataShift",
			url:"<?=base_url()?>index.php/ShiftReport/checkDataShift",
			type:"post",
			data:data,
			dataType:"json",
			beforeSend:function()
			{
				$("#ajax_loader").show();
			},
			error:function()
			{
				alert("error submit form");
				$("#ajax_loader").hide();

			},
			success:function(response)
			{
				$("#ajax_loader").hide();
				if(response.process_insert == true)
				{
					alert("success");
					$("#table_data_shift_report").DataTable().ajax.reload();
					$("#shift").val('');
					$("#tanggal_shift").val('');
					$("#form_add_report").modal("hide");
					console.log(response);
				}else{
					// alert(response.process_insert)
					alert(response.message)
					console.log(response);
				}
			}
		});

	})

	function showCalendar()
	{
		$("#tanggal_shift").datetimepicker({
			format:'Y-m-d',
			//scrollInput: false, // stops scrolling through dates on hover
  			autoclose: true,
  			timepicker: false //hide time
		});

	}

	

	$(document).on("click","#button_add_report",function(){
		showCalendar();
		$("#form_add_report").modal("show");
	})

	/*$(document).on("click","#button_add_report",function(){
		$.ajax({
			url:"<?=base_url()?>/index.php/ShiftReport/checkDataShift",
			type:"get",
			dataType:"json",
			beforeSend:function()
			{
				$("#ajax_loader").show();
			},
			error:function()
			{
				alert("error process");
				$("#ajax_loader").hide();
			},
			success:function(response)
			{
				//alert(response.message);
				console.log(response);
				$("#ajax_loader").hide();
			}
		});

	})*/

	


	function showTableDataReport()
	{
		var table= $("#table_data_shift_report").DataTable({
			processing:true,
			serverSide:true,
			order: [[ 0, "desc" ]],
			columns:[
				{data:"No"},
				{data:"Tanggal"},
				{data:"Shift"},
				{data:"Action"},
			],
			columnDefs:[
				{orderable:false,targets:[3]}
			],
			ajax:{
				url:'<?=base_url()?>index.php/ShiftReport/showListShiftReport',
				type:'post',
			}
		});

		table.on( 'order.dt search.dt processing.dt page.dt', function () {
	    		table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
		        cell.innerHTML = i+1;
		        var info = table.page.info();
		        var page = info.page+1;             
		        if (page >'1') { 
		            hal = (page-1) *10;  // u can change this value of ur page
		            cell.innerHTML = hal+i+1;
		        } 
		    } );
		} ).draw(); 
	}
</script>











