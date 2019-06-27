
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.datetimepicker.css">

<script src="<?=base_url()?>assets/plugins/select2/select2.full.min.js"></script>
<style type="text/css">

	.select2-container .select2-selection--single 
	{
    	height: 45px !important;
    	
	}

	

</style>


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
        <div class="panel-body">
		
		<div class="container" style="width: 100%;background:;" align="center">
			
			<div style="width: 150px;height:100px;background:;" align="center">
				<img src="<?=base_url()?>assets/img/simcard.png" style="width:100%;height: 100%; ">
			</div>

			<div class="col-md-12" style="margin-top: 20px;margin-bottom:20px;text-align:center;background:;">
		        <select id="iccidField" style="width: 50%;"></select><br><br>
		        <button class="btn btn-primary" id="btn_search">
		        	<span class="glyphicon glyphicon-search"></span>
		        	Show Data
		    	</button>
		    </div>	
			
			
			<div class="col-md-12" id="output" style="text-align: center;background:;" align="center"></div>

		</div>
		
		<div id="test_area" style="display: none;"> test slide</div>	
        
    </div>        
</div>

</section>


<!-- modal jasper -->

<div class="modal fade" id="modal_update" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3>
					<i class="fa fa-th-list"></i>	
					update data
					<button class="close btn_cancel" data-dismiss="modal" style="color:white;font-size:30px;font-weight:bold">&times;</button>
				</h3>
				
			</div>

			<div class="modal-body col-md-12">
	
				<form id="formUpdateICCID" action="<?=base_url()?>index.php/ApiSimcard/findAccess/updateDataICCID">
					

					<div class="col-md-6">
						<label>Sim Status ( Required ) </label><br>
						<select name="status" class="form-control" id="status">
							<option value="ACTIVATED">activated</option>
							<option value="DEACTIVATED">deactivated</option>
							<option value="RETIRED">retired</option>
						</select>	
					</div>


					
					<div class="col-md-6">
						<label>DEVICE ID ( SPK ) </label><br>
						<input class="form-control" type="text" name="deviceID" id="deviceID" /><br>	
						
					</div>

					
					
					 <div class="col-md-6">
						<label>Usage Limit Override </label><br>
						<select name="overageLimitOverride" class="form-control" id="overageLimitOverride">
							<option value="DEFAULT">None</option>
							<option value="TEMPORARY_OVERRIDE">Current Cycle</option>
							<option value="PERMANENT_OVERRIDE">Ongoing</option>
						</select>	
	
					</div>

					<div class="col-md-6">
						<label>Rate Plan</label><br>
						<!-- <input class="form-control" type="text" name="ratePlan" id="ratePlan" /><br> -->
						<select class="form-control" name="ratePlan" id="ratePlan"></select>
					</div>


					<div class="col-md-6">
						<label>Modem ID</label><br>
						<input class="form-control" type="text" name="modemID" id="modemID" /><br>			
					</div>

					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum1 -->
						<label class="labelCustom">accountCustom1</label><br>
						<input class="form-control" type="text" name="accountCustom1" id="accountCustom1" /><br>	
					</div>

					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum2 -->
						<label class="labelCustom">accountCustom2</label><br>
						<input class="form-control" type="text" name="accountCustom2" id="accountCustom2" /><br>	
					</div>

					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum3 -->
						<label class="labelCustom">accountCustom3</label><br>
						<input class="form-control" type="text" name="accountCustom3" id="accountCustom3" /><br>	
					</div>
					
					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum4 -->
						<label class="labelCustom">accountCustom4</label><br>
						<input class="form-control" type="text" name="accountCustom4" id="accountCustom4" /><br>	
					</div>	
					
					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum5 -->
						<label class="labelCustom">accountCustom5</label><br>
						<input class="form-control" type="text" name="accountCustom5" id="accountCustom5" /><br>	
					</div>

					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum6 -->
						<label class="labelCustom">accountCustom6</label><br>
						<input class="form-control" type="text" name="accountCustom6" id="accountCustom6" /><br>	
					</div>

					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum7 -->
						<label class="labelCustom">accountCustom7</label><br>
						<input class="form-control" type="text" name="accountCustom7" id="accountCustom7" /><br>	
					</div>

					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum8 -->
						<label class="labelCustom">accountCustom8</label><br>
						<input class="form-control" type="text" name="accountCustom8" id="accountCustom8" /><br>	
					</div>

					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum9 -->
						<label class="labelCustom">accountCustom9</label><br>
						<input class="form-control" type="text" name="accountCustom9" id="accountCustom9" /><br>	
					</div>

					<div class="col-md-6 accountCustom" style="display: none;">
						<!-- accountCostum10 -->
						<label class="labelCustom">accountCustom10</label><br>
						<input class="form-control" type="text" name="accountCustom10" id="accountCustom10" /><br>	
					</div>
						
					<div class="col-md-6">
						<label>Effective Date</label><br>

						<div class="input-group">
							<input class="form-control pick-date" id="effectiveDate" type="text" name="effectiveDate" /><br>
							<span class="input-group-addon">
				                <span class="glyphicon glyphicon-calendar"></span>
				            </span>	
						</div>
							
					</div>

					
					<div class="col-md-6">
						<input type="hidden" name="iccid" id="iccid" value="" class="form-control">
					</div> 

					<div id="area_button" class="col-md-12" style='margin-top: 20px;display: block' align="center">
						<button type="submit" class="btn btn-primary" style="margin-right: 30px;">
						<span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;	
							Send
						</button>

						<button type="button" id="btn_cancel" class="btn btn-danger btn_cancel" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove-sign"></span>	
						Back</button>	
					</div>

					<div class="col-md-12" id="bar_process" style="clear: both;text-align: center;margin-top: 10px;display: none;">
						<img src="<?=base_url()?>assets/img/ajax-loader.gif">
					</div>
					<div class="col-md-12" id="info" style="clear: both;text-align: center;margin-top: 10px;display: none"></div>

				</form>

				
				
			</div>
			
			<div class="modal-footer"></div>
		</div>
	</div>
