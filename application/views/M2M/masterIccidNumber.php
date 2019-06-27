
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
		
		<table id="tableICCID" class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>NO</th>
					<th>ICCID</th>
					<th>IP</th>
					<th>MSISDN</th>
					<th>IMSI</th>
					<th>STATUS</th>
					<th>APN</th>
					<th>ACTION</th>
				</tr>	
			</thead>
			
			<tbody></tbody>
		</table>

		<div id="output"></div>
        
    </div>        
</div>
</section>

<div class="modal fade" id="modal_update" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h2>update data
					<button class="close" data-dismiss="modal">&times;</button>
				</h2>
			</div>
			<div class="modal-body">
				<form id="formUpdateData">
					
					<label>iccid</label><br>
					<input type="text"name="iccid" id="fieldIccid" class="form-control"><br>
					<label>ip</label><br>
					<input type="text"name="ip" id="fieldIp" class="form-control"><br>
					<label>msisdn</label><br>
					<input type="text"name="msisdn" id="fieldMsisdn" class="form-control"><br>
					<label>imsi</label><br>
					<input type="text"name="imsi" id="fieldImsi" class="form-control"><br>
					<input type="hidden" name="id" id="fieldId" class="form-control"><br>
					<button type="submit" class="btn btn-primary">save</button>&nbsp;
					<button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>&nbsp;
				</form>
			</div>
		</div>
	</div>
</div>

<script>

$(document).ready(function(){
	showDataICCID();
});



$(document).on("submit","#formUpdateData",function(event){
	event.preventDefault();
	//alert();
	data = new FormData(this);
	$.ajax({
		contentType:false,
		processData:false,
		url:"<?=base_url()?>index.php/ApiSimcard/changeDataMasterSimcard",
		data:data,
		dataType:"json",
		type:"post",
		beforeSend:function()
		{
			$("#ajax_loader").show();
		},
		success:function(response)
		{
			console.log(response.data);
			if(response.data==true)
			{
				$("#ajax_loader").hide();
				alert("saved..");
				$("#modal_update").modal("hide");
				$("#tableICCID").DataTable().ajax.reload();
			}else{

				$("#ajax_loader").hide();
				alert("failed save data !!");
				
			}
		}
	});
});

$(document).on("click",".btn_update_data",function(){

	data=$(this).attr("data");
	$.ajax({
		url:"<?=base_url()?>index.php/ApiSimcard/getDataSimcard",
		type:"post",
		data:{"dataId":data},
		dataType:"json",
		beforeSend:function()
		{
			$("#ajax_loader").show();
		},
		success:function(response)
		{
			//console.log(response.data);

			$("#fieldId").val(response.data.id);
			$("#fieldIccid").val(response.data.iccid);
			$("#fieldIp").val(response.data.ip);
			$("#fieldMsisdn").val(response.data.msisdn);
			$("#fieldImsi").val(response.data.imsi);

			$("#ajax_loader").hide();
			$("#modal_update").modal("show");	
		}
	});
	
})

$(document).on("click",".btn_change_status",function(){
	
	id=$(this).attr("data");

	$.ajax({
		url:"<?=base_url()?>index.php/ApiSimcard/changeDataSimcard",
		data:{"id":id},
		type:"post",
		dataType:"json",
		beforeSend:function()
		{
			$("ajax_loader").show();
		},
		success:function(response)
		{
			$("ajax_loader").hide();
			// console.log(response.data);
			$("#tableICCID").DataTable().ajax.reload();
		}
	});
})

function showDataICCID()
{
	$("#tableICCID").DataTable({
		processing:true,
		serverSide:true,
		columns:[
			{data:"NO"},
			{data:"ICCID"},
			{data:"IP"},
			{data:"MSISDN"},
			{data:"IMSI"},
			{data:"STATUS"},
			{data:"APN"},
			{data:"ACTION"}
		],
		columnDefs:[{
			orderable:false,
			targets:[6]
		}],
		order:[[0,"desc"]],
		ajax:{
			url:"<?=base_url()?>index.php/ApiSimcard/getDataICCID",
			type:"post",
			dataType:"json"
		}

	});

	/*var table=$("#tableICCID").DataTable({
		processing:true,
		serverSide:true,
		//order: [[ 0, "desc" ]],
		columns:[
			{data:"NO"},
			{data:"ICCID"},
			{data:"IP"},
			{data:"MSISDN"},
			{data:"IMSI"},
			{data:"ACTION"}
		],
		columnDefs:[{orderable:false,targets:[7]}],
		ajax:{

			url:"<?=base_url()?>index.php/ApiSimcard/getDataICCID",
			type:'post',
			dataType:'json'
		}

	});*/
}

</script>
