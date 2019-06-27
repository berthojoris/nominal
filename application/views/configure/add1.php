<style type="text/css">
.outer {
    width: 1250px;
    height: 100px;
    margin-left: : 0 auto;
    background: transparent;
    align-content: center;
}
.container {
    width: 200px;
    float: left;
    height: 200px;
    background: transparent;
    margin-right: -25px
}
.highcharts-yaxis-grid .highcharts-grid-line {
    display: none;
    background: transparent;
}

@media (max-width: 100%) {
    .outer {
        width: 100%;
        height: 100%;
        background: transparent;
    }
    .container {
        width: 100%;
        float: none;
        margin: 0 auto;
        background: transparent;
    }
}

#full.fullscreen{
    z-index: 9999; 
    width: 100%; 
    height: 100%; 
    position: absolute; 
    top: 0; 
    left: 0; 
    overflow: auto;
 }
  a {color : #777777;}

.blinking{
    animation:blinkingText 3s infinite;
}
@keyframes blinkingText{
    0%{     color: red;    }
    49%{    color: red    }
    50%{    color: transparent; }
    99%{    color: red;    }
    100%{   color: red;    }
}
</style>
<!-- jQuery CDN -->

<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0/jquery-ui.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />


<script type="text/javascript">
    $(document).ready(function() {
		cleanForm();
				
		$("#frm_generate").submit(function(event){
			event.preventDefault(); //prevent default action 
			var post_url = $(this).attr("action"); //get form action url
			var request_method = $(this).attr("method"); //get form GET/POST method
			var form_data = $(this).serialize(); //Encode form elements for submission
			
			$.ajax({
				url : post_url,
				type: request_method,
				data : form_data
			}).done(function(response){ 
				cleanForm();
				$("#frm_saveconfig").show();
				$("#edit_config").show();
				$("#save_config").show();
				$("#generate").hide();
				var obj = JSON.parse(response);
				$("#editor1").html(obj["config"]);
				$("#id_jarkom_gen").val(obj["id_jarkom"]);
			});
		});
		
		$("#frm_saveconfig").submit(function(event){
			event.preventDefault(); //prevent default action 
			var post_url = $(this).attr("action"); //get form action url
			var request_method = $(this).attr("method"); //get form GET/POST method
			var form_data = $(this).serialize(); //Encode form elements for submission
			
			$.ajax({
				url : post_url,
				type: request_method,
				data : form_data
			}).done(function(response){ 				
				var obj = JSON.parse(response);
				alert(obj["title"]);			
				$("#save_config").hide();
				$("#edit_config").show();
				$("#ready_push").show();
				$("#ttl_right").html("Ready To Push Configuration");
				
			});
		});
		
		$("#frm_pushconfig").submit(function(event){
			event.preventDefault(); //prevent default action 
			var post_url = $(this).attr("action"); //get form action url
			var request_method = $(this).attr("method"); //get form GET/POST method
			var form_data = $(this).serialize(); //Encode form elements for submission
			
			$.ajax({
				url : post_url,
				type: request_method,
				data : form_data
			}).done(function(response){ //
				var obj = JSON.parse(response);
				alert(obj["title"]);
				//location.reload(); 
			});
		});
        
		
		$("#ip_addr").keyup(function(e)
		{
			$("#livesearch").html("");
			var ip = $(this).val();
			if(ip.length >= 5)
			{
				//alert($(this).val());
				$.ajax({
					url : "<?php echo base_url().'index.php/Configure/GetRemote1';?>",
					type: "POST",
					data: "ip_addr="+ip,
					dataType: "JSON",
					success: function(data)
					{
						var str = "<table class='table table-hover'>";
						//alert(data[i]length);
						for(var i=0 ; i<data.length ; i++)
						{
							str += "<tr onclick='selectId(\""+data[i]["id"]+"\",\""+data[i]["ip_lan"]+"\",\""+data[i]["rem_name"]+"\");'><td>"+data[i]["text"]+"</td></tr>";
							//alert(data[i]["text"]);
						}
						str += "</table>";
						$("#livesearch").html(str);
					}
				});
			}
		});
    });
	
	function cleanForm()
	{
		$("#frm_pushconfig").hide();
		$("#frm_saveconfig").hide();
		$("#save_config").hide();
		$("#save_edit").hide();
		$("#edit_config").hide();
		$("#ready_push").hide();
		$("#generate").show();
	}
	
	function selectId(id,iplan,name)
	{
		cleanForm();
		$("#ip_addr").val(iplan);
		$("#ip_address_push").val(iplan);
		$("#ip_lan").val(iplan);
		$("#id_jarkom").val(id);
		$("#livesearch").html("");
		$("#jar_id").html(id);
		$("#rem_name").html(name);
		
		getJarkom(id);
		getSavedConfig(id);
	}
	
	function getJarkom(id_jar)
	{
		$.ajax({
			url : "<?php echo base_url().'index.php/Configure/getJarkom';?>",
			type: "POST",
			data: "id_jarkom="+id_jar,
			dataType: "JSON",
			success: function(data)
			{
				//alert(data["data"][0]["ip_wan"]);
				if(data["data"][0]["kode_jenis_jarkom"]==3)
				{
					$("#td_ip_pool").html(data["data"][0]["ip_wan"]);
					$("#ip_pool").val(data["data"][0]["ip_wan"]);
					$("#td_ip_wan").html("-");
					$("#ip_wan").val("");
					$("#interface_wan").attr("disabled",true);
					$("#ip_tunnel_1").removeAttr("disabled");
					$("#ip_tunnel_2").removeAttr("disabled");
					$("#interface_wan").html("<option selected=\"selected\" value=\"\">----</option>");
				}
				else
				{
					$("#td_ip_pool").html("-");
					$("#ip_pool").val("");
					$("#td_ip_wan").html(data["data"][0]["ip_wan"]+" / 30");
					$("#ip_wan").val(data["data"][0]["ip_wan"]);
					//$("#interface_wan").removeProp("disabled");
					$("#interface_wan").removeAttr("disabled");
					$("#ip_tunnel_1").attr("disabled",true);
					$("#ip_tunnel_2").attr("disabled",true);
					
					var wan = "";
					wan += "<option value=\"ether1-"+data["data"][0]["jenis_jarkom"]+"_"+data["data"][0]["nickname_provider"]+"\">ether1</option>";
					wan += "<option value=\"ether2-"+data["data"][0]["jenis_jarkom"]+"_"+data["data"][0]["nickname_provider"]+"\">ether2</option>";
					wan += "<option value=\"ether3-"+data["data"][0]["jenis_jarkom"]+"_"+data["data"][0]["nickname_provider"]+"\">ether3</option>";
					wan += "<option value=\"ether4-"+data["data"][0]["jenis_jarkom"]+"_"+data["data"][0]["nickname_provider"]+"\">ether4</option>";
					wan += "<option value=\"ether5-"+data["data"][0]["jenis_jarkom"]+"_"+data["data"][0]["nickname_provider"]+"\">ether5</option>";
					$("#interface_wan").html(wan);
					
				}
				
				$("#td_kode_provider").html(data["data"][0]["nama_provider"]);
				$("#kode_provider").val(data["data"][0]["kode_provider"]);
				$("#td_kode_jenis_jarkom").html(data["data"][0]["jenis_jarkom"]);
				$("#kode_jenis_jarkom").val(data["data"][0]["kode_jenis_jarkom"]);
			}
		});
	}
	
	function getSavedConfig(id)
	{
		$.ajax({
			url : "<?php echo base_url().'index.php/Configure/getSavedConfig';?>",
			type: "POST",
			data: "id_jarkom="+id,
			dataType: "JSON",
			success: function(data)
			{
				if(data["data"].length>0)
				{
					$("#frm_saveconfig").show();
					$("#edit_config").show();
					$("#ready_push").show();
					$("#generate").hide();
					$("#editor1").html(data["data"][0]["script"]);
					$("#id_jarkom_gen").val(id);
				}
				else
				{
					$("#editor1").html("");
				}
			}
		});
	}
	
	function editConfig()
	{
		$("#editor1").removeAttr("readonly");
		$("#save_edit").show();
		$("#save_config").hide();
		$("#edit_config").hide();
		$("#ready_push").hide();
		$("#generate").show();
	}
	
	function saveEdited()
	{
		$("#editor1").attr("readonly",true);
		$("#save_edit").hide();
		$("#save_config").show();
		$("#edit_config").show();
		$("#generate").hide();
	}
	
	function toPush()
	{
		$("#frm_pushconfig").show();
		$("#frm_saveconfig").hide();
	}
	
</script>
<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section style="margin-bottom: 30px">
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="" ><i class="fa fa-home"></i> Home</a></li>
      <li >Configure</li>
	  <li class="active" style="color: #3C8DBC;">New Configure</li>
    </ol>
  </div>   
</section>
<section class="content" style="margin-top:-30px;">   
    <div class="row">
        <div class="panel panel-default" style="width:49%;float: left;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">New Router Configuration</div>
			<div class="panel-body" style="height:500px;">
				<form id="frm_generate" action="<?php echo base_url();?>index.php/Configure/generate" method="post">
				<table class='table'>
					<tr>
						<th style="width:150px">IP LAN</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td>										
							<input type="text" id="ip_addr" name="ip_addr" width="100%" />
							<input type="hidden" id="id_jarkom" name="id_jarkom" />
							<input type="hidden" id="ip_lan" name="ip_lan" />
							<div id="livesearch" style="position:absolute;background-color:#FFFFFF;border:1px solid #ACACAC;"></div>
						</td>
					</tr>
					<tr>
						<th style="width:150px">ID Jarkom</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td id="jar_id">&nbsp;</td>
					</tr>
					<tr>
						<th style="width:150px">Remote Name</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td id="rem_name">&nbsp;</td>
					</tr>
					<tr>
						<th style="width:150px">IP Pool</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td id="td_ip_pool" name="td_ip_pool">&nbsp;</td><input type="hidden" id="ip_pool" name="ip_pool" />
					</tr>
					<tr>
						<th style="width:150px">IP WAN</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td id="td_ip_wan" name="td_ip_wan">&nbsp;</td><input type="hidden" id="ip_wan" name="ip_wan" />
					</tr>
					<tr>
						<th style="width:150px">Provider</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td id="td_kode_provider" name="td_kode_provider">&nbsp;</td><input type="hidden" id="kode_provider" name="kode_provider" />
					</tr>
					<tr>
						<th style="width:150px">Network Type</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td id="td_kode_jenis_jarkom" name="td_kode_jenis_jarkom">&nbsp;</td><input type="hidden" id="kode_jenis_jarkom" name="kode_jenis_jarkom" />
					</tr>
					<tr>
						<th style="width:150px">Interface To WAN</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td>
							<select name="interface_wan" id="interface_wan">
								<option selected="selected" value="">----</option>
							</select>
						</td>
					</tr>
					<tr>
						<th style="width:150px">Interface To LAN</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td id="kode_jenis_jarkom" name="kode_jenis_jarkom">
							<select name="interface_lan" id="interface_lan">
								<option value="0">ether1</option>
								<option value="1">ether2</option>
								<option value="2">ether3</option>
								<option value="3">ether4</option>
								<option value="4">ether5</option>
							</select>
						</td>
					</tr>
					<tr>
						<th style="width:150px">IP Tunnel 1</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td><input type="text" id="ip_tunnel_1" name="ip_tunnel_1" maxlength="15" />&nbsp;/&nbsp;30</td>
					</tr>
					<tr>
						<th style="width:150px">IP Tunnel 2</th>
						<td style="width:2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td><input type="text" id="ip_tunnel_2" name="ip_tunnel_2" maxlength="15" />&nbsp;/&nbsp;30</td>
					</tr>
					<tr>
						<td colspan="3"><input type="submit" class="btn btn-block btn-primary" style="width:120px;" value="Generate Script" id="generate"></th>						
					</tr>
				</table>
				</form>
			</div>			
        </div>       
		
		<div class="panel panel-default" style="width:49%;float: right;"> 
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><span id="ttl_right">Configuration Script</span></div>      
            <div class="panel-body" style="height:500px;">
				<form id="frm_saveconfig" action="<?php echo base_url();?>index.php/Configure/save_config" method="post">
					<textarea id="editor1" name="script" rows="100%" cols="100%" style="width:100%;height:430px;overflow:auto;" readonly>
					</textarea><br />
					<input type="hidden" name="id_jarkom_gen" id="id_jarkom_gen" value=""/>
					<input type="button" id="edit_config" class="btn btn-primary" style="width:150px;margin-top:10px;" value="Edit Configuration" onclick="editConfig();" />
					<input type="button" id="save_edit" class="btn btn-primary" style="width:175px;margin-top:10px;" value="Save Edited Configuration" onclick="saveEdited();" />
					<input type="submit" id="save_config" class="btn btn-primary" style="width:150px;margin-top:10px;" value="Save Configuration" />					
					<input type="button" id="ready_push"  class="btn btn-primary" style="width:150px;margin-top:10px;" value="Ready To Push" onclick="toPush();" />
				</form>
				
				<form id="frm_pushconfig" action="<?php echo base_url();?>index.php/Configure/push_config" method="post">
					<table class='table'>
						<tr>
							<th colspan="3"><img src="<?php echo base_url(); ?>assets/icon/mikrotik.png" /></th>
						</tr>
						<tr>
							<th style="width:150px">Username MikroTik</th>
							<td style="width:2px">:</td>
							<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
							<td><input type="text" placeholder="username..." name="username"></td>
						</tr>
						<tr>
							<th style="width:150px">Password MikroTik</th>
							<td style="width:2px">:</td>
							<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
							<td><input type="password"  placeholder="password..." name="password"></td>
						</tr>
						<tr>
							<th style="width:150px">IP Address</th>
							<td style="width:2px">:</td>
							<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
							<td><input type="text"  placeholder="ip address..." name="ip_address_push" id="ip_address_push"></td>
						</tr>
						<tr>
							<td colspan="3"><input type="submit" class="btn btn-block btn-primary" style="width:150px;" value="Push Configuration" /></td>
						</tr>		
					</table>
				</form>
			</div>
        </div>
    </div>
</section>