</div>


<!-- end of modal jasper -->


<div class="modal fade" id="modal_edit">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3>
					<i class="fa fa-th-list"></i>	
					fill data
					<button class="close" data-dismiss="modal" style="color:white;font-size:30px;font-weight:bold">&times;</button>
				</h3>
				
			</div>

			<div class="modal-body col-md-12">
	
				<form id="formSaveData" action="<?=base_url()?>index.php/ApiSimcard/UpdateDataDetailSimCard">
					

					<div class="col-md-6">
						<label>kondisi simcard</label><br>
						<input class="form-control" type="text" name="kondisi_simcard" /><br>	
					</div>
					
					<div class="col-md-6">
						<label>kode replacement</label><br>
						<input class="form-control" type="text" name="kode_replacement" /><br>	
						
					</div>

					<div class="col-md-6">
						<label>tid</label><br>
						<input class="form-control" type="text" name="tid" /><br>	
					</div>
					
					<div class="col-md-6">
						<label>kode uker</label><br>
						<input class="form-control" type="text" name="kode_uker" /><br>	
					</div>

					<div class="col-md-6">
						<label>pic</label><br>
						<input class="form-control" type="text" name="pic" /><br>			
					</div>

					<div class="col-md-6">
						<label>id remote</label><br>
						<input class="form-control" type="text" name="id_remote" /><br>	
					</div>

					<div class="col-md-6">
						<label>kota</label><br>
						<input class="form-control" type="text" name="kota" /><br>	
					</div>

					<div class="col-md-6">
						<label>sn</label><br>
						<input class="form-control" type="text" name="sn" /><br>	
					</div>
					
					<div class="col-md-6">
						<label>modem id</label><br>
						<input class="form-control" type="text" name="modem_id" /><br>	
					</div>	
					
					<div class="col-md-6">
						<label>user create</label><br>
						<input class="form-control" type="text" name="user_create" disabled /><br>	
					</div>

					<div class="col-md-6">
						<label>user update</label><br>
						<input class="form-control" type="text" name="user_update" disabled /><br>	
					</div>
						
					<div class="col-md-6">
						<label>create at</label><br>

						<div class="input-group">
							<input class="form-control pick-date" id="create_at" type="text" name="create_at" disabled /><br>
							<span class="input-group-addon">
				                <span class="glyphicon glyphicon-calendar"></span>
				            </span>	
						</div>
							
					</div>

					<div class="col-md-12">
						<label>update at</label><br>
						<div class="input-group col-md-6">
							<input class="form-control pick-date" id="update_at" type="text" name="update_at" disabled /><br>
							<span class="input-group-addon">
			                	<span class="glyphicon glyphicon-calendar"></span>
			            	</span>
			            </div>		
					</div>

					<div class="col-md-12">
						<input type="hidden" name="iccid_number" id="iccid_number" value="">
					</div>

					<div class="col-md-12" style='margin-top: 5px;'>
						<button type="submit" class="btn btn-primary">save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>	
					</div>

				</form>
				
			</div>
			
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<script>

