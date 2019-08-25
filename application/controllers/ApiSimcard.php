<?php

defined("BASEPATH") or exit ("note script allowes");

class ApiSimcard extends CI_Controller
{
	
	public $username;
	public $apiKey;
	public $apn;
	public $data;
	public $pathFile;

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_apiSimcard");
		$this->load->library("Template");
		$this->load->library("form_validation");
	}

	public function updateDataICCID($data=null)
	{

		//var_dump($_POST);
		
		/*
			// format data to access api

			{
			   "effectiveDate": "2016-04-18+05:00",
			  "ratePlan": "IoT Individual Shared 10 MB Retro-BRIEDC",
			  "overageLimitOverride": "DEFAULT", 
			   "deviceID": "Part Of 186610",
			  "status": "ACTIVATED",
			  "modemID": "",
			  "accountCustom1": "SEMARANG", //kanwil
			  "accountCustom2": "",			//tid
			  "accountCustom3": "",			//nama merchant	
			  "accountCustom4": "",			//provinsi
			  "accountCustom5": "",			//kota
			  "accountCustom6": "",			//nama pic
			  "accountCustom7": "",			//no pic
			  "accountCustom8": "",			//sn
			  "accountCustom9": "",			//pemasang
			  "accountCustom10": ""

			  
			}

		*/
	
		$iccid 	= $this->input->post("iccid");

		$url = "https://restapi7.jasper.com/rws/api/v1/devices/$iccid";

		$effectiveDate = $this->input->post("effectiveDate");
		$ratePlan = $this->input->post("ratePlan");
		$overageLimitOverride = $this->input->post("overageLimitOverride");
		$status = $this->input->post("status");

		$deviceID			=$this->input->post("deviceID");
		$modemID			=$this->input->post("modemID");
		$accountCustom1		=$this->input->post("accountCustom1"); 
		$accountCustom2		=$this->input->post("accountCustom2");			
		$accountCustom3		=$this->input->post("accountCustom3");
		$accountCustom4		=$this->input->post("accountCustom4");
		$accountCustom5		=$this->input->post("accountCustom5");
		$accountCustom6		=$this->input->post("accountCustom6");
		$accountCustom7		=$this->input->post("accountCustom7");
		$accountCustom8		=$this->input->post("accountCustom8");
		$accountCustom9		=$this->input->post("accountCustom9");
		$accountCustom10	=$this->input->post("accountCustom10");

		
		if( strtoupper($deviceID) != strtoupper("unchanged") && strtoupper($deviceID) != strtoupper("unchange")  )
		{
			$dataUpdate["deviceID"] = $deviceID;
		}

		if( strtoupper($modemID) != strtoupper("unchanged") && strtoupper($modemID) != strtoupper("unchange") )
		{
			$dataUpdate["modemID"] = $modemID;
		}

		if( strtoupper($accountCustom1) != strtoupper("unchanged") && strtoupper($accountCustom1) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom1"] = $accountCustom1;
		}

		if( strtoupper($accountCustom2) != strtoupper("unchanged") && strtoupper($accountCustom2) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom2"] = $accountCustom2;
		}

		if( strtoupper($accountCustom3) != strtoupper("unchanged") && strtoupper($accountCustom3) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom3"] = $accountCustom3;
		}

		if( strtoupper($accountCustom4) != strtoupper("unchanged") && strtoupper($accountCustom4) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom4"] = $accountCustom4;
		}

		if(  strtoupper($accountCustom5) != strtoupper("unchanged") && strtoupper($accountCustom5) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom5"] = $accountCustom5;
		}

		if( strtoupper($accountCustom6) != strtoupper("unchanged") && strtoupper($accountCustom6) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom6"] = $accountCustom6;
		}

		if( strtoupper($accountCustom7) != strtoupper("unchanged") && strtoupper($accountCustom7) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom7"] = $accountCustom7;
		}

		if( strtoupper($accountCustom8) != strtoupper("unchanged") && strtoupper($accountCustom8) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom8"] = $accountCustom8;
		}

		if( strtoupper($accountCustom9) != strtoupper("unchanged") && strtoupper($accountCustom9) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom9"] = $accountCustom9;
		}

		if( strtoupper($accountCustom10) != strtoupper("unchanged") && strtoupper($accountCustom10) != strtoupper("unchange") )
		{
			$dataUpdate["accountCustom10"] = $accountCustom10;
		}

		

		if( $ratePlan != "" || $ratePlan != null  )
		{
			$dataUpdate["ratePlan"] = $ratePlan;
		}

		if( $overageLimitOverride != "" || $overageLimitOverride != null  )
		{
			$dataUpdate["overageLimitOverride"] = $overageLimitOverride;
		}


		if( $status != "" || $status != null  )
		{
			$dataUpdate["status"] = $status;
		}

		

		if( $effectiveDate != "" || $effectiveDate != null  )
		{
			$dataUpdate["effectiveDate"] = $effectiveDate;
		}

		$length = strlen(json_encode($dataUpdate));

		$dataHeader = array(
			"Authorization:$this->data",
			"Content-Type:application/json",
			"Accept:application/json",
			"Content-Length:$length"
			
		);


		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_PROXY, "172.18.104.8:1707");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER,$dataHeader);
		curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($dataUpdate));

		$result = curl_exec($ch);
		curl_close($ch);

		

		$dataResult = json_decode($result);

		//var_dump($dataUpdate);

		if($result==false)
		{
			$status_response=false;
			$error_message = "check your internet connection";

		}elseif( array_key_exists("iccid",$dataResult) )
		{
			$status_response = true;
			$error_message = "";

		}else{
			$status_response = false;
			$error_message = "failed to request (  $dataResult->errorCode - $dataResult->errorMessage ) ";;
			
		}

		$output = array(
			"data"=>$status_response,
			"errorMessage"=>$error_message,
			"iccidNumber"=>$iccid,
			"data_update"=>$overageLimitOverride
			
		);

		echo json_encode($output);

	}





	public function process_batch_update()
	{
		//var_dump($_FILES);
		$filename = $_FILES['excel_files']['name'];
		$find_extention = explode(".", trim($filename));

		

		if( count($find_extention)==1 )
		{
			$extention = "your file have no extention";
		}else{
			$index = count($find_extention) -1;
			$extention = $find_extention[$index];
		}


		$data_batch=array();

		if($extention =="csv")
		{
			$open_file = file_get_contents($_FILES['excel_files']['tmp_name']);
			$line = explode("\n", $open_file);
			$lines_total = count( $line ) -1;

			

			for ($i=1; $i < $lines_total ; $i++) { 
				
				//jika excel menggunakan settingan inggris / amerika
				$data_column = explode(",",$line[$i]);

				if( count($data_column) == 1)
				{
					//jika excel menggunakan settingan inggris / amerika
					$data_column = explode(";",$line[$i]);
				}

				//echo count($data_column);
				
				 $data['status'] 			= strtoupper( trim( str_replace(array('"'," ","'","\n"), "", $data_column[1]) ) );
				 $data['deviceID'] 			= trim( str_replace(array('"',"'","\n"), "", $data_column[2]) );
				 $data['modemID'] 			= trim( str_replace(array('"',"'","\n"), "", $data_column[3]) );
				 $data['accountCustom1'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[4]) );
				 $data['accountCustom2'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[5]) );
				 $data['accountCustom3'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[6]) );
				 $data['accountCustom4'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[7]) );
				 $data['accountCustom5'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[8]) );
				 $data['accountCustom6'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[9]) );
				 $data['accountCustom7'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[10]) );
				 $data['accountCustom8'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[11]) );
				 $data['accountCustom9'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[12]) );
				 $data['accountCustom10'] 	= trim( str_replace(array('"',"'","\n"), "", $data_column[13]) );

				 $overageLimitOverride = trim( str_replace(array('"',"'","\n"), "", $data_column[14]) );	
				 $data['ratePlan'] = trim( str_replace(array('"',"'","\n"), "", $data_column[15]) ) ;

				 

				 switch (strtoupper($overageLimitOverride)) {
				 	case 'NONE':				 		
				 		$data['overageLimitOverride']="DEFAULT";
				 		break;

				 	case 'CURENT CYCLE':
				 		$data['overageLimitOverride']="TEMPORARY_OVERRIDE";
				 		break;
				 		
				 	case 'ONGOING':
				 		$data['overageLimitOverride']="PERMANENT_OVERRIDE";
				 		break;		
				 	
				 	default:
				 		//$data['overageLimitOverride']="DEFAULT";
				 		$data['overageLimitOverride']="";
				 		break;
				 }

				
				$data['iccid'] 			= trim( preg_replace('/[^\x{20}-\x{7F}]/','', $data_column[0]) ) ;

				if($data['iccid'] !="")
				{
					array_push($data_batch, $data);	
				}	

				 


				
				
			}

			//var_dump($data_batch);


			$error=false;
			$errorMessage="";

		}else{

			$error=true;
			$errorMessage="only csv extention file";

		}

		
		
		$output = array(
			"data"=>$data_batch,
			//"data_error"=>$data['iccid'],
			"error"=>$error,
			"errorMessage"=>$errorMessage
		);

		
		echo json_encode($output);

		
		

		

	
		
	}		

	
	public function findAccess($mode,$data_iccid=null,$data_statusChange=null){



		if($data_iccid==null)
		{
			$iccid =trim($this->input->post('iccid'));	
		}else{
			$iccid = $data_iccid;
		}
		
		$findAccess = $this->M_apiSimcard->getAccess($iccid);
		
		$data = count($findAccess);

		//var_dump($findAccess);
		
		if($data != 0)
		{
			$this->username = $findAccess[0]->username;
			$this->apiKey=$findAccess[0]->key;
			$this->apn=$findAccess[0]->apn;
			$this->data ="Basic ".base64_encode( $this->username.":".$this->apiKey );

			switch ($mode)
			{
				

				case "update_data_batch":
					$this->updateDataICCID($_POST);
				break;


				case "get_device_info":
					$this->getDeviceInfo($iccid , $this->apn);
				break;

				case "edit_status_simcard":

					if($data_statusChange==null){
						$statusChange = $this->input->post("statusChange");	
					}else{
						$statusChange=$data_statusChange;
					}
					
					$this->editStatusSimcard($iccid,strtoupper($statusChange));
				break;

				case "updateDataICCID":

					$this->updateDataICCID($_POST);
				break;

				//updateDataICCID

				default:
					$output = array("data"=>"mode not found !!");
					echo json_encode($output);
				break;		
			}
			
			

		}else{

			$output = array(
				"data"=>"api key not found !!",
				"iccidNumber"=>$iccid
			);
			echo json_encode($output);


		}	
	}


	public function editStatusSimcard($iccid,$statusChange)
	{


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

		

		$dataResult = json_decode($result);

		//var_dump($result);

		if($result==false)
		{
			$status_response=false;
			$error_message = "check your internet connection";

		}elseif( array_key_exists("iccid",$dataResult) )
		{
			$status_response = true;
			$error_message = "";

		}else{
			$status_response = false;
			$error_message = "check your internet connection";
		}

		$output = array(
			"data"=>$status_response,
			"errorMessage"=>$error_message,
			"iccidNumber"=>$iccid,
			"statusChange"=>$statusChange
		);

		echo json_encode($output);

	}	

	
	public function UpdateDataDetailSimCard()
	{
		$data=array();
		foreach ($_POST as $key => $value) {			
			array_push($data,$value);
		}

		//var_dump($data);

		$process = $this->M_apiSimcard->UpdateDataSimCard($data,"search_device_ui");
		$output =array("data"=>$process);
		echo json_encode($output);

	}	


	public function showBatchUpdate()
	{
		//var_dump($this->input->post());
		$columns = array("filename","total_records","success","failed");

		$qstr1 = "SELECT count(filename) as total_data from tb_excel_batch ";

		$process_count = $this->M_apiSimcard->count_data($qstr1);
		$jumlah_data = $process_count[0]->total_data;
		//var_dump($jumlah_data);

		$start = $this->input->post("start");
		$length = $this->input->post("length");

		$order = $this->input->post("order[0][column]");

		switch($order)
		{
			case 0 : $orderBy="tb_excel_batch.id";break;
			case 1 : $orderBy="tb_excel_batch.total_records";break;
			case 2 : $orderBy="tb_excel_batch.success";break;
			case 3 : $orderBy="tb_excel_batch.failed";break;
			default: $orderBy="tb_event.filename";break;
		}

			
		//$orderBy = "tb_event.id_event";
		$sort = $this->input->post("order[0][dir]");
		//$sort = "DESC";
		$cari = $this->input->post("search[value]");

		if(empty($cari))
		{
			
			$qstr2="SELECT tb_excel_batch.id,tb_excel_batch.filename,tb_excel_batch.total_records,tb_excel_batch.success,tb_excel_batch.failed,tb_excel_batch.link_file from tb_excel_batch  order by $orderBy $sort  limit $start,$length";
		
		}else{
			
			$qstr2="SELECT tb_excel_batch.id,tb_excel_batch.filename,tb_excel_batch.total_records,tb_excel_batch.success,tb_excel_batch.failed,tb_excel_batch.link_file from tb_excel_batch where tb_excel_batch.filename like '%$cari%' ";				
		}	
		

		
		$proses_data=$this->M_apiSimcard->getDataFileBatch($qstr2);

	
		$data = array();
		foreach ($proses_data as $key) 
		{

		
			
			$batch_data = array(
				//"no"=>$no,
				"filename"=>$key->filename,
				"total_records"=>$key->total_records,
				"success"=>$key->success,
				"failed"=>$key->failed
				//"link_file"=>$key->link_file,
			
			);

			

			//$no++;
			array_push($data,$batch_data);
		}



		$output = array(

			"draw"				=>$this->input->post('draw'),
			"recordsTotal"		=>$jumlah_data,
			"recordsFiltered"	=>$jumlah_data,		
			"data"				=>$data
		);

		

		echo json_encode($output);
	}


	public  function process_batch_upload()
	{
		//var_dump($_POST);
		//var_dump($_FILES);

		$file = $_FILES['excel_files']['name'];
		$extfile = explode(".", $file);
		$extindex = count($extfile) -1;

		$filename ="";
		for ($i=0; $i <$extindex ; $i++) {

			if( $extindex - $i == 1){
				$filename .= $extfile[$i];
			}else{
				$filename .= $extfile[$i].".";
			}
			
		}

		$tempfile = $_FILES['excel_files']['tmp_name'];
		$new_filename = $filename."_".date('d-m-Y')."_".rand(0,999).".".$extfile[$extindex];

		$pathUpload = FCPATH."filesUpload/batchFiles/";
		$process_upload = move_uploaded_file($tempfile,$pathUpload.$new_filename);

		$status = 0;
		$process_insert_database = 0;

		if($process_upload == 1)
		{
			$status ++;
			$param=array(
				"id"=>null,
				"filename"=>$new_filename,
				"total_records"=>$this->input->post("total_data"),
				"success"=>$this->input->post("total_success"),
				"failed"=>$this->input->post("total_failed"),
				"link_file"=>$pathUpload.$new_filename
			);
			$process_insert_database = $this->M_apiSimcard->insert_data_batch_excel($param);
			
		}

		if($process_insert_database == 1)
		{
			$status ++;
		}else{

			// jika gagal update tabel maka hapus file upload
			$delete_file = unlink($pathUpload.$new_filename);
		}

		$output = array("data"=>$status);
		echo json_encode($output);


		
	}


	





	public function process_batch_update_old()
	{
		//var_dump($_FILES);
		$filename = $_FILES['excel_files']['name'];
		$find_extention = explode(".", trim($filename));

		if( count($find_extention)==1 )
		{
			$extention = "your file have no extention";
		}else{
			$index = count($find_extention) -1;
			$extention = $find_extention[$index];
		}


		$data_batch=array();

		if($extention =="csv")
		{
			$open_file = file_get_contents($filename);
			$line = explode("\n", $open_file);
			$lines_total = count( $line ) -1;

			//$data_batch=array();

			for ($i=1; $i < $lines_total ; $i++) { 
				
				$data_column = explode(";",$line[$i]);
				
				 $data_iccid = trim( str_replace(array('"'," ","'","\n"), "", $data_column[0]) );
				 $data_status = trim( str_replace(array('"'," ","'","\n"), "", $data_column[1]) );

				 $data['iccid'] = $data_iccid;
				 $data['status'] = $data_status;

				 array_push($data_batch, $data);

				//$this->findAccess("edit_status_simcard",$data_iccid,strtoupper($data_status)); 

				
			}

			$error=false;
			$errorMessage="";

		}else{

			$error=true;
			$errorMessage="only csv extention file";

		}


		$output = array(
			"data"=>$data_batch,
			"error"=>$error,
			"errorMessage"=>$errorMessage
		);

		echo json_encode($output);	
	}	

	

	public function batchUpdate()
	{
		$data = array(
			"page"=>"batch update",
			"title"=>"batch update"
		); 
		$this->template->views("M2M/batchUpdate",$data);
	}

	

	public function changeDataMasterSimcard()
	{
		
		$user_update = $this->session->userdata("username");
		$time_update=date("Y-m-d H:i:s");
		
		$param = array();
		foreach ($_POST as $key => $value) {
			$param[$key] = $value;
		}

		unset($param['id']); // hapus data id agar array berurutan saat dikirim ke model
		$param['user_update']=$user_update;
		$param['update_at']=$time_update;
		$param['id']=$_POST['id'];

		// var_dump($param);

		$process = $this->M_apiSimcard->UpdateDataSimCard($param,"master_iccid_number");
		
		$output =array("data"=>$process);
		echo json_encode($output);

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

	


	

	public function getDataSimcard(){
		$dataId=$this->input->post("dataId");
		$dataSimcard = $this->M_apiSimcard->checkingDataIccid(null,$dataId);

		$data=array();
		foreach ($dataSimcard as $key) 
		{
			$data['id'] = $key->id;
			$data['iccid'] = $key->iccid;
			$data['ip'] = $key->ip_address;
			$data['msisdn'] = $key->msisdn;
			$data['imsi'] = $key->imsi;
			$data['status'] = $key->status_simcard;
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
			$dataSimcard['kode_replacement'] = "";
			$dataSimcard['id_simcard'] = $key->id;
			$dataSimcard['user_create'] =  $this->session->userdata("username");
			$dataSimcard['create_at'] =  date("Y:m:d h:i:s");		
		}

		$this->db->trans_begin();

		//update or change status simcard from "active" to "onchange"
		$process_edit = $this->M_apiSimcard->changeStatusSimcard($dataSimcard,"onchange");

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
		$columns = array("NO","ICCID","IP","MSISDN","IMSI","STATUS","APN","ACTION");
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
				$order="tb_simcard.status_simcard";
				break;		

			
			default:
				$order="tb_simcard.id";
				break;
		}

		
		$sql_total = "SELECT count(id) as total from tb_simcard";
		$total = $this->M_apiSimcard->getDataICCID($sql_total);
		$totalData = $total[0]->total;

		if(empty($search))
		{
			$qstr = "SELECT * from tb_simcard order by $order $sorting limit $start,$length";
		}else{
	
			$qstr = "SELECT * from tb_simcard where iccid like '%$search%' or ip_address like '%$search%' or msisdn like '%$search%' or imsi like '%$search%' or status_simcard like '%$search%' or apn like '%$search%' order by $order $sorting limit $start,$length";
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
				"APN"=>$key->apn,
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
		$qstr = "SELECT iccid , msisdn ,ip_address from tb_simcard where iccid like '%$data%' or msisdn like '%$data%' or ip_address like '%$data%'";

		//var_dump($qstr);
		$process = $this->M_apiSimcard->getDataICCID($qstr);

		$dataIccid = array();

		foreach ($process as $key ) {
			
			$iccidNumber = array(
				"id" => $key->iccid,
				"text" => $key->iccid." ($key->msisdn - $key->ip_address) "
			);

			array_push($dataIccid,$iccidNumber);

		}

		echo json_encode($dataIccid);
	}

	public function searchDeviceUI()
	{
		$data['page'] = 'Search Device';
        $data['title'] = 'Search Device';
        $this->template->views('M2M/searchDeviceUI',$data);
	}

	public function cekDataIccidOnLocalDatabase($dataIccid)
	{
		$totalData = count( $this->M_apiSimcard->checkingDataIccid($dataIccid,null) );
		return $totalData;
	}





	public function getDeviceInfo($iccidNumber=null , $apn=null )
	{
		//list iccid ="8962101012742826866,8962101012742820044,8962101012742827526";

		if($iccidNumber == null)
		{
			$iccid =trim($this->input->post('iccid'));	
		}else{
			$iccid =$iccidNumber;
		}

		// get info device
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

		//var_dump($results);

		

		//get session details simcard
		$url_session_details="https://restapi7.jasper.com/rws/api/v1/devices/$iccid/sessionInfo";
		$ch_session_details = curl_init();
		curl_setopt($ch_session_details, CURLOPT_URL, $url_session_details);
		curl_setopt($ch_session_details, CURLOPT_PROXY, "172.18.104.8:1707");
		curl_setopt($ch_session_details, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch_session_details, CURLOPT_HTTPHEADER, array("Authorization:".$this->data,"Accept: application/json"));
		curl_setopt($ch_session_details, CURLOPT_HEADER, FALSE);
		curl_setopt($ch_session_details, CURLOPT_TIMEOUT, 1000);

		$results_session_details = curl_exec($ch_session_details);
		curl_close($ch_session_details);


		//get data usage simcard
		$url_data_usage="https://restapi7.jasper.com/rws/api/v1/devices/$iccid/ctdUsages";
		$ch_data_usage = curl_init();
		curl_setopt($ch_data_usage, CURLOPT_URL, $url_data_usage);
		curl_setopt($ch_data_usage, CURLOPT_PROXY, "172.18.104.8:1707");
		curl_setopt($ch_data_usage, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch_data_usage, CURLOPT_HTTPHEADER, array("Authorization:".$this->data,"Accept: application/json"));
		curl_setopt($ch_data_usage, CURLOPT_HEADER, FALSE);
		curl_setopt($ch_data_usage, CURLOPT_TIMEOUT, 1000);

		$results_data_usage = curl_exec($ch_data_usage);
		curl_close($ch_data_usage);
		//var_dump($results_data_usage) ;

		

		


		$dataResults = json_decode($results); // data device info simcard from jasper
		$dataInfo = $this->findSimcard($iccid); // data simcard from local db
		$data_session_details = json_decode($results_session_details); // data session simcard from jasper
		$data_usage_simcard = json_decode($results_data_usage); // data usage simcard from jasper

		 if( array_key_exists("errorMessage",$dataResults) )
		 {
		 	$output="<span>data tidak ditemukan</span>";
		
		 }else
		 	{
		 		$data_output=array(

					"iccid"					=>$dataResults->iccid,
					"apn"					=>$apn,
					"costumer"				=>$dataResults->customer,
					"imsi" 					=>$dataResults->imsi,
					"end_costumer_id"		=>$dataResults->endConsumerId,
					"msisdn"				=>$dataResults->msisdn,
					"date_activated"		=>$dataResults->dateActivated,
					"imei"					=>$dataResults->imei,
					"date_added"			=>$dataResults->dateAdded,
					"status"				=>$dataResults->status,
					"date_updated"			=>$dataResults->dateUpdated,
					"rate_plan"				=>$dataResults->ratePlan,
					"account_id"			=>$dataResults->accountId,
					"ip_address"			=>$dataResults->fixedIPAddress,
					"communication_plan"	=>$dataResults->communicationPlan,
					"spk"					=>$dataResults->deviceID,
					"modem_id"				=>$dataResults->modemID,
					"overage_limit_override"=>$data_usage_simcard->overageLimitOverride,
					"kondisi_simcard"		=>$dataInfo[0]->kondisi_simcard,
					"kode_replacement"		=>$dataInfo[0]->kode_replacement,
					"kode_uker"				=>$dataInfo[0]->kode_uker,
					"id_remote"				=>$dataInfo[0]->id_remote,
					"user_create"			=>$dataInfo[0]->user_create,
					"user_update"			=>$dataInfo[0]->user_update,
					"create_at"				=>$dataInfo[0]->create_at,
					"ctdDataUsage"			=>number_format($data_usage_simcard->ctdDataUsage)


				);

				if($data_session_details->dateSessionEnded == null)
				{
					$data_output['in_session'] = "Yes";
				}else{
					$data_output['in_session'] = "No";
				}


				if( strtoupper($apn) == "M2MEDCBRI")
				{
					//set label account custom based data mapping in jasper 
					$data_output["accountCustom"] = array("kanwil","tid","nama merchant","provinsi","kota","pic","no pic","sn","pemasang","unset");					
					
				}

				if( strtoupper($apn) == "M2MATMBRI")
				{
					//set label account custom based data mapping in jasper 
					$data_output["accountCustom"] = array("kanwil","ip pool","lokasi","ip lan","nama pic","no hp pic","tid","remote address","type","spk number");					
					
				}

				if( strtoupper($apn) == "M2MPRSBRI")
				{
					//set label account custom based data mapping in jasper 
					$data_output["accountCustom"] = array("kanwil","ip pool","nama lokasi","type","nama pic","kontak pic","ip lan","remote address","unset","unset");					
					
				}



				$data_output["accountCustom1"] 	= $dataResults->accountCustom1; // $data_output["accountCustom"][0]
				$data_output["accountCustom2"]	= $dataResults->accountCustom2; // $data_output["accountCustom"][1]
				$data_output["accountCustom3"]	= $dataResults->accountCustom3; // $data_output["accountCustom"][2]
				$data_output["accountCustom4"] 	= $dataResults->accountCustom4; // $data_output["accountCustom"][3]
				$data_output["accountCustom5"] 	= $dataResults->accountCustom5; // $data_output["accountCustom"][4]
				$data_output["accountCustom6"] 	= $dataResults->accountCustom6; // $data_output["accountCustom"][5]
				$data_output["accountCustom7"] 	= $dataResults->accountCustom7; // $data_output["accountCustom"][6]
				$data_output["accountCustom8"]	= $dataResults->accountCustom8; // $data_output["accountCustom"][7]
				$data_output["accountCustom9"] 	= $dataResults->accountCustom9; // $data_output["accountCustom"][8]
				$data_output["accountCustom10"] = $dataResults->accountCustom10;// $data_output["accountCustom"][9]


				$output = $this->drawingPageInfo($data_output);	

				
				
		 	}

		

		 $data = array("data"=>$output);
		echo json_encode($data);
			

		
	}


	public function drawingPageInfo($data_page)
	{
		$data=array("data"=>$data_page);

		$page = $this->load->view("M2M/PageInfoIccid",$data,TRUE);
		return $page;
	
	}


	


	
}

?>