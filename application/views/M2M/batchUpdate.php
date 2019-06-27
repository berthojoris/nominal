
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: #3C8DBC;"><?=$page?></li>
      </ol>
    </div>
</section>

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?=$page?> <?php echo strtoupper($this->uri->segment(3));?></div>
        <div class="panel-body container">

        <button class="btn btn-primary" id="button_template" data="closed">
		<span class="glyphicon glyphicon-download"></span>	
			Download Excel Template
		</button>	
		
		<button class="btn btn-primary" id="button_upload">
		<span class="glyphicon glyphicon-upload"></span>	
			Upload files
		</button>

		<div id="apn_type" style="margin-top: 5px;width: 50%;display: none;">
			<a class='list-group-item list-group-item-action ' style='cursor:pointer;background:#edeeef;' href="<?=base_url()?>edc_template.xlsx" >M2MEDCBRI</a>
			<a class='list-group-item list-group-item-action ' style='cursor:pointer;background:#edeeef;' href="<?=base_url()?>atm_template.xlsx" >M2MATMBRI</a>
			<a class='list-group-item list-group-item-action ' style='cursor:pointer;background:#edeeef;' href="<?=base_url()?>prs_template.xlsx" >M2MPRSBRI</a>
		</div>

		<!-- <a href="<?=base_url()?>template_excel.xlsx" class="btn btn-primary">
		<span class="glyphicon glyphicon-download"></span>	
			Download Template excel
		</a> -->

		
		
		<br><br>
		<table id="tableBatch" class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>Filename</th>
					<th>Total Records</th>
					<th>Success</th>
					<th>Failed</th>
				</tr>	
			</thead>
			
			<tbody></tbody>
		</table>

		<div id="output"></div>


        
    </div>        
</div>
</section>

<div class="modal fade" id="modal_upload" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h2>Batch Update
					<button class="close" data-dismiss="modal">&times;</button>
				</h2>
			</div>

			<div class="modal-body col-md-12">

				<div>
					<form id="formBatchUpdate">
						
						<div class="form-group col-md-12" style="margin-bottom:15px;border:1px solid grey;padding: 7px;">
							
							<div class="form-group col-md-3">
								<label>Files Name (Required) :</label>		
							</div>
							<div class="form-group col-md-8">
								<input type="file" name="excel_files" id="excel_files">		
							</div>
						</div>
						
						<div id="button_area" class="form-group col-md-12" align="center" style="display: block">
							<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-upload"></span>		
								Upload
							</button>

							<button type="button" class="btn btn-danger" id="button_cancel">
							<span class="glyphicon glyphicon-remove-circle"></span>		
								Closed
							</button>
							
						</div>

						<div id="process_area" class="form-group col-md-12" align="center" style="display: none">
							<img src="<?=base_url()?>assets/img/process.gif" />
						</div>

						<div id="process_info" class="form-group col-md-12" align="center" style="display: none"></div>
							

					</form>
				</div>
					
				<div id="progress_result" style="display: none;">
					
					<!-- <div id="progress" style="margin-top: 10px;" >
						<div  id=progress_bar style=" clear:both;width:0%;border-radius:5px;background: blue;text-align: center;color: white;font-weight: bold;padding: 5px;"></div>
					</div> -->


					<div id="progress" >
					  <div id=progress_bar class="progress-bar progress-bar-striped active" role="progressbar"  style="width:0%;height: 25px;"></div>
					</div>

					<br><br><br><br><br>

					<div id="result" style="clear:both;margin-top: 90px;height: 100px;border:1px solid grey;overflow: scroll"></div>

					<div id="info" style="margin-top: 20px;"></div>

					

				</div>


			</div>
			
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<script>

$(document).ready(function(){
	showBatchUpdate();
});

$(document).on("click","#button_cancel",function(){

	$("#modal_upload").modal("hide");

});

$(document).on("click","#button_template",function(){
	
	status = $(this).attr("data");

	switch(status)
	{
		case "closed":
			$("#apn_type").slideDown("slow");
			$(this).attr("data","open");		
		break;

		case "open":
			$("#apn_type").slideUp("slow");
			$(this).attr("data","closed");		
		break;

		default:
			$("#apn_type").slideUp("slow");
			$(this).attr("data","closed");
		break;
	}
	//$("#apn_type").slideDown("slow");
})