$(document).on("click",".btn_cancel",function(){

	$("#info").slideUp();
	$("#info").html("");
	$("#modal_update").modal("hide");
})	

$(document).on("submit","#formUpdateICCID",function(event){
	event.preventDefault();

	
	$(".btn_cancel").attr("disabled",true);
	

	data = new FormData(this);



	$.ajax({
		contentType:false,
		processData:false,
		url:$(this).attr("action"),
		data:data,
		type:"post",
		dataType:"json",
		beforeSend:function()
		{
			
			$("#area_button").slideUp();
			$("#bar_process").slideDown();
			$("#info").slideDown();
			$("#info").html("<i>please wait..</i>");
		},
		error:function()
		{
			$("#info").html("<i>Error Processing..</i>");
			$(".btn_cancel").attr("disabled",false);
		},
		success:function(response)
		{
			$("#area_button").slideDown();
			$("#bar_process").slideUp();
			$(".btn_cancel").attr("disabled",false);

			if(response.data == true)
			{
				$("#info").html("<i>Complete..</i>");
			}else{
				$("#info").html(response.errorMessage);
			}
			
		}
	});

});

$(document).on("click","#btn_update_simcard",function(){

	data_iccid = JSON.parse($(this).attr("data")) ;
	//console.log(data_iccid);
	

	$("#status").val(data_iccid.status);
	$("#deviceID").val(data_iccid.spk);
	$("#modemID").val(data_iccid.modem_id);	
	$("#overageLimitOverride").val(data_iccid.overage_limit_override);
	$("#iccid").val(data_iccid.iccid);

	
	
	switch(data_iccid.apn)
	{
		case "M2MEDCBRI":
			option = "<option value='IoT Individual Shared 10 MB Retro-BRIEDC'>IoT Individual Shared 10 MB Retro-BRIEDC</option>";
		break;

		case "M2MATMBRI":
			option = "<option value='IoT Individual Shared 500MB -M2MATMBRI 2'>IoT Individual Shared 500MB -M2MATMBRI 2</option>";
			option += "<option value='IoT Individual Shared 750MB-BRI'>IoT Individual Shared 750MB-BRI</option>";
		break;

		case "M2MPRSBRI":
			option = "<option value='IoT Individual Shared 3GB - M2MPRSBRI'>IoT Individual Shared 3GB - M2MPRSBRI</option>";
			option += "<option value='Trial_30Days'>Trial_30Days</option>";
				
		break;

		
	}

	
	$("#ratePlan").html(option);
	$("#ratePlan").val(data_iccid.rate_plan);	


	for(a=0;a<data_iccid.accountCustom.length;a++)
	{
		console.log("index "+a+" : "+ data_iccid.accountCustom[a]);
		if( data_iccid.accountCustom[a] != "unset")
		{
			$(".accountCustom").eq(a).show();
			$(".labelCustom").eq(a).html( " accountCustom"+(a+1)+" <i> ( "+data_iccid.accountCustom[a]+" ) </i>" );		
			$("#accountCustom"+(a+1)).val( data_iccid["accountCustom"+(a+1)] );
			
		}else{

			$(".accountCustom").eq(a).hide();
			$(".labelCustom").eq(a).html( " accountCustom"+(a+1)+" <i> ( "+data_iccid.accountCustom[a]+" ) </i>" );		
			$("#accountCustom"+(a+1)).val( data_iccid["accountCustom"+(a+1)] );
		}





		//ubah element textfield menjadi select / option pada label accountcustom9  jika apn = "M2MATMBRI"
		if(data_iccid.apn == "M2MATMBRI" && a==8)
		{

			//accountCustom9
			changeElement  = "<label class='labelCustom'>accountCustom"+(a+1)+" <i> ( "+data_iccid.accountCustom[a]+" ) </i></label><br>";
			changeElement += "<select class='form-control'  name='accountCustom9' id='accountCustom9'>";

			switch(data_iccid.accountCustom9)
			{
				case '2GB':
					changeElement += "<option value=''></option>";
					changeElement += "<option value='5GB'>5GB</option>";
					changeElement += "<option value='2GB' selected>2GB</option>";
				break;

				case '5GB':
					changeElement += "<option value=''></option>";
					changeElement += "<option value='5GB' selected>5GB</option>";
					changeElement += "<option value='2GB'>2GB</option>";
				break;

				default:
					changeElement += "<option value='' selected></option>";
					changeElement += "<option value='5GB'>5GB</option>";
					changeElement += "<option value='2GB'>2GB</option>";
				break;
			}
			
			changeElement += "</select><br>";

			$(".accountCustom").eq(a).html(changeElement);

			
		}


		//ubah element textfield menjadi select / option pada label accountcustom4  jika apn = "M2MPRSBRI"
		if(data_iccid.apn == "M2MPRSBRI" && a==3)
		{

			//accountCustom4
			changeElement  = "<label class='labelCustom'>accountCustom"+(a+1)+" <i> ( "+data_iccid.accountCustom[a]+" ) </i></label><br>";
			changeElement += "<select class='form-control'  name='accountCustom4' id='accountCustom4'>";

			switch(data_iccid.accountCustom4)
			{
				case '20GB':
					changeElement += "<option value=''></option>";
					changeElement += "<option value='10GB'>10GB</option>";
					changeElement += "<option value='20GB' selected>20GB</option>";
				break;

				case '10GB':
					changeElement += "<option value=''></option>";
					changeElement += "<option value='10GB' selected>10GB</option>";
					changeElement += "<option value='20GB'>20GB</option>";
				break;

				default:
					changeElement += "<option value='' selected></option>";
					changeElement += "<option value='10GB'>10GB</option>";
					changeElement += "<option value='20GB'>20GB</option>";
				break;
			}
			
			changeElement += "</select><br>";

			$(".accountCustom").eq(a).html(changeElement);
			
		}

		//reset element menjadi textfield  pada label accountcustom4  jika apn != "M2MPRSBRI"
		if(data_iccid.apn != "M2MPRSBRI" && a==3)
		{
			resetElement ="<label class='labelCustom'>accountCustom4 <i> ( "+data_iccid.accountCustom[a]+" ) </i></label><br>";
			resetElement += "<input class='form-control' type='text' name='accountCustom4' id='accountCustom4' /><br>";
			$(".accountCustom").eq(a).html(resetElement);
			$("#accountCustom"+(a+1)).val( data_iccid["accountCustom"+(a+1)] );
			
		}



	}

	$("#modal_update").modal("show");
	

})	




