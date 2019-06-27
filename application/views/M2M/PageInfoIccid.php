<div align="center">
	
	

	<h3 style='margin-top:30px'>DEVICE INFO</h3>
	
	<table class='table table-stripped' style='text-align:left;width:80%;'>

		<tr>
			<td style='width:20%'>ICCID</td>
				<td>:</td>
				<td>
					<?=$data["iccid"]?> 
					<button data='$iccid' class='btn btn-primary btn-xs btn_edit'>edit</button>
				</td>
				<td style='width:30px;'></td>
				<td style='width:20%'>APN</td>
				<td>:</td>
				<td><?=$data['apn']?></td>
				<!-- <td><?=$data["costumer"]?></td> -->
		</tr>

		<tr>
				<td>IMSI</td>
				<td>:</td>
				<td><?=$data["imsi"]?></td>
				<td></td>
				<td>END COSTUMER ID</td>
				<td>:</td>
				<td><?=$data["end_costumer_id"]?></td>
		</tr>

		<tr>
				<td>MSISDN</td>
				<td>:</td>
				<td><?=$data["msisdn"]?></td>
				<td></td>
				<td>DATE ACTIVATED</td>
				<td>:</td>
				<td><?=$data["date_activated"]?></td>
		</tr>

		<tr>
				<td>IMEI</td>
				<td>:</td>
				<td><?=$data["imei"]?></td>
				<td></td>
				<td>DATE ADDED</td>
				<td>:</td>
				<td><?=$data["date_added"]?></td>
		</tr>

		<tr>
				<td>STATUS</td>
				<td>:</td>
				<td><span id='status_simcard' data='hide' style='text-decoration:underline;cursor:pointer;'><?=$data["status"]?></span> </td>
				<td></td>
				<td>DATE UPDATED</td>
				<td>:</td>
				<td><?=$data["date_updated"]?></td>
		</tr>

		<!-- /* this column for edit or change status for iccid (this column is hidden) */ -->
		<tr class='row_change_status' style='display:none;'>
				<td class='row_change_status' style='display:none;'>CHANGE STATUS</td>
				<td class='row_change_status' style='display:none;'>:</td>
				<td class='row_change_status' style='display:none;' colspan=5'>
				<select id='change_status' class='form-control row_change_status' style='width:40%;float:left;display:none;'>
				<option value='ACTIVATED' >activated</option>
				<option value='DEACTIVATED'>deactivated</option>
				<option value='RETIRED'>retired</option>
				</select>
				&nbsp;<button id='btn_change_status' data="<?=$data['iccid']?>" class='btn btn-primary row_change_status' style='display:none;'>change</button>
				
				</td>
		</tr>
		<!-- /* end of column for edit or change status for iccid (this column is hidden) */ -->

		<tr>
				<td>RATE PLAN</td>
				<td>:</td>
				<td><?=$data['rate_plan']?></td>
				<td></td>
				<td>ACCOUNT ID</td>
				<td>:</td>
				<td><?=$data['account_id']?></td>
		</tr>

		<tr>
				<td>IP ADDRESS</td>
				<td>:</td>
				<td><?=$data['ip_address']?></td>
				<td></td>
				<td>COMMUNICATION PLAN</td>
				<td>:</td>
				<td><?=$data['communication_plan']?></td>
		</tr>
				

		<tr>
				<td>KONDISI SIMCARD</td>
				<td>:</td>
				<td><?=$data['kondisi_simcard']?></td>
				<td></td>
				<td>KODE REPLACEMENT</td>
				<td>:</td>
				<td><?=$data['kode_replacement']?></td>
		</tr>

		<tr>
				<td>
					ACCOUNT CUSTOM 1 <br>

					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][0]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom1']?></td>
				<td></td>
				<td>
					ACCOUNT CUSTOM 6 <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][5]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom6']?></td>
		</tr>

		<tr>
				<td>
					ACCOUNT CUSTOM 2 <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][1]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom2']?></td>
				<td></td>
				<td>
					ACCOUNT CUSTOM 7 <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][6]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom7']?></td>
		</tr>


		<tr>
				<td>
					ACCOUNT CUSTOM 3 <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][2]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom3']?></td>
				<td></td>
				<td>
					ACCOUNT CUSTOM 8 <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][7]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom8']?></td>
		</tr>

		<tr>
				<td>
					ACCOUNT CUSTOM 4 <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][3]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom4']?></td>
				<td></td>
				<td>
					ACCOUNT CUSTOM 9  <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][8]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom9']?></td>
		</tr>  	

		<tr>
				<td>
					ACCOUNT CUSTOM 5 <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][4]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom5']?></td>
				<td></td>
				<td>
					ACCOUNT CUSTOM 10 <br> 
					<span style="font-weight: bold;font-style: italic"> ( <?=$data["accountCustom"][9]?> ) </span>
				</td>
				<td>:</td>
				<td><?=$data['accountCustom10']?></td>

		</tr>

		<tr>
				<td>MODEM ID</td>
				<td>:</td>
				<td><?=$data['modem_id']?></td>
				<td></td>
				<td>USER CREATE</td>
				<td>:</td>
				<td><?=$data['user_create']?></td>
		</tr>

		<tr>
				<td>USER UPDATE</td>
				<td>:</td>
				<td><?=$data['user_update']?></td>
				<td></td>
				<td>CREATE AT</td>
				<td>:</td>
				<td><?=$data['create_at']?></td>
		</tr>

		<tr>
				<td>IN SESSION</td>
				<td>:</td>
				<td><?=$data['in_session']?></td>
				<td></td>
				<td>DATA USAGE</td>
				<td>:</td>
				<td> <?=$data['ctdDataUsage']?> Bytes </td>
		</tr>

		<tr>
				<td>ID REMOTE</td>
				<td>:</td>
				<td><?=$data['id_remote']?></td>
				<td></td>
				<td>DEVICE ID ( SPK )</td>
				<td>:</td>
				<td><?=$data['spk']?></td>
		</tr>

		<tr>
				<td>KODE UKER</td>
				<td>:</td>
				<td><?=$data['kode_uker']?></td>
				<td></td>
				<td>COSTUMER</td> 
				<td>:</td>
				<td><?=$data["costumer"]?></td>
				<!-- <td><?=$data['apn']?></td> -->
		</tr>

	</table>

				

	<button data='<?=json_encode($data)?>' class='btn btn-primary' id='btn_update_simcard' style='margin-bottom:50px;'><span class='glyphicon glyphicon-pencil'></span>&nbsp;update simcard</button>


</div>