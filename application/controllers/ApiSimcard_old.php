<?php

defined("BASEPATH") or exit ("note script allowes");

class ApiSimcard extends CI_Controller
{
	// public $username = "Ady21kurniawan";
	// public $apiKey = "5d7d639e-f51d-417d-86a4-529fb28be4ee";
	// public $data;

	public $username;
	public $apiKey;
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_apiSimcard");
		$this->load->library("Template");
		//$this->data ="Basic ".base64_encode( $this->username.":".$this->apiKey );
		//$this->load->model("M_ApiSimcard");
		$this->load->library("form_validation");
	}

	public function findSimcard($iccidNumber=null)
	{
		if($iccidNumber == null)
		{
			$iccid = $this->input->post("iccid");	
		}else{
			$iccid = $iccidNumber;
		}

		
		$qstr = "SELECT * from tb_simcard where iccid = ?";
		$data_bind=array($iccid);

		$process = $this->M_apiSimcard->getDataICCID($qstr,$data_bind);

		if($iccidNumber == null)
		{
			$output = array("data"=>$process);
			echo json_encode($output);	
		}else{

			return $process;
		}

		

	}

	public function UpdateDataDetailSimCard()
	{
		/*$data = array();
		foreach ($_POST as $key => $value) {
			array_push($data,$value);
		}*/

		//var_dump($_POST);

		$data=array();

		foreach ($_POST as $key => $value) {
			
			array_push($data,$value);
		}

		$process = $this->M_apiSimcard->UpdateDataSimCard($data);
		//echo $process;
		//var_dump($process);
		$output =array("data"=>$process);
		echo json_encode($output);

	}


	public function editStatusSimcard($iccid,$statusChange)
	{
		// echo "test";

		//$iccidNumber = $this->input->post("iccidNumber");
		//$statusChange = $this->input->post("statusChange");

		$url = "https://restapi7.jasper.com/rws/api/v1/devices/$iccid";
		$dataStatus=array(
			"status"=>"$statusChange"
		);

		$length = strlen(json_encode($dataStatus));

		$dataHeader = array(
			"Authorization:$this->data",
			"Content-Type:application/json",
			"Accept:application/json",
			"Content-Length:$length"
			
		);

		//echo json_encode($dataStatus);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_PROXY, "172.18.104.8:1707");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER,$dataHeader);
		curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($dataStatus));

		$result = curl_exec($ch);
		curl_close($ch);

		//var_dump($result);

		$dataResult = json_decode($result);

		if( array_key_exists("iccid",$dataResult) )
		{
			$status_response = true;

		}else{
			$status_response = false;
		}

		$output = array(
			"data"=>$status_response,
			"iccidNumber"=>$iccid,
			"statusChange"=>$statusChange
		);

		echo json_encode($output);

	}

	public function getDataSimcard(){
		$dataId=$this->input->post("dataId");
		$dataSimcard = $this->M_apiSimcard->checkingDataIccid(null,$dataId);
		//var_dump($dataId);

		$data=array();
		foreach ($dataSimcard as $key) 
		{
			$data['id'] = $key->id;
			$data['iccid'] = $key->iccid;
			$data['ip'] = $key->ip;
			$data['msisdn'] = $key->msisdn;
			$data['imsi'] = $key->imsi;
			$data['status'] = $key->status;
		}

		$output = array("data"=>$data);
		echo json_encode($output);	
	}

	public function changeDataSimcard()
	{
		$dataId=$this->input->post("id");
		$getData = $this->M_apiSimcard->checkingDataIccid(null,$dataId);

		$dataSimcard=array();
		foreach ($getData as $key) 
		{
			$dataSimcard['id'] = $key->id;
			$dataSimcard['iccid'] = $key->iccid;
			$dataSimcard['ip'] = $key->ip;
			$dataSimcard['msisdn'] = $key->msisdn;
			$dataSimcard['imsi'] = $key->imsi;
			//$dataSimcard['status'] = $key->status;
		}

		$this->db->trans_begin();

		//update or change status simcard from "active" to "onchange"
		$process_edit = $this->M_apiSimcard->changeStatusSimcard($dataSimcard['id'],"onchange");

		//backup data simcard on tb_inq_iccid
		$process_backup_data= $this->M_apiSimcard->backupDataSimcard($dataSimcard);



		if($this->db->trans_status()===FALSE)
		{
			$this->db->trans_rollback();
			echo false;

		}else{

			$this->db->trans_commit();
			echo true;
		}
		
	}

	
	public function getDataICCID()
	{
		//var_dump($this->input->post());

		$columns = array("NO","ICCID","IP","MSISDN","IMSI","STATUS","ACTION");
		$start = $this->input->post("start");
		$length = $this->input->post("length");
		$sorting = $this->input->post("order[0][dir]");
		$order = $this->input->post("order[0][column]");
		$search = $this->input->post("search[value]");


		
		switch ($order) {
			case 0:
				$order="tb_simcard.id";
				break;
			case 1:
				$order="tb_simcard.iccid";
				break;
			case 2:
				$order="tb_simcard.ip_address";
				break;
			case 3:
				$order="tb_simcard.msisdn";
				break;
			case 4:
				$order="tb_simcard.imsi";
				break;
			case 4:
				$order="tb_simcard.status";
				break;		

			
			default:
				$order="tb_simcard.id";
				break;
		}


		
		// $totalData = count($this->M_apiSimcard->getDataICCID());

		$queryCount="SELECT count(iccid) as total from tb_simcard ";
		$total_data_simcard = $this->M_apiSimcard->getDataICCID($queryCount,null);
		//var_dump($total_data_simcard);
		$totalData = $total_data_simcard[0]->total;


		
		if(empty($search))
		{
			//$qstr = "SELECT * from tb_iccid order by $order $sorting limit $start,$length";
			$qstr = "SELECT * from tb_simcard order by $order $sorting limit $start,$length";
		}else{
			// $qstr = "SELECT * from tb_iccid where iccid like '%$search%' or ip like '%$search%' or msisdn like '%$search%' or imsi like '%$search%' order by $order $sorting limit $start,$length";
			$qstr = "SELECT * from tb_simcard where iccid like '%$search%' or ip_address like '%$search%' or msisdn like '%$search%' or imsi like '%$search%' or status_simcard like '%$search%' order by $order $sorting limit $start,$length";
		}

		

		$process = $this->M_apiSimcard->getDataICCID($qstr);

		$dataIccid = array();
		$no=1;
		foreach ($process as $key) 
		{

			if($key->status_simcard=='Activated')
			{
				$button = "<button class='btn btn-danger btn-xs btn_change_status' data='$key->id'>CHANGE</button>";	
			}else{
				$button = "<button class='btn btn-primary btn-xs btn_update_data' data='$key->id'>UPDATE</button>";
			}
			
			
			$data = array(
				"NO"=>$no,
				"ICCID"=>$key->iccid,
				"IP"=>$key->ip_address,
				"MSISDN"=>$key->msisdn,
				"IMSI"=>$key->imsi,
				"STATUS"=>$key->status_simcard,
				"ACTION"=>$button
			);

			array_push($dataIccid, $data);
			$no++;
		}

		$dataOutput = array(
			"draw"=>intval($this->input->post("draw")),
			"recordsTotal"=>intval($totalData),
			"recordsFiltered"=>intval($totalData),
			"data"=>$dataIccid
		);

		echo json_encode($dataOutput);



	}	

	public function masterIccidNumber()
	{
		$data = array(
			"page"=>"Master ICCID Number",
			"title"=>"Master ICCID Number"
		); 
		$this->template->views("M2M/masterIccidNumber",$data);
	}

	public function findIccid()
	{
		$data = $this->input->post("search");
		// $qstr = "SELECT iccid from tb_simcard where iccid like '%$data'";
		$qstr = "SELECT iccid , msisdn from tb_simcard where iccid like '%$data' or msisdn like '%$data' ";
		$process = $this->M_apiSimcard->getDataICCID($qstr);

		$dataIccid = array();

		foreach ($process as $key ) {
			
			$iccidNumber = array(
				"id" => $key->iccid,
				//"text" => $key->iccid
				"text" => $key->iccid." ( $key->msisdn) "
			);

			array_push($dataIccid,$iccidNumber);

		}

		echo json_encode($dataIccid);
	}

	public function searchDeviceUI()
	{
		//$this->template->views("M2M/searchDeviceUI",null);
		$data['page'] = 'Search Device';
        $data['title'] = 'Search Device';
        $this->template->views('M2M/searchDeviceUI',$data);
	}

	public function cekDataIccidOnLocalDatabase($dataIccid)
	{
		$totalData = count( $this->M_apiSimcard->checkingDataIccid($dataIccid,null) );
		return $totalData;
	}


	public function findAccess($mode){

		$iccid =trim($this->input->post('iccid'));
		$findAccess = $this->M_apiSimcard->getAccess($iccid);
		
		$data = count($findAccess);

		//var_dump($findAccess);

		if($data != 0)
		{
			$this->username = $findAccess[0]->username;
			$this->apiKey=$findAccess[0]->key;
			$this->data ="Basic ".base64_encode( $this->username.":".$this->apiKey );

			switch ($mode)
			{
				case "get_device_info":
					$this->getDeviceInfo($iccid);
				break;
				case "edit_status_simcard":

					$statusChange = $this->input->post("statusChange");
					$this->editStatusSimcard($iccid,$statusChange);
				break;

				default:
					$output = array("data"=>"mode not found !!");
					echo json_encode($output);
				break;		
			}
			
			

		}else{

			$output = array("data"=>"api key not found !!");
			echo json_encode($output);
		}	
	}


	public function getDeviceInfo($iccidNumber=null)
	{
		//list iccid ="8962101012742826866,8962101012742820044,8962101012742827526";

		if($iccidNumber == null)
		{
			$iccid =trim($this->input->post('iccid'));	
		}else{
			$iccid =$iccidNumber;
		}
		
		$url="https://restapi7.jasper.com/rws/api/v1/devices/".$iccid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_PROXY, "172.18.104.8:1707");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization:".$this->data,"Accept: application/json"));
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
		$results = curl_exec($ch);
		curl_close($ch);

		$dataResults = json_decode($results);

		


		$dataInfo = $this->findSimcard($iccid);

		if( array_key_exists("errorMessage",$dataResults) )
		{
			$output="<span>data tidak ditemukan</span>";
		
		}else
			{

				// if iccid exist in telkomsel database and have no saved in database local THEN insert iccid to database local

				/*$check = $this->cekDataIccidOnLocalDatabase($iccid);

				if($check == 0)
				{
					$param=array(

						"iccid"=>$dataResults->iccid,
						"ip"=>$dataResults->fixedIPAddress,
						"msisdn"=>$dataResults->msisdn,
						"imsi"=>$dataResults->imsi

					);

					$saveData = $this->M_apiSimcard->insertDataIccid($param);	
				}*/
				

				//data info iccid
				$buttonEdit ="<button data='$dataResults->iccid' class='btn btn-primary btn-xs btn_edit'>edit</button>";

				$output  ="<h3 style='margin-top:30px'>DEVICE INFO</h3>";
				$output .= "<table class='table table-stripped' style='text-align:left;width:100%;'>";

				$output .= "<tr>";
				$output .= "<td style='width:15%'>ICCID</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->iccid $buttonEdit </td>";
				$output .="<td style='width:30px;'></td>";
				$output .= "<td style='width:15%'>COSTUMER</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->customer</td>";
				$output .= "</tr>";

				$output .= "<tr>";
				$output .= "<td>IMSI</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->imsi</td>";
				$output .="<td></td>";
				$output .= "<td>END COSTUMER ID</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->endConsumerId</td>";
				$output .= "</tr>";

				$output .= "<tr>";
				$output .= "<td>MSISDN</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->msisdn</td>";
				$output .="<td></td>";
				$output .= "<td>DATE ACTIVATED</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->dateActivated</td>";
				$output .= "</tr>";

				$output .= "<tr>";
				$output .= "<td>IMEI</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->imei</td>";
				$output .="<td></td>";
				$output .= "<td>DATE ADDED</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->dateAdded</td>";
				$output .= "</tr>";

				$output .= "<tr>";
				$output .= "<td>STATUS</td>";
				$output .= "<td>:</td>";
				$output .= "<td><span id='status' data='hide' style='text-decoration:underline;cursor:pointer;'>$dataResults->status </span> </td>";
				$output .="<td></td>";
				$output .= "<td>DATE UPDATED</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->dateUpdated</td>";
				$output .= "</tr>";

				/* this column for edit or change status for iccid (this column is hidden) */
				$output .= "<tr class='row_change_status' style='display:none;'>";
				$output .= "<td class='row_change_status' style='display:none;'>CHANGE STATUS</td>";
				$output .= "<td class='row_change_status' style='display:none;'>:</td>";
				$output .= "<td class='row_change_status' style='display:none;' colspan=5'>";
				$output .= "<select id='change_status' class='form-control row_change_status' style='width:40%;float:left;display:none;'>";
				$output .= "<option value='ACTIVATED' >activated</option>";
				$output .= "<option value='DEACTIVATED'>deactivated</option>";
				//$output .= "<option value='ACTIVATION READY'>activation ready</option>";
				//$output .= "<option value='INVENTORY'>inventory</option>";
				$output .= "<option value='RETIRED'>retired</option>";
				$output .= "</select>";
				$output .= "&nbsp;<button id='btn_change_status' data='$dataResults->iccid' class='btn btn-primary row_change_status' style='display:none;'>change</button>";
				//$output .= "&nbsp;<button class='btn btn-danger btn-md btn_cancel row_change_status' style='display:none;'>cancel</button>";
				$output .= "</td>";
				$output .= "</tr>";
				/* end of column for edit or change status for iccid (this column is hidden) */

				$output .= "<tr>";
				$output .= "<td>RATE PLAN</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->ratePlan</td>";
				$output .="<td></td>";
				$output .= "<td>ACCOUNT ID</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->accountId</td>";
				$output .= "</tr>";

				$output .= "<tr>";
				$output .= "<td>IP ADDRESS</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->fixedIPAddress</td>";
				$output .="<td></td>";
				$output .= "<td>COMMUNICATION PLAN</td>";
				$output .= "<td>:</td>";
				$output .= "<td>$dataResults->communicationPlan</td>";
				$output .="</tr>";
				


				// secondary info

				$output .="<tr>";
				$output .="<td>KONDISI SIMCARD</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->kondisi_simcard."</td>";
				$output .="<td></td>";
				$output .="<td>KODE REPLACEMENT</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->kode_replacement."</td>";
				$output .="</tr>";

				$output .="<tr>";
				$output .="<td>TID</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->tid."</td>";
				$output .="<td></td>";
				$output .="<td>KODE UKER</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->kode_uker."</td>";
				$output .="</tr>";

				$output .="<tr>";
				$output .="<td>PIC</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->pic."</td>";
				$output .="<td></td>";
				$output .="<td>ID REMOTE</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->id_remote."</td>";
				$output .="</tr>";  	

				$output .="<tr>";
				$output .="<td>KOTA</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->kota."</td>";
				$output .="<td></td>";
				$output .="<td>SN</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->sn."</td>";
				$output .="</tr>";

				$output .="<tr>";
				$output .="<td>MODEM ID</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->modem_id."</td>";
				$output .="<td></td>";
				$output .="<td>USER CREATE</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->user_create."</td>";
				$output .="</tr>";

				$output .="<tr>";
				$output .="<td>USER UPDATE</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->user_update."</td>";
				$output .="<td></td>";
				$output .="<td>CREATE AT</td>";
				$output .="<td>:</td>";
				$output .="<td>".$dataInfo[0]->create_at."</td>";
				$output .="</tr>";

				$output .= "</table>";


				//$output.="accountCustom1 :".$dataResults->accountCustom1."<br>";
				//$output.="accountCustom2 :".$dataResults->accountCustom2."<br>";
				

			}
		

		$data = array("data"=>$output);

		echo json_encode($data);
		//var_dump($dataInfo);

			

		
	}
}

?>