$(document).on("submit","#formSaveData",function(event){

	event.preventDefault();
	//alert(this);

	data_input = new FormData(this);
	//data_input.append("iccid",);

	$.ajax({
		contentType:false,
		processData:false,
		url:$(this).attr("action"),
		data:data_input,
		type:"post",
		dataType:"json",
		beforeSend:function()
		{
			$("#ajax_loader").show();
		},
		success:function(response)
		{
			$("#ajax_loader").hide();
			$("#modal_edit").modal("hide");
			//console.log(data_input);
		}
	});

})


$(document).on("click",".pick-date",function(){
	 id=$(this).attr("id");
	showCalendar(id);	
})

function showCalendar(id)
{
		$("#"+id).datetimepicker({
			format:'Y-m-d'+'+'+'H:i',
			scrollInput: true, // stops scrolling through dates on hover
  			autoclose: true,
  			timepicker: true //hide or show time
		});
}


$(document).on("click",".btn_edit",function(){
	//alert();
	data_iccid = $(this).attr("data");


	$.ajax({

		url:"<?=base_url()?>index.php/ApiSimcard/findSimcard",
		data:{"iccid":data_iccid},
		type:"post",
		dataType:"json",
		beforeSend:function()
		{
			$("#ajax_loader").show();
		},
		success:function(response){

			$("#ajax_loader").hide();
			$("#iccid_number").val(data_iccid);

			$("input[name=kondisi_simcard]").val(response.data[0].kondisi_simcard);
			$("input[name=kode_replacement]").val(response.data[0].kode_replacement);
			$("input[name=tid]").val(response.data[0].tid);
			$("input[name=kode_uker]").val(response.data[0].kode_uker);
			$("input[name=pic]").val(response.data[0].pic);
			$("input[name=id_remote]").val(response.data[0].id_remote);
			$("input[name=kota]").val(response.data[0].kota);
			$("input[name=sn]").val(response.data[0].sn);
			$("input[name=modem_id]").val(response.data[0].modem_id);
			$("input[name=user_create]").val(response.data[0].user_create);
			$("input[name=user_update]").val(response.data[0].user_update);
			$("input[name=create_at]").val(response.data[0].create_at);
			$("input[name=update_at]").val(response.data[0].update_at);

			$("#modal_edit").modal("show");

			//console.log(response.data);
		}
	});

	
});