function process_file_upload(dataFiles)
{
	//console.log(dataFiles);
	$.ajax({
			contentType:false,
			processData:false,
			url:"<?=base_url()?>index.php/ApiSimcard/process_batch_upload",
			type:"post",
			data:dataFiles,
			dataType:"json",
			beforeSend:function(){
				
				//$("#process_area").html("<i>prepare process upload files...</i>");				
			},
			error:function()
			{
				alert("something wrong..(process_file_upload)");
			},
			success:function(response)
			{
				$("#tableBatch").DataTable().ajax.reload();	

				$("#button_area").slideDown();
				$("#process_area").slideUp();
				$("#process_info").slideDown();

				//$("#progress_bar").css("width", "0%");

				if(response.data == 2)
				{
					$("#process_info").html("<i>complete process..</i>");
				}else{
					$("#process_info").html("<i>error process (upload file or save to database)... </i>");
				}
		
			}

	});	
}



function process_batch_old(dataUpload,dataFiles)
{
	//console.log(dataUpload.data);

	index_data=0;
	success =0;
	failed =0;


	for(a=0;a<dataUpload.data.length;a++)
	{

		data_iccid = dataUpload.data[a].iccid;
		data_status = dataUpload.data[a].status;

		$.ajax({
			
			url:"<?=base_url()?>index.php/ApiSimcard/findAccess/edit_status_simcard/"+data_iccid+"/"+data_status,
			type:"get",
			dataType:"json",
			beforeSend:function(){
				//$("#ajax_loader").show();
			},
			error:function(response)
			{
				alert("something wrong");
				//alert(response.errorMessage);
			},
			success:function(response)
			{
				
				
				if(response.hasOwnProperty("data"))
				{
					index_data++;
					total_data = dataUpload.data.length;
					percentage = (index_data / total_data)*100;

					$("#progress_result").slideDown();

					if(response.data == true)
					{
						result = "success";
						success++;
					}else{
						result = "failed";
						failed++;	
					}
					
					iccid = response.iccidNumber;
				
					data = iccid+" : "+result+"<br>";
					$("#result").prepend(data);

					data_info = "<b>process</b> : "+index_data+" of "+total_data+"&nbsp;&nbsp;&nbsp;&nbsp;";
					data_info += "<b>success</b> : "+success+"&nbsp;&nbsp;&nbsp;&nbsp;";
					data_info += "<b>failed</b> : "+failed+"&nbsp;&nbsp;&nbsp;&nbsp;";

					$("#info").html(data_info);
					
					$("#progress_bar").css("width", percentage.toFixed(2)+"%");
					$("#progress_bar").html(percentage.toFixed(2)+" % ");

					if(index_data == total_data)
					{
						dataFiles.append("total_data",index_data);
						dataFiles.append("total_success",success);
						dataFiles.append("total_failed",failed);

						process_file_upload(dataFiles);
					}


				
				}else{
					alert("error processing");
				}			
			}

		});

	}

}