$(document).on("click","#status_simcard",function(){
	//alert();
	data = $(this).attr("data");
	if(data == 'hide'){
		$(".row_change_status").slideDown("slow");//show
		$(this).attr("data","show");	
	}else if(data=='show'){
		$(".row_change_status").slideUp("slow");//hide
		$(this).attr("data","hide");
	}else{
		$(".row_change_status").slideUp("slow");//hide
		$(this).attr("data","hide");
	}
	
});

$(document).on("click","#btn_change_status",function(){
	//alert();
	iccidNumber = $(this).attr("data");
	statusChange= $("#change_status").val();

	$.ajax({
		
		url:"<?=base_url()?>index.php/ApiSimcard/findAccess/edit_status_simcard",
		type:"post",
		data:{"iccid":iccidNumber,"statusChange":statusChange},
		dataType:"json",
		beforeSend:function()
		{
			$("#ajax_loader").show();
		},
		success:function(response){
			$("#ajax_loader").hide();
			console.log(response.data);

			if(response.data == true)
			{
				message = "status iccid has changed (status : "+response.statusChange+" - "+response.iccidNumber+" )";

			}else{

				message = " failed to change status iccid";
			}

			$("#output").html(message.toUpperCase());
			$("#output").css("border","none");
		}
	});

});

$(document).on("click","#btn_search",function(){
	dataIccid = $("#iccidField").val();
	
	$.ajax({
			
			url:"<?=base_url()?>index.php/ApiSimcard/findAccess/get_device_info",
			type:"post",
			data:{iccid:dataIccid},
			dataType:"json",
			beforeSend :function()
			{
				$("#ajax_loader").show();
			},
			error:function(error){
				$("#ajax_loader").hide();
				$("#output").html(error);	
			},
			success:function(response)
			{
				$("#ajax_loader").hide();
				$("#output").css("border","1px solid #aaacaf");
				$("#output").css("border-radius","8px");
				$("#output").html(response.data);
				$("#iccidField").select2('close');	
			}


		});
})


$(document).on("keydown",".select2-search__field",function(event){

	char = event.which ? event.which : event.keyCode;

	if(char == 13)
	{
		
		
		//get value form class select2 plugins
		data = $(".select2-search__field").val();
		// put variabel data in class select2 plugins (return an object html)
		iccid=$('#select2-iccidField-container').html(data);
		
		//get data iccid that input by user
		// dataIccid = iccid[0].textContent;
		dataIccid = $("#iccidField").val() ;
		//console.log(data);


		$.ajax({
			
			url:"<?=base_url()?>index.php/ApiSimcard/findAccess/get_device_info",
			type:"post",
			data:{iccid:dataIccid},
			dataType:"json",
			beforeSend :function()
			{
				$("#ajax_loader").show();
			},
			error:function(error){
				$("#ajax_loader").hide();
				$("#output").html(error);	
			},
			success:function(response)
			{
				$("#ajax_loader").hide();
				$("#output").css("border","1px solid #aaacaf");
				$("#output").css("border-radius","8px");
				$("#output").html(response.data);
				$("#iccidField").select2('close');	
			}


		});


	}
})

$("#iccidField").select2({

	minimumInputLength:6,
	placeholder:"type at least 6 charachter",
	ajax:{
		url:"<?=base_url()?>index.php/ApiSimcard/findIccid",
		type:"post",
		dataType:"json",
		data:function(param)
		{
			//console.log(param);
			return{search:param.term}
		},
		processResults:function(data)
		{
			return{results:data}
		}
	}
});



</script>


