function process_batch(dataUpload,dataFiles)
{
	//console.log(dataUpload.data);

	index_data=0;
	success =0;
	failed =0;



	for(a=0;a<dataUpload.data.length;a++)
	{

		data={

			"iccid":dataUpload.data[a].iccid,
			"status":dataUpload.data[a].status,
			"deviceID":dataUpload.data[a].deviceID,
			"modemID":dataUpload.data[a].modemID,					
			"accountCustom1":dataUpload.data[a].accountCustom1,
			"accountCustom2":dataUpload.data[a].accountCustom2,
			"accountCustom3":dataUpload.data[a].accountCustom3,
			"accountCustom4":dataUpload.data[a].accountCustom4,
			"accountCustom5":dataUpload.data[a].accountCustom5,
			"accountCustom6":dataUpload.data[a].accountCustom6,
			"accountCustom7":dataUpload.data[a].accountCustom7,
			"accountCustom8":dataUpload.data[a].accountCustom8,
			"accountCustom9":dataUpload.data[a].accountCustom9,
			"accountCustom10":dataUpload.data[a].accountCustom10,
			"overageLimitOverride":dataUpload.data[a].overageLimitOverride,
			"ratePlan":dataUpload.data[a].ratePlan,
			"effectiveDate":null
		}


		

			$.ajax({

				url:"<?=base_url()?>index.php/ApiSimcard/findAccess/update_data_batch",
				type:"post",
				data:data,
				dataType:"json",
				beforeSend:function(){
					//$("#ajax_loader").show();
				},
				error:function(response)
				{
					alert("something wrong");
					
				},
				success:function(response)
				{
					
					
					if(response.hasOwnProperty("data"))
					{
						index_data++;
						total_data = dataUpload.data.length;
						percentage = (index_data / total_data)*100;

						$("#progress_result").slideDown();

						if(response.data == true)
						{
							result = "success";
							success++;
						}else{
							result = "failed";
							failed++;	
						}
						
						if(response.iccidNumber !="")
						{
							iccid = response.iccidNumber;	
						}else{
							iccid = "iccid undetected ";
						}

						
						
					
						data = iccid+" : "+result+"<br>";
						$("#result").prepend(data);

						data_info = "<b>process</b> : "+index_data+" of "+total_data+"&nbsp;&nbsp;&nbsp;&nbsp;";
						data_info += "<b>success</b> : "+success+"&nbsp;&nbsp;&nbsp;&nbsp;";
						data_info += "<b>failed</b> : "+failed+"&nbsp;&nbsp;&nbsp;&nbsp;";

						$("#info").html(data_info);
						
						$("#progress_bar").css("width", percentage.toFixed(2)+"%");
						$("#progress_bar").html(percentage.toFixed(2)+" % ");

						if(index_data == total_data)
						{
							
							dataFiles.append("total_data",index_data);
							dataFiles.append("total_success",success);
							dataFiles.append("total_failed",failed);

							process_file_upload(dataFiles);
						}


					
					}else{
						alert("error processing");
					}			
				}

			});

		

		

	}

}



$(document).on("submit","#formBatchUpdate",function(event){

	event.preventDefault();

	file = document.getElementById("excel_files").files[0];


	if(file)
	{
		data = new FormData(this);
		$.ajax({
			contentType:false,
			processData:false,
			url:"<?=base_url()?>index.php/ApiSimcard/process_batch_update",
			type:"post",
			data:data,
			dataType:"json",
			beforeSend:function(){
				//alert("start..");
				//$("#ajax_loader").show();
				//$("#button_area").slideUp();
				//$("#process_area").slideDown();
				$("#progress_bar").css('width',"0%");
				data_info = "<b>process</b> : 0 of 0 &nbsp;&nbsp;&nbsp;&nbsp;";
				data_info += "<b>success</b> : 0 &nbsp;&nbsp;&nbsp;&nbsp;";
				data_info += "<b>failed</b> : 0 &nbsp;&nbsp;&nbsp;&nbsp;";

				$("#info").html(data_info);
				
			},
			error:function(response)
			{
				alert("something wrong..");
				//console.log(response.errorMessage);
			},
			success:function(response)
			{	

				//alert(response.error);
				console.log(response.data);
				if(response.error==false)
				{
					$("#button_area").slideUp();
					$("#process_area").slideDown();
					$("#process_info").slideUp();
					$("#result").html('');

					console.log(response.data);
					process_batch(response , data);	
				}else{
					alert(response.errorMessage);
				}
				
			}

		});	
	
	}else{
		alert("choose file !");
	}	

	
	
})


$(document).on("click","#button_upload",function(){

	$("#modal_upload").modal("show");

});



function showBatchUpdate()
{
	//alert();
	$("#tableBatch").DataTable({
		processing:true,
		serverSide:true,
		columns:[
			{data:"filename"},
			{data:"total_records"},
			{data:"success"},
			{data:"failed"}
			
		],
		order:[[0,"desc"]],
		// columnDefs:[{
		// 	orderable:false,
		// 	targets:[0,6]
		// }],
		ajax:{
			url:"<?=base_url()?>index.php/ApiSimcard/showBatchUpdate",
			type:"post",
			dataType:"json"
		}

	});

	
	

	
}

</script>
