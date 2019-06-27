<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EventReport extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("M_EventReport");
		date_default_timezone_set("asia/jakarta");
	}


	/*
	:: ================================================
	:: *** event report main function *** 
	:: *** Author = idris sulaiman  *** 
	::
	:: ================================================
	*/

	function tableEvent()
	{
		$data['page'] = 'event';
		$data['title'] = 'Event';
		$this->template->views('event_report/tableEvent',$data);
	}

	function updateEvent($id,$mode_report)
	{
		$this->load->model("M_EventReport");
		$qstr = "SELECT id_type_event from tb_event where id_event=?";
		$data=array($id);
		$process = $this->M_EventReport->getDataEvent($qstr,$data);

		$type_event = $process[0]->id_type_event;

		switch($type_event)
		{
			case "1" :
				

					$queryStringEvent = "SELECT tb_event.id_type_event,tb_event.report_number,tb_event.event_name,tb_event.event_detail,tb_event.event_start,tb_event.event_end,tb_event.email,tb_status_report.status,tb_event.note from tb_event,tb_status_report where tb_event.id_event=? and tb_status_report.id=tb_event.status ";

					$queryStringLocation="SELECT tb_kota.id,tb_kota.name from tb_event,tb_kota where tb_kota.id = tb_event.id_location and tb_event.id_event = ?";

					$queryStringEnginer="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_escalate where tb_user.id = tb_escalate.id_engineer and tb_escalate.id_event = tb_event.id_event and tb_event.id_event=?";

					$queryStringReporter="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_operator where tb_user.id = tb_operator.id_operator and tb_operator.id_event = tb_event.id_event and tb_event.id_event=?";

					$process = $this->M_EventReport->getDataEvent($queryStringEvent,$data);
					$processLocation = $this->M_EventReport->getDataEvent($queryStringLocation,$data);
					$processEnginer = $this->M_EventReport->getDataEvent($queryStringEnginer,$data);
					$processReporter = $this->M_EventReport->getDataEvent($queryStringReporter,$data);

					$data['message']="type report 1";
					$data['proses'] = $process;
					foreach ($process as $key) 
					{
						$data['mode_report']    = $mode_report;
						$data['id_event']		= $id; // id pada baris table_event
						$data['type_report'] 	= $key->id_type_event;
						$data['report_number'] 	= $key->report_number;
						$data['plan_name'] 		= $key->event_name;
						$data['activity'] 		= $key->event_detail;
						$data['start_time'] 	= $key->event_start;
						$data['end_time'] 		= $key->event_end;
						$data['status'] 		= $key->status;
						$data['note'] 			= $key->note;
						$data['emails'] 		= $key->email;						
					}

					$data['location'] 		= $processLocation[0]->name;
					$data['id_location'] 		= $processLocation[0]->id;

					$data['enginer'] = array();
					foreach ($processEnginer as $key) {
						
						$list_enginer['id_enginer'] = $key->id;
						$list_enginer['nama_enginer'] = $key->nama;

						array_push($data['enginer'], $list_enginer);
					}

					$data['reporter'] = array();
					foreach ($processReporter as $key) {
						
						$list_reporter['id_reporter'] = $key->id."_".$key->nama;
						$list_reporter['nama_reporter'] = $key->nama;

						array_push($data['reporter'], $list_reporter);
					}
			break;

			/* end off case !*/

			case '2' :

				$queryStringEvent = "SELECT tb_event.id_type_event,tb_event.report_number,tb_event.event_name,tb_event.event_detail,tb_event.event_start,tb_event.event_end,tb_event.email,tb_status_report.status,tb_event.note from tb_event,tb_status_report where tb_event.id_event=? and tb_status_report.id=tb_event.status ";
				$queryStringLocation="SELECT tb_kota.id,tb_kota.name from tb_event,tb_kota where tb_kota.id = tb_event.id_location and tb_event.id_event = ?";

				$queryStringEnginer="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_escalate where tb_user.id = tb_escalate.id_engineer and tb_escalate.id_event = tb_event.id_event and tb_event.id_event=?";

				$queryStringReporter="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_operator where tb_user.id = tb_operator.id_operator and tb_operator.id_event = tb_event.id_event and tb_event.id_event=?";

				$queryStringIncident = "SELECT tb_incident_report.impact,tb_incident_report.root_cause,tb_incident_report.action from tb_incident_report,tb_event where tb_event.id_event=? and tb_event.id_event = tb_incident_report.id_event ";

				$process = $this->M_EventReport->getDataEvent($queryStringEvent,$data);
				$processLocation = $this->M_EventReport->getDataEvent($queryStringLocation,$data);
				$processEnginer = $this->M_EventReport->getDataEvent($queryStringEnginer,$data);
				$processReporter = $this->M_EventReport->getDataEvent($queryStringReporter,$data);
				$processIncident = $this->M_EventReport->getDataEvent($queryStringIncident,$data);



				$data['message']="type report 2";
					foreach ($process as $key) 
					{
						$data['mode_report']    = $mode_report;
						$data['id_event']		= $id; // id pada baris table_event
						$data['type_report'] 	= $key->id_type_event;
						$data['report_number'] 	= $key->report_number;
						$data['incident_name'] 	= $key->event_name;
						$data['activity'] 		= $key->event_detail;
						$data['start_time'] 	= $key->event_start;
						$data['end_time'] 		= $key->event_end;
						$data['status'] 		= $key->status;
						$data['note'] 			= $key->note;
						$data['emails'] 		= $key->email;						
					}

				$data['location'] 			= $processLocation[0]->name;
				$data['id_location'] 		= $processLocation[0]->id;

				$data['enginer'] = array();
					foreach ($processEnginer as $key) {
						
						$list_enginer['id_enginer'] = $key->id;
						$list_enginer['nama_enginer'] = $key->nama;

						array_push($data['enginer'], $list_enginer);
					}

				$data['reporter'] = array();
					foreach ($processReporter as $key) {
						
						$list_reporter['id_reporter'] = $key->id."_".$key->nama;
						$list_reporter['nama_reporter'] = $key->nama;

						array_push($data['reporter'], $list_reporter);
					}

				$data['incident'] = array();
					foreach ($processIncident as $key) {
						
						$list_incident['impact'] = $key->impact;
						$list_incident['root_cause'] = $key->root_cause;
						$list_incident['action'] = $key->action;

						array_push($data['incident'], $list_incident);
					}		
				
			break;

		/* end off case !*/
		
		case '3' :

				$queryStringEvent = "SELECT tb_event.id_type_event,tb_event.report_number,tb_event.event_name,tb_event.event_detail,tb_event.event_start,tb_event.event_end,tb_event.email,tb_status_report.status,tb_event.note,tb_event.user_create from tb_event,tb_status_report where tb_event.id_event=? and tb_status_report.id=tb_event.status ";

				$queryStringReporter="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_operator where tb_user.id = tb_operator.id_operator and tb_operator.id_event = tb_event.id_event and tb_event.id_event=?";

				$queryStringLocation="SELECT tb_kota.id,tb_kota.name from tb_event,tb_kota where tb_kota.id = tb_event.id_location and tb_event.id_event = ?";
				
				$process = $this->M_EventReport->getDataEvent($queryStringEvent,$data);
				$processReporter = $this->M_EventReport->getDataEvent($queryStringReporter,$data);
				$processLocation = $this->M_EventReport->getDataEvent($queryStringLocation,$data);


					foreach ($process as $key) 
					{
						$data['mode_report']    = $mode_report;
						//$data['message']        ="type report ".$key->id_type_event;
						$data['id_event']		= $id; // id pada baris table_event
						$data['type_report'] 	= $key->id_type_event;
						$data['report_number'] 	= $key->report_number;
						$data['event_name'] 	= $key->event_name;
						$data['event_detail'] 	= $key->event_detail;
						$data['start_time'] 	= $key->event_start;
						$data['end_time'] 		= $key->event_end;
						$data['status'] 		= $key->status;
						$data['note'] 			= $key->note;
						$data['emails'] 		= $key->email;	
						$data['user_create'] 	= $key->user_create;						
					}

					$data['reporter'] = array();
					foreach ($processReporter as $key) {
						
						$list_reporter['id_reporter'] = $key->id."_".$key->nama;
						$list_reporter['nama_reporter'] = $key->nama;

						array_push($data['reporter'], $list_reporter);
					}

					$data['location'] 			= $processLocation[0]->name;
					$data['id_location'] 		= $processLocation[0]->id;	

				//$data['type_report']="3";
			break;

		/* end off case !*/
		
		case '4' :

				$queryStringEvent = "SELECT tb_event.id_type_event,tb_event.report_number,tb_event.event_name,tb_event.event_detail,tb_event.event_start,tb_event.event_end,tb_event.email,tb_status_report.status,tb_event.note,tb_event.user_create from tb_event,tb_status_report where tb_event.id_event=? and tb_status_report.id=tb_event.status ";

				$queryStringReporter="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_operator where tb_user.id = tb_operator.id_operator and tb_operator.id_event = tb_event.id_event and tb_event.id_event=?";

				$queryStringLocation="SELECT tb_kota.id,tb_kota.name from tb_event,tb_kota where tb_kota.id = tb_event.id_location and tb_event.id_event = ?";
				
				$process = $this->M_EventReport->getDataEvent($queryStringEvent,$data);
				$processReporter = $this->M_EventReport->getDataEvent($queryStringReporter,$data);
				$processLocation = $this->M_EventReport->getDataEvent($queryStringLocation,$data);


					foreach ($process as $key) 
					{
						$data['mode_report']    = $mode_report;
						//$data['message']        ="type report ".$key->id_type_event;
						$data['id_event']		= $id; // id pada baris table_event
						$data['type_report'] 	= $key->id_type_event;
						$data['report_number'] 	= $key->report_number;
						$data['event_name'] 	= $key->event_name;
						$data['event_detail'] 	= $key->event_detail;
						$data['start_time'] 	= $key->event_start;
						$data['end_time'] 		= $key->event_end;
						$data['status'] 		= $key->status;
						$data['note'] 			= $key->note;
						$data['emails'] 		= $key->email;	
						$data['user_create'] 	= $key->user_create;						
					}

					$data['reporter'] = array();
					foreach ($processReporter as $key) {
						
						$list_reporter['id_reporter'] = $key->id."_".$key->nama;
						$list_reporter['nama_reporter'] = $key->nama;

						array_push($data['reporter'], $list_reporter);
					}

					$data['location'] 			= $processLocation[0]->name;
					$data['id_location'] 		= $processLocation[0]->id;	

				//$data['type_report']="3";
			break;

				
				


			default: $data['message']="type report not found";break;	
		}

		if($mode_report=='edit')
		{
			$attachment = $this->M_EventReport->getDataAttachment($id);
			$data['page'] = 'Update Event';
			$data['title'] = 'Update Event';
			$data['attachment']=$attachment;

			$this->template->views('event_report/updateEvent',$data);
	
		}

		if($mode_report=='show')
		{
			$data['page'] = 'Show Event';
			$data['title'] = 'Show Event';
			$this->template->views('event_report/updateEvent',$data);
	
		}

		if($mode_report=='preview')
		{
			$output=array(
				"data_preview"=>$data
			);
			echo json_encode($output);
	
		}

		
		
	}




	/*
	:: ================================================
	:: *** end of Event report main function *** 
	:: ================================================
	*/


	public function updateListAttachment()
	{
		$id_event=$this->input->post("id_event");
		$process = $this->M_EventReport->getUpdateLinkAttachment($id_event);

		//var_dump($process);

		$newLink="";
		foreach ($process as $key) 
		{
			$data=explode("/", $key->url);
			$data_id=explode("-", $data[1]);
			$data_index=count($data_id);
			$url= base_url($key->url);

			$newLink .="<p id='link_$key->id_files'>";
			$newLink .="<i class='glyphicon glyphicon-file'></i>";
			$newLink .="<a href='$url' class='p-list-attach' data='".$data_id[ $data_index-1 ]."' >".$data[1]." </a>&nbsp;";
			$newLink .="<i class='glyphicon glyphicon-trash btn_delete_attachment' id='$key->id_files' style='cursor:pointer;'></i>";
			$newLink .="</p>";

		}

		$output=array("newLink"=>$newLink);

		echo json_encode($output);
	}



	public function updateData()
	{
		//var_dump( $this->input->post() );

		$type_report = $this->input->post('type_report');
		$list_file_attachment=$this->input->post('data_add_attachment');

		switch($type_report)
		{
			case '1' : // plan reporting
				
					$dataInput=array(
						
						'type_report'				=>$this->input->post('type_report'),
						'plan_name'  				=>$this->input->post('plan_name'),
						'location'  				=>$this->input->post('location'),
						'activity'  				=>trim(preg_replace('/\s\s+/', '', $this->input->post('activity'))),
						'start_time'  				=>$this->input->post('start_time'),
						'end_time'  				=>$this->input->post('end_time'),
						'reporter'  				=>$this->input->post('reporter'),
						'status'					=>$this->input->post('status'),
						'note'  					=>trim(preg_replace('/\s\s+/', '', $this->input->post('note'))),
						'emails'  					=>$this->input->post('emails'),
						'enginer'  					=>$this->input->post('enginer'),
						'report_number'				=>$this->input->post('form_number'),
						'id_db'						=>$this->input->post('id_db'),
						'list_delete_attachment'	=>$this->input->post('list_delete_attachment')

					);
				
					$this->db->trans_begin();
					
					$queryUpdate = "UPDATE tb_event set event_name=?,id_location=?,event_detail=?,event_start=?,event_end=?,email=?,status=?,user_update=?,update_at=?,note=? where id_event=? ";
					
					$param = array(

						'plan_name'  	=> $dataInput['plan_name'],
						"id_location" 	=> $dataInput['location'],
						"event_detail"	=> $dataInput['activity'],
						"event_start"	=> $dataInput['start_time'],
						"event_end"		=> $dataInput['end_time'],
						"email"			=> $dataInput['emails'],
						"status"		=> $dataInput['status'],
						"user_update"	=> $this->session->userdata('nama')." [".$this->session->userdata('username')." ]",
						"update_at"		=> date("Y-m-d H:i:s"),
						"note"			=> $dataInput['note'],
						 "id_db"		=> $dataInput['id_db']
						
					);


					$process1=$this->M_EventReport->update_table($queryUpdate,$param);

					$queryDelete = "DELETE from tb_escalate where id_event=?";
					$process2=$this->M_EventReport->update_table($queryDelete,$dataInput['id_db']);

					$dataEnginer = explode(",",$dataInput['enginer']) ;
					$queryUpdateEnginer = " INSERT into tb_escalate (id_eskalasi,id_event,id_engineer) VALUES (?,?,?)";

					for($a=0;$a<count($dataEnginer);$a++)
					{
						if( $dataEnginer[$a] ==null)
						{
							break;
						}

						$paramEnginer = array(
							"id_eskalasi" => null,
							"id_event"	  => $dataInput['id_db'],
							"id_engineer" => $dataEnginer[$a]	
						);
						$process3=$this->M_EventReport->insert_table($queryUpdateEnginer,$paramEnginer);
					}

					
					$queryDeleteOperator = "DELETE from tb_operator where id_event=?";
					$process2=$this->M_EventReport->update_table($queryDeleteOperator,$dataInput['id_db']);

					$dataOperator = explode(",",$dataInput['reporter']) ;
					$queryUpdateOperator = " INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";

					for($a=0;$a<count($dataOperator);$a++)
					{
						if( $dataOperator[$a] ==null)
						{
							break;
						}

						$paramOperator = array(
							"id_" => null,
							"id_event"	  => $dataInput['id_db'],
							"id_operator" => $dataOperator[$a]	
						);
						$process3=$this->M_EventReport->insert_table($queryUpdateOperator,$paramOperator);
					}


					// deleting process file attachment 
					if( $dataInput['list_delete_attachment'] !='' || !empty($dataInput['list_delete_attachment']) )
					{
						$dataDelete=explode(",", $dataInput['list_delete_attachment'] );
						$totalDelete=count($dataDelete);

						// delete attachment on database
						$deleteFileName=array();
						for($a=0;$a<$totalDelete;$a++)
						{
							$getDeleteFileName=$this->M_EventReport->getLinkAttachment($dataDelete[$a]);
							$process_delete=$this->M_EventReport->deleteDataAttachment($dataDelete[$a]);
							
							if($process_delete == true)
							{
								$fileNameTarget= $getDeleteFileName[0]->url ;
								array_push( $deleteFileName,$fileNameTarget );	
							
							}else{
								break;
							}						
						}

					
					
						// delete attachment on server
						for ($i=0; $i < count($deleteFileName) ; $i++) 
						{ 
							if(file_exists( $deleteFileName[$i] ))
							{
								$deleteFileOnServer = unlink( $deleteFileName[$i] );
							}		
						}
						
					}


					
					
					if($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
						$status = false;
					}else{
						$this->db->trans_commit();
						$status = true;
						$statusUpload =  $this->doUpload($dataInput['report_number'],$list_file_attachment);

					}

					break;

			case '2': // incident reporting

				$dataInput=array(
						
						'type_report'				=>$this->input->post('type_report'),
						'incident_name'  			=>$this->input->post('incident_name'),
						'start_time'  				=>$this->input->post('start_time'),
						// 'impact'  					=>$this->input->post('impact'),
						'impact'  					=>trim(preg_replace('/\s\s+/', '', $this->input->post('impact'))),
						'root_cause'  				=>trim(preg_replace('/\s\s+/', '', $this->input->post('root_cause'))),
						'action'  					=>trim(preg_replace('/\s\s+/', '', $this->input->post('action'))),
						'location'  				=>$this->input->post('location'),
						'reporter'  				=>$this->input->post('reporter'),
						'status'					=>$this->input->post('status'),
						'end_time'  				=>$this->input->post('end_time'),
						'note'  					=>trim(preg_replace('/\s\s+/', '', $this->input->post('note'))),
						'emails'  					=>$this->input->post('emails'),
						'enginer'  					=>$this->input->post('enginer'),
						'id_db'						=>$this->input->post('id_db'),
						'report_number'				=>$this->input->post('form_number'),
						'list_delete_attachment'	=>$this->input->post('list_delete_attachment')

					);

				$this->db->trans_begin();
					
					$queryUpdate = "UPDATE tb_event set event_name=?,id_location=?,event_start=?,event_end=?,email=?,status=?,user_update=?,update_at=?,note=? where id_event=? ";
					
					$param = array(

						"incident_name" => $dataInput['incident_name'],
						"id_location" 	=> $dataInput['location'],
						"event_start"	=> $dataInput['start_time'],
						"event_end"		=> $dataInput['end_time'],
						"email"			=> $dataInput['emails'],
						"status"		=> $dataInput['status'],
						"user_update"	=> $this->session->userdata('nama')." [".$this->session->userdata('username')." ]",
						"update_at"		=> date("Y-m-d H:i:s"),
						"note"			=> $dataInput['note'],
						 "id_db"		=> $dataInput['id_db']
						
					);


					$process1=$this->M_EventReport->update_table($queryUpdate,$param);

					$queryDelete = "DELETE from tb_escalate where id_event=?";
					$process2=$this->M_EventReport->update_table($queryDelete,$dataInput['id_db']);

					$dataEnginer = explode(",",$dataInput['enginer']) ;
					$queryUpdateEnginer = " INSERT into tb_escalate (id_eskalasi,id_event,id_engineer) VALUES (?,?,?)";

					for($a=0;$a<count($dataEnginer);$a++)
					{
						if( $dataEnginer[$a] ==null)
						{
							break;
						}

						$paramEnginer = array(
							"id_eskalasi" => null,
							"id_event"	  => $dataInput['id_db'],
							"id_engineer" => $dataEnginer[$a]	
						);
						$process3=$this->M_EventReport->insert_table($queryUpdateEnginer,$paramEnginer);
					}

					$queryIncidentReport = "UPDATE tb_incident_report set impact=?, root_cause=?, action=? where id_event=? ";
					$paramIncident = array(
						"impact"  => $dataInput['impact'],
						"root_cause"  => $dataInput['root_cause'],
						"action"  => $dataInput['action'],
						"id_event"  => $dataInput['id_db']
					);

					$process4=$this->M_EventReport->insert_table($queryIncidentReport,$paramIncident);

					$queryDeleteOperator = "DELETE from tb_operator where id_event=?";
					$process5=$this->M_EventReport->update_table($queryDeleteOperator,$dataInput['id_db']);

					$dataOperator = explode(",",$dataInput['reporter']) ;
					$queryUpdateOperator = " INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";

					for($a=0;$a<count($dataOperator);$a++)
					{
						if( $dataOperator[$a] ==null)
						{
							break;
						}

						$paramOperator = array(
							"id_" => null,
							"id_event"	  => $dataInput['id_db'],
							"id_operator" => $dataOperator[$a]	
						);
						$process3=$this->M_EventReport->insert_table($queryUpdateOperator,$paramOperator);
					}

					// deleting process file attachment 
					if( $dataInput['list_delete_attachment'] !='' || !empty($dataInput['list_delete_attachment']) )
					{
						$dataDelete=explode(",", $dataInput['list_delete_attachment'] );
						$totalDelete=count($dataDelete);

						// delete attachment on database
						$deleteFileName=array();
						for($a=0;$a<$totalDelete;$a++)
						{
							$getDeleteFileName=$this->M_EventReport->getLinkAttachment($dataDelete[$a]);
							$process_delete=$this->M_EventReport->deleteDataAttachment($dataDelete[$a]);
							
							if($process_delete == true)
							{
								$fileNameTarget= $getDeleteFileName[0]->url ;
								array_push( $deleteFileName,$fileNameTarget );	
							
							}else{
								break;
							}						
						}

					
					
						// delete attachment on server
						for ($i=0; $i < count($deleteFileName) ; $i++) 
						{ 
							if(file_exists( $deleteFileName[$i] ))
							{
								$deleteFileOnServer = unlink( $deleteFileName[$i] );
							}		
						}
						
					}

					
					
					if($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
						$status = false;
					}else{
						$this->db->trans_commit();
						$status = true;
						$statusUpload =  $this->doUpload($dataInput['report_number'],$list_file_attachment);
					}

				break;

			case '3': // activity reporting

					//var_dump( $this->input->post() );
					$dataInput=array(
						
						'type_report'				=>$this->input->post('type_report'),
						'activity_name'  			=>$this->input->post('activity_name'),
						'request_by'  				=>$this->input->post('request_by'),
						'activity'  				=>trim(preg_replace('/\s\s+/', '', $this->input->post('activity'))),
						'location'  				=>$this->input->post('location'),
						'reporter'  				=>$this->input->post('reporter'),
						'start_time'  				=>$this->input->post('start_time'),
						'end_time'  				=>$this->input->post('end_time'),
						'status'					=>$this->input->post('status'),
						'note'  					=>trim(preg_replace('/\s\s+/', '', $this->input->post('note'))),
						'emails'  					=>$this->input->post('emails'),
						'id_db'						=>$this->input->post('id_db'),
						'report_number'				=>$this->input->post('report_number'),
						'list_delete_attachment'	=>$this->input->post('list_delete_attachment'),
						'data_add_attachment'		=>$this->input->post('data_add_attachment')									
					);

					$this->db->trans_begin();
					
					$queryUpdate = "UPDATE tb_event set event_name=?,id_location=?,event_detail=?,event_start=?,event_end=?,email=?,status=?,user_create=?,user_update=?,update_at=?,note=?,request_by=? where id_event=? ";
					
					$param = array(

						"activity_name" => $dataInput['activity_name'],
						"id_location" 	=> $dataInput['location'],
						"event_detail" 	=> $dataInput['activity'],
						"event_start"	=> $dataInput['start_time'],
						"event_end"		=> $dataInput['end_time'],
						"email"			=> $dataInput['emails'],
						"status"		=> $dataInput['status'],
						"user_create"	=> $dataInput['request_by'],
						"user_update"	=> $this->session->userdata('nama')." [".$this->session->userdata('username')." ]",
						"update_at"		=> date("Y-m-d H:i:s"),
						"note"			=> $dataInput['note'],
						"request_by"	=> $dataInput['request_by'],
						 "id_db"		=> $dataInput['id_db']
						
					);


					$process1=$this->M_EventReport->update_table($queryUpdate,$param);

					$queryDeleteOperator = "DELETE from tb_operator where id_event=?";
					$process2=$this->M_EventReport->update_table($queryDeleteOperator,$dataInput['id_db']);

					$dataOperator = explode(",",$dataInput['reporter']) ;
					$queryUpdateOperator = " INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";

					for($a=0;$a<count($dataOperator);$a++)
					{
						if( $dataOperator[$a] ==null)
						{
							break;
						}

						$paramOperator = array(
							"id_" => null,
							"id_event"	  => $dataInput['id_db'],
							"id_operator" => $dataOperator[$a]	
						);
						$process3=$this->M_EventReport->insert_table($queryUpdateOperator,$paramOperator);
					}

					// delete attachment on database
					if( $dataInput['list_delete_attachment'] !='' || !empty($dataInput['list_delete_attachment']) )
					{
						$dataDelete=explode(",", $dataInput['list_delete_attachment'] );
						$totalDelete=count($dataDelete);

						$deleteFileName=array();
						for($a=0;$a<$totalDelete;$a++)
						{
							$getDeleteFileName=$this->M_EventReport->getLinkAttachment($dataDelete[$a]);

							$process_delete=$this->M_EventReport->deleteDataAttachment($dataDelete[$a]);

							if($process_delete == true)
							{
								$fileNameTarget= $getDeleteFileName[0]->url ;
								array_push( $deleteFileName,$fileNameTarget );	
							
							}else{
								break;
							}						
						}

					
					
						// delete attachment on server
						for ($i=0; $i < count($deleteFileName) ; $i++) 
						{ 
							if(file_exists( $deleteFileName[$i] ))
							{
								$deleteFileOnServer = unlink( $deleteFileName[$i] );
							}		
						}
						
					}


	
					if($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
						$status = false;
					}else{
						$this->db->trans_commit();
						$status = true;
						$statusUpload =  $this->doUpload($dataInput['report_number'],$list_file_attachment);
					}

				break;

			case '4': // request reporting

					$dataInput=array(
						
						'type_report'	=>$this->input->post('type_report'),
						'request_name'  	=>$this->input->post('request_name'),
						'request_by'  	=>$this->input->post('request_by'),
						'activity'  	=>trim(preg_replace('/\s\s+/', '', $this->input->post('activity'))),
						'location'  	=>$this->input->post('location'),
						'reporter'  	=>$this->input->post('reporter'),
						'start_time'  	=>$this->input->post('start_time'),
						'end_time'  	=>$this->input->post('end_time'),
						'status'		=>$this->input->post('status'),
						'note'  		=>trim(preg_replace('/\s\s+/', '', $this->input->post('note'))),
						'emails'  		=>$this->input->post('emails'),
						'id_db'			=>$this->input->post('id_db'),
						'report_number'	=>$this->input->post('report_number'),
						'list_delete_attachment'	=>$this->input->post('list_delete_attachment')											
					);

					$this->db->trans_begin();
					
					$queryUpdate = "UPDATE tb_event set event_name=?,id_location=?,event_detail=?,event_start=?,event_end=?,email=?,status=?,user_create=?,user_update=?,update_at=?,note=? where id_event=? ";
					
					$param = array(
						
						"request_name" 	=> $dataInput['request_name'],
						"id_location" 	=> $dataInput['location'],
						"event_detail" 	=> $dataInput['activity'],
						"event_start"	=> $dataInput['start_time'],
						"event_end"		=> $dataInput['end_time'],
						"email"			=> $dataInput['emails'],
						"status"		=> $dataInput['status'],
						"user_create"	=> $dataInput['request_by'],
						"user_update"	=> $this->session->userdata('nama')." [".$this->session->userdata('username')." ]",
						"update_at"		=> date("Y-m-d H:i:s"),
						"note"			=> $dataInput['note'],
						 "id_db"		=> $dataInput['id_db']
						
					);


					$process1=$this->M_EventReport->update_table($queryUpdate,$param);

					$queryDeleteOperator = "DELETE from tb_operator where id_event=?";
					$process2=$this->M_EventReport->update_table($queryDeleteOperator,$dataInput['id_db']);

					$dataOperator = explode(",",$dataInput['reporter']) ;
					$queryUpdateOperator = " INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";

					for($a=0;$a<count($dataOperator);$a++)
					{
						if( $dataOperator[$a] ==null)
						{
							break;
						}

						$paramOperator = array(
							"id_" => null,
							"id_event"	  => $dataInput['id_db'],
							"id_operator" => $dataOperator[$a]	
						);
						$process3=$this->M_EventReport->insert_table($queryUpdateOperator,$paramOperator);
					}

					
					// deleting process file attachment 
					if( $dataInput['list_delete_attachment'] !='' || !empty($dataInput['list_delete_attachment']) )
					{
						$dataDelete=explode(",", $dataInput['list_delete_attachment'] );
						$totalDelete=count($dataDelete);

						// delete attachment on database
						$deleteFileName=array();
						for($a=0;$a<$totalDelete;$a++)
						{
							$getDeleteFileName=$this->M_EventReport->getLinkAttachment($dataDelete[$a]);
							$process_delete=$this->M_EventReport->deleteDataAttachment($dataDelete[$a]);
							
							if($process_delete == true)
							{
								$fileNameTarget= $getDeleteFileName[0]->url ;
								array_push( $deleteFileName,$fileNameTarget );	
							
							}else{
								break;
							}						
						}

					
					
						// delete attachment on server
						for ($i=0; $i < count($deleteFileName) ; $i++) 
						{ 
							if(file_exists( $deleteFileName[$i] ))
							{
								$deleteFileOnServer = unlink( $deleteFileName[$i] );
							}		
						}
						
					}
					
					
					if($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
						$status = false;
					}else{
						$this->db->trans_commit();
						$status = true;
						$statusUpload =  $this->doUpload($dataInput['report_number'],$list_file_attachment);
					}

				break;
		}

		$output = array(
			"results"		=>$status,
			"statusUpload"	=>$statusUpload
		);
		echo json_encode($output);
	}

	public function validation()
	{
		
		$process_type = $this->input->post("process_type");
		$status = $this->input->post("status");
		$location = $this->input->post("location");
		$reporter = $this->input->post("reporter");

		if($process_type=="insert")
		{
			$list_file_attachment = $this->input->post("list_attachment");
		}

		if($process_type=="update")
		{
			$list_file_attachment = $this->input->post("data_add_attachment");
		}

		



		if($status =="0" || $location=="0" || $reporter=="0" || $reporter==null || $reporter=='')
		{
			$results="incomplete";
			$field = array();

			

			if($status=="0")
			{
				array_push($field,"status");
			}

			if($location=="0")
			{
				array_push($field,"location");
			}

			if($reporter=="0" || $reporter==null || $reporter=='')
			{
				array_push($field,"reporter");
			}



			foreach ($_POST as $key => $value) 
			{
				if(empty( $_POST[$key] ) && $key != 'note' )
				{
					array_push($field,$key);
				}
			}


			$output = array(
				"results" =>$results,
				"field"  =>$field,
				"message"=>""	
			);

			echo json_encode($output);
		
		}else
			{

					$this->load->library("form_validation");
					$reportType = $this->input->post("type_report");

					/* jika status adalah close*/
					if($status == '4' )
					{
						$this->form_validation->set_rules("emails","emails","trim|required");
						$this->form_validation->set_rules("end_time","end_time","trim|required");
					}

					
				
					switch($reportType)
					{
						case "1":

							$this->form_validation->set_rules("plan_name","plan_name","trim|required");
							$this->form_validation->set_rules("activity","activity","trim|required");
							$this->form_validation->set_rules("start_time","start_time","trim|required");
							//$this->form_validation->set_rules("end_time","end_time","trim|required");
							//$this->form_validation->set_rules("note","note","trim|required");
							//$this->form_validation->set_rules("emails","emails","trim|required");
							$this->form_validation->set_rules("enginer","enginer","trim|required");
							
						break;

						case "2" :

							

							$this->form_validation->set_rules("incident_name","incident_name","trim|required");
							$this->form_validation->set_rules("start_time","start_time","trim|required");
							$this->form_validation->set_rules("impact","impact","trim|required");
							$this->form_validation->set_rules("root_cause","root_cause","trim|required");
							$this->form_validation->set_rules("action","action","trim|required");
							//$this->form_validation->set_rules("end_time","end_time","trim|required");
							//$this->form_validation->set_rules("note","note","trim|required");
							//$this->form_validation->set_rules("emails","emails","trim|required");
							$this->form_validation->set_rules("enginer","enginer","trim|required");
							
						break;

						case "3" :

							
							$this->form_validation->set_rules("activity_name","activity_name","trim|required");
							$this->form_validation->set_rules("request_by","request_by","trim|required");
							$this->form_validation->set_rules("activity","activity","trim|required");
							$this->form_validation->set_rules("start_time","start_time","trim|required");
							//$this->form_validation->set_rules("end_time","end_time","trim|required");
							//$this->form_validation->set_rules("note","note","trim|required");
							//$this->form_validation->set_rules("emails","emails","trim|required");
							

						break;

						case "4" :

							$this->form_validation->set_rules("request_name","request_name","trim|required");
							$this->form_validation->set_rules("request_by","request_by","trim|required");
							$this->form_validation->set_rules("activity","activity","trim|required");
							$this->form_validation->set_rules("start_time","start_time","trim|required");
							//$this->form_validation->set_rules("end_time","end_time","trim|required");
							//$this->form_validation->set_rules("note","note","trim|required");
							//$this->form_validation->set_rules("emails","emails","trim|required");

						break;
					}

						$results="incomplete";
						$field = array();

						if( $this->form_validation->run()==false)
						{

							
							$results="incomplete";

							// find empty filed 
							foreach ($_POST as $key => $value) 
							{

								if( empty( $_POST[$key] ) && $key != 'note' )
								{
									array_push($field,$key);
								}

								if( empty( $_POST[$key] ) && ( $key == 'emails' || $key=='end_time') && $status =='4')
								{

									array_push($field,$key);	
								}


							}

							$output = array(
								"results" =>$results,
								"field"  =>$field,
								"message"=>""	
							);

							echo json_encode($output);

						}else{


							$checking_files=$this->checking_file_attachment( $list_file_attachment );
							if( $checking_files['status_cek'] ==false )
							{
								$output = array(
									"results" =>$checking_files['status_cek'],
									"field"  =>"attachment",
									"message"=>$checking_files['message']	
								);
								echo json_encode($output);
								
							}else{

								switch($process_type)
								{
									case 'insert':
										$this->insertData();
									break;
								
									case 'update':
										$this->updateData();

									break;

									default:
										
										exit("error : function not find !");
									break;	
								}

							}

							//var_dump("last: ".$process_type);
							/*$results="success";
							$output = array(
								"results" =>$results,
								"field"  =>$field	
							);
							echo json_encode($output);*/

							/*switch($process_type)
							{
								case 'insert':
									$this->insertData();
								break;
							
								case 'update':
									$this->updateData();
								break;

								default:
									
									exit("error : function not find !");
								break;	
							}*/

							
						}
			}
	}

	public function checking_file_attachment( $list_file_attachment )
	{
		//var_dump($list_file_attachment);
		// $totalFile = count($list_file_attachment);
		$file=explode(",",$list_file_attachment);
		$fileAttach = $_FILES['file_source']['name'];

		//var_dump("jumlah file");
		//var_dump($file);

		$output = array();
		if( ( count($file) ==1 && $file[0]=='' ) || $fileAttach[0]=='' )
		{
			$output['status_cek'] = true;
			$output['message'] = '';

			}else if( count($file) > 10 )
				{
					$output['status_cek'] = false;
					$output['message'] = 'max limit file ( over than 10 file ) ';
				}else
					{
						$checkingSize = 0;
						$checkingExt=0;
						$ext=array("jpeg","jpg","doc","docx","xls","xlsx","png","pdf");
						$maxSize=10485760; // 10 mb
						for($a=0;$a<count($file);$a++)
						{	
							
							// checking size file 
							for( $b=0;$b<count($fileAttach);$b++ )
							{
								
								$fileSize=$_FILES['file_source']['size'][$b];
								$findExtention=explode(".", $fileAttach[$b] ) ;
								$index=count(explode(".", $fileAttach[$b] ) );
								$extention = $findExtention[$index - 1];



								if( $file[$a] == $fileAttach[$b] ) // jika list attachment file sama dengan list attcahment yang berada di server
								{									
									if($fileSize > $maxSize) // jika file melebihi batas dari maximum size (10 mb)
									{

										$checkingSize++;
										break;
									
									}else{

										if($extention < 0) // jika file tidak memiliki extention
										{

											$checkingExt--;

											break;
										}else{
											
											// checking extention file 
											for($c=0;$c<count($ext);$c++)
											{
												if( trim( strtolower($extention) ) == trim($ext[$c]) )
												{
													$checkingExt++;
													break;													
												}else{
													$checkingExt=0;
												}


											}											
										}
										
										if($checkingExt==0)
										{
											break;
										}
										
										
									} 
								}
							}

							// jika ukuran file melebihi kapasitas maximal
							if($checkingSize > 0){
								break;
							}

							// jika extention file tidak ditemukan atau file tidak memiliki extention
							if($checkingExt <= 0){
								break;
							}

						}

						

						if($checkingSize > 0)
						{
							$output['status_cek'] = false;
							$output['message'] = 'max size file ( max file size only 10 mb for each of file   ) ';

						}else if( $checkingExt <= 0 )
							{

								$dataExt="";
								for( $a=0; $a<count($ext) ; $a++)
								{
									if($a == count($ext)-1 )
									{
										$dataExt.=$ext[$a];
									}else{
										$dataExt.=$ext[$a]." , ";
									}

								}

								$output['status_cek'] = false;
								$output['message'] = ' extention files only  '.$dataExt;	

							}else
								{
									$output['status_cek'] = true;
									$output['message'] = '';	
								}
					}

					//var_dump($output);
					return $output;

			 
	}


	

	public function insertData()
	{
		$list_file_attachment = $this->input->post("list_attachment");	
		$type_report = $this->input->post('type_report');
		$data_random=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

		$string_random="";

		for ($i=0; $i <1 ; $i++) 
		{ 
			$index_random = rand(0,25);
			$string_random .=$data_random[$index_random];
		}

		$string_random = strtoupper($string_random);
		//$format = "-NOC-".date('dmy')."-";//.$running_number."-";//.$string_random;
		$format = "-NOC-";

		switch($type_report)
		{
			case '1' :

					 $queryString = "SELECT report_number from tb_event where id_event = (SELECT max(id_event) from tb_event WHERE report_number like '%pm%') ";
					 $process = $this->M_EventReport->getDataEvent($queryString);

					 if( count($process) > 0)
					 {
					 	$data_report = explode("-",$process[0]->report_number);
					 	$number = $data_report[3]+1;
					 	
					 }else{
					 	$number=1;
					 }

					 $running_number= sprintf("%06d", $number);
					 $report_number ="PM".$format.$string_random."-".$running_number;
					
					$data_event=array(
						'id_event'		=>null,
						'type_report'	=>$this->input->post('type_report'),
						'plan_name'  	=>$this->input->post('plan_name'),
						'activity'  	=>trim(preg_replace('/\s\s+/', '', $this->input->post('activity'))),
						//'start_time'  	=>$this->input->post('start_time'),
						'start_time'  	=> str_replace("T"," ",$this->input->post('start_time') ),
						//'end_time'		=>$this->input->post('end_time'),
						'end_time'		=>str_replace("T"," ",$this->input->post('end_time') ),
						'status'  		=>$this->input->post('status'),
						'note'  		=>trim(preg_replace('/\s\s+/', '', $this->input->post('note'))),
						'emails'  		=>$this->input->post('emails'), //array_data
						'location'  	=>$this->input->post('location'),
						'report_number'	=>$report_number,
						'user_create'	=>$this->session->userdata('username'),
						'create_at'		=>date('Y-m-d H:i:s')
						

					);


					
					/*
					::================================================================================
					:: start insert process table ( tb_operator, tb_event, tb_escalate & tb_enginer ) 
					::================================================================================
					*/

					 $this->db->trans_begin();					
					 $queryStringEvent ="INSERT into tb_event (id_event,id_type_event,event_name,event_detail,event_start,event_end,status,note,email,id_location,report_number,user_create,create_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ";

					 $process = $this->M_EventReport->insert_table($queryStringEvent,$data_event);
					 $qstr = "SELECT id_event from tb_event where report_number=? ";
					 $process2 = $this->M_EventReport->getDataEvent($qstr,$data_event['report_number']);
					 $idEvent=$process2[0]->id_event;
					

					
					 $list_enginer = explode(",",$this->input->post('enginer'));
					 $data_enginer=array();

					 for($a=0;$a<count($list_enginer);$a++)
					 {
					 	$data['id_eskalasi'] = null;
					 	$data['id_event'] = $idEvent;
					 	$data['enginer']=$list_enginer[$a];

					 	array_push($data_enginer, $data);
					 }

					

					 $queryStringEnginer = "INSERT into tb_escalate (id_eskalasi,id_event,id_engineer) VALUES (?,?,?)";

					 for($i=0;$i<count($data_enginer);$i++)
					 {
					 	$process3 = $this->M_EventReport->insert_table($queryStringEnginer,$data_enginer[$i]);
					 }

					
					 $list_operator = explode(",",$this->input->post('reporter'));
					 $data_operator=array();

					 for($a=0;$a<count($list_operator);$a++)
					 {
					 	$data_reporter['id'] = null;
					 	$data_reporter['id_event'] = $idEvent;
					 	$data_reporter['id_operator']=$list_operator[$a];

					 	array_push($data_operator, $data_reporter);

					 }

					$queryStringOperator = "INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";

					 for($i=0;$i<count($data_operator);$i++)
					 {
					 	//var_dump($data_operator);
					 	$process3 = $this->M_EventReport->insert_table($queryStringOperator,$data_operator[$i]);
					 }


					 


					/*
					::================================================================================
					:: finish insert process table ( tb_operator, tb_event, tb_escalate & tb_enginer ) 
					::================================================================================
					*/


					if( $this->db->trans_status()===FALSE ){
							$this->db->trans_rollback();
							$status=false;
					}else{
							$this->db->trans_commit();
							$status=true;
							$statusUpload =  $this->doUpload($report_number,$list_file_attachment);

						}


					break;

			case '2':

				


				$queryString = "SELECT report_number from tb_event where id_event = (SELECT max(id_event) from tb_event WHERE report_number like '%ir%') ";
					 $process = $this->M_EventReport->getDataEvent($queryString);

					 if( count($process) > 0)
					 {
					 	$data_report = explode("-",$process[0]->report_number);
					 	$number = $data_report[3]+1;
					 	
					 	


					 }else{

					 	$number=1;
					 }

					 $running_number= sprintf("%06d", $number);
					// $report_number ="IR".$format.$running_number."-".$string_random;
					 $report_number ="IR".$format.$string_random."-".$running_number;

				
				$data_event=array(
					'id_event'		=>null,
					'type_report'	=>$this->input->post('type_report'),
					'report_number'	=>$report_number,
					'incident_name' =>$this->input->post('incident_name'),
					'start_time'  	=>$this->input->post('start_time'),
					'end_time'		=>$this->input->post('end_time'),
					'status'  		=>$this->input->post('status'),
					'note'  		=>trim(preg_replace('/\s\s+/', '', $this->input->post('note'))),
					'emails'  		=>$this->input->post('emails'),
					'location'  	=>$this->input->post('location'),
					'user_create'	=>$this->session->userdata('username'),
					'create_at'		=>date('Y-m-d H:i:s')	
				);

				

					$this->db->trans_begin();
					$queryStringEvent ="INSERT into tb_event (id_event,id_type_event,report_number,event_name,event_start,event_end,status,note,email,id_location,user_create,create_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ";
					$process = $this->M_EventReport->insert_table($queryStringEvent,$data_event);
					
					$qstr = "SELECT id_event from tb_event where report_number=? ";
					$process2 = $this->M_EventReport->getDataEvent($qstr,$data_event['report_number']);
					$idEvent=$process2[0]->id_event;

					$data_incident=array(
						"id"			=>null,
						"id_event"		=>$idEvent,
						"impact" 		=>$this->input->post('impact'),
						"root_cause"	=>trim(preg_replace('/\s\s+/', '', $this->input->post('root_cause'))),
						"action" 		=>trim(preg_replace('/\s\s+/', '', $this->input->post('action'))),
					);
					$queryStringIncident="INSERT into tb_incident_report (id,id_event,impact,root_cause,action) values(?,?,?,?,?)";
					$process3 = $this->M_EventReport->insert_table($queryStringIncident,$data_incident);

					

					$list_enginer = explode(",",$this->input->post('enginer'));
					$data_enginer=array();

					for($a=0;$a<count($list_enginer);$a++)
					{
						$data['id_eskalasi'] = null;
						$data['id_event'] = $idEvent;
						$data['enginer']=$list_enginer[$a];

						array_push($data_enginer, $data);
					}

					$queryStringEnginer = "INSERT into tb_escalate (id_eskalasi,id_event,id_engineer) VALUES (?,?,?)";

					for($i=0;$i<count($data_enginer);$i++)
					{
						$process5 = $this->M_EventReport->insert_table($queryStringEnginer,$data_enginer[$i]);
					}


					 $list_operator = explode(",",$this->input->post('reporter'));
					 $data_operator=array();

					 for($a=0;$a<count($list_operator);$a++)
					 {
					 	$data_reporter['id'] = null;
					 	$data_reporter['id_event'] = $idEvent;
					 	$data_reporter['id_operator']=$list_operator[$a];

					 	array_push($data_operator, $data_reporter);

					 }

					$queryStringOperator = "INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";

					 for($i=0;$i<count($data_operator);$i++)
					 {
					 	//var_dump($data_operator);
					 	$process3 = $this->M_EventReport->insert_table($queryStringOperator,$data_operator[$i]);
					 }


					if( $this->db->trans_status()===FALSE ){
							$this->db->trans_rollback();
							$status=false;
					}else{
							$this->db->trans_commit();
							$status=true;
							$statusUpload =  $this->doUpload($report_number,$list_file_attachment);
						}		
				break;

			case '3' :
				
				
				   $queryString = "SELECT report_number from tb_event where id_event = (SELECT max(id_event) from tb_event WHERE report_number like '%act%') ";
					 $process = $this->M_EventReport->getDataEvent($queryString);

					 if( count($process) > 0)
					 {
					 	$data_report = explode("-",$process[0]->report_number);
					 	$number = $data_report[3]+1;
					 	
					 }else{

					 	$number=1;
					 }

					 $running_number= sprintf("%06d", $number);
					// $report_number ="ACT".$format.$running_number."-".$string_random;
					  $report_number ="ACT".$format.$string_random."-".$running_number;

					$requestBy = empty($this->input->post("request_by")) ? $this->session->userdata('username') : $this->input->post("request_by");

				$data_activity=array(
					'id_event'		=>null,
					'type_report'	=>$this->input->post('type_report'),
					'report_number'	=>$report_number,
					'activity_name' =>$this->input->post('activity_name'),
					'activity' 		=>trim(preg_replace('/\s\s+/', '', $this->input->post('activity'))),
					'start_time'  	=>$this->input->post('start_time'),
					'end_time'		=>$this->input->post('end_time'),
					'status'  		=>$this->input->post('status'),
					'note'  		=>trim(preg_replace('/\s\s+/', '', $this->input->post('note'))),
					'emails'  		=>$this->input->post('emails'),
					'location'  	=>$this->input->post('location'),			
					// 'user_create'	=>$requestBy,
					'user_create'	=>$this->session->userdata('username'),
					'create_at'		=>date('Y-m-d H:i:s'),
					'request_by'    =>$this->input->post('request_by')

					//'reporter'  	=>$this->input->post('reporter'),
					
						
				);

				

				$this->db->trans_begin();
				$queryStringEvent ="INSERT into tb_event (id_event,id_type_event,report_number,event_name,event_detail,event_start,event_end,status,note,email,id_location,user_create,create_at,request_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
				$process = $this->M_EventReport->insert_table($queryStringEvent,$data_activity);

				$qstr = "SELECT id_event from tb_event where report_number=? ";
				$process2 = $this->M_EventReport->getDataEvent($qstr,$data_activity['report_number']);
				$idEvent=$process2[0]->id_event;

				

				$list_operator = explode(",",$this->input->post('reporter'));
				 $data_operator=array();

					for($a=0;$a<count($list_operator);$a++)
					{
					 $data_reporter['id'] = null;
					 $data_reporter['id_event'] = $idEvent;
					 $data_reporter['id_operator']=$list_operator[$a];

					 array_push($data_operator, $data_reporter);

					}

				$queryStringOperator = "INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";

					for($i=0;$i<count($data_operator);$i++)
					{
					 	
					 $process3 = $this->M_EventReport->insert_table($queryStringOperator,$data_operator[$i]);
					}


				if( $this->db->trans_status()===FALSE )
				{
						$this->db->trans_rollback();
						$status=false;
				}else{
						$this->db->trans_commit();
						$status=true;
						$statusUpload =  $this->doUpload($report_number,$list_file_attachment);
					}
				
				break;


				case '4' :
				
				

					 $queryString = "SELECT report_number from tb_event where id_event = (SELECT max(id_event) from tb_event WHERE report_number like '%req%') ";
					 $process = $this->M_EventReport->getDataEvent($queryString);

					 if( count($process) > 0)
					 {
					 	$data_report = explode("-",$process[0]->report_number);
					 	$number = $data_report[3]+1;
					 	
					 }else{

					 	$number=1;
					 }

					 $running_number= sprintf("%06d", $number);
					 //$report_number ="REQ".$format.$running_number."-".$string_random;
					  $report_number ="REQ".$format.$string_random."-".$running_number;

				  
				$requestBy = empty($this->input->post("request_by")) ? $this->session->userdata('username') : $this->input->post("request_by");

				$data_activity=array(
					'id_event'		=>null,
					'type_report'	=>$this->input->post('type_report'),
					'report_number'	=>$report_number,
					// 'activity_name' =>$this->input->post('activity_name'),
					'request_name' =>$this->input->post('request_name'),
					'activity' 		=>trim(preg_replace('/\s\s+/', '', $this->input->post('activity'))),
					'start_time'  	=>$this->input->post('start_time'),
					'end_time'		=>$this->input->post('end_time'),
					'status'  		=>$this->input->post('status'),
					'note'  		=>trim(preg_replace('/\s\s+/', '', $this->input->post('note'))),
					'emails'  		=>$this->input->post('emails'),
					'location'  	=>$this->input->post('location'),			
					// 'user_create'	=>$requestBy,
					'user_create'	=>$this->session->userdata('username'),
					'create_at'		=>date('Y-m-d H:i:s'),
					'request_by'    =>$this->input->post('request_by')

					//'reporter'  	=>$this->input->post('reporter'),
					
						
				);

				

				$this->db->trans_begin();
				$queryStringEvent ="INSERT into tb_event (id_event,id_type_event,report_number,event_name,event_detail,event_start,event_end,status,note,email,id_location,user_create,create_at,request_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
				$process = $this->M_EventReport->insert_table($queryStringEvent,$data_activity);

				$qstr = "SELECT id_event from tb_event where report_number=? ";
				$process2 = $this->M_EventReport->getDataEvent($qstr,$data_activity['report_number']);
				$idEvent=$process2[0]->id_event;

				/*$list_operator =$this->input->post('reporter'); 
				$data_operator = array(null,$idEvent,$list_operator);
					
				$queryStringOperator = "INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";
				$process3 = $this->M_EventReport->insert_table($queryStringOperator,$data_operator);*/

				$list_operator = explode(",",$this->input->post('reporter'));
				 $data_operator=array();

					for($a=0;$a<count($list_operator);$a++)
					{
					 $data_reporter['id'] = null;
					 $data_reporter['id_event'] = $idEvent;
					 $data_reporter['id_operator']=$list_operator[$a];

					 array_push($data_operator, $data_reporter);

					}

				$queryStringOperator = "INSERT into tb_operator (id,id_event,id_operator) VALUES (?,?,?)";

				for($i=0;$i<count($data_operator);$i++)
				{				 	
				 	$process3 = $this->M_EventReport->insert_table($queryStringOperator,$data_operator[$i]);
				}


				if( $this->db->trans_status()===FALSE )
				{
						$this->db->trans_rollback();
						$status=false;
				}else{
						$this->db->trans_commit();
						$status=true;
						$statusUpload =  $this->doUpload($report_number,$list_file_attachment);
					}
				
				break;

								
		}

		

		$output = array(
			"results"=>$status,
			"statusUpload"=>$statusUpload
		);
		echo json_encode($output);
		
	}

	public function doUpload($report_number,$list_file_attachment)
	{

		//var_dump($_FILES['file_source']);
		$file_attachment = $_FILES['file_source']['name'];
		$qstr="SELECT id_event from tb_event where report_number=?";
		$dataBind=array("report_number"=>$report_number);
		$getIdEvent = $this->M_EventReport->getDataEvent($qstr,$dataBind);

		$dataAttachment=explode(",",$list_file_attachment);
		$upload_success=0;

			for($a=0;$a<count( $_FILES['file_source']['name'] );$a++)
			{
				$fileName=$_FILES['file_source']['name'][$a];
				$tempData=$_FILES['file_source']['tmp_name'][$a];
				$ranNumb=rand(0,99);
				$newFileName=$report_number."-".$ranNumb."-".$fileName;
				$newDestination = "filesUpload/".$newFileName;

				
				for($b=0;$b<count($dataAttachment);$b++)
				{
					if( $dataAttachment[$b] == $fileName )
					{
						$upload_process= move_uploaded_file($tempData, $newDestination);

						if($upload_process)
						{
							$id_event=$getIdEvent[0]->id_event;

							$qstr="INSERT into tb_files (id_files,id_event,url) values (?,?,?)";
							$dataBind=array(
								"id_files"=>null,
								"id_event"=>$id_event,
								"url"     =>$newDestination
							);

							$this->M_EventReport->insert_table($qstr,$dataBind);
							$upload_success++;
							$processUpload=true;



						}else{
							$processUpload=false;
						}
					}
				}
				
			}


			$result= count($dataAttachment) - $upload_success;
			if(  $result==0 )
			{
				$processUpload=true;

			}else{
				$processUpload=$result." file failed to uploaded";
			}

			return $processUpload;
	}

	public function getDataEvent()
	{
		//var_dump($this->input->post());
		$columns = array("no","type","report_number","event_name","event_start","status","action");
		$qstr1="SELECT tb_event.id_event,tb_type_report.type,tb_event.report_number,tb_event.event_name,tb_event.event_start,tb_status_report.status,tb_event.create_at from tb_event , tb_type_report, tb_status_report where tb_event.id_type_event = tb_type_report.id and tb_event.status = tb_status_report.id ";

		$jumlah_data = count( $this->M_EventReport->getDataEvent($qstr1) );

		$start = $this->input->post("start");
		$length = $this->input->post("length");

		$order = $this->input->post("order[0][column]");

		switch($order)
		{
			case 0 : $orderBy="tb_event.id_event";break;
			case 1 : $orderBy="tb_type_report.type";break;
			case 2 : $orderBy="tb_event.report_number";break;
			case 3 : $orderBy="tb_event.create_at";break;
			case 4 : $orderBy="tb_event.event_name";break;
			case 5 : $orderBy="tb_event.event_start";break;
			case 6 : $orderBy="tb_status_report.status";break;
			default: $orderBy="tb_event.id_event";break;
		}

		//$orderBy = "tb_event.id_event";
		 $sort = $this->input->post("order[0][dir]");
		//$sort = "DESC";
		$cari = $this->input->post("search[value]");

		if(empty($cari))
		{
			
			$qstr2="SELECT tb_event.id_event,tb_type_report.type,tb_event.report_number,tb_event.event_name,tb_event.event_start,tb_status_report.status,tb_event.create_at from tb_event , tb_type_report, tb_status_report where tb_event.id_type_event = tb_type_report.id and tb_event.status = tb_status_report.id order by $orderBy $sort  limit $start,$length";
			//$qstr2="SELECT tb_event.id_event,tb_type_report.type,tb_event.report_number,tb_event.event_name,tb_event.event_start,tb_status_report.status,tb_event.create_at from tb_event , tb_type_report, tb_status_report where tb_event.id_type_event = tb_type_report.id and tb_event.status = tb_status_report.id order by $orderBy DESC  limit $start,$length";

		
		}else{
			
			$qstr2="SELECT tb_event.id_event,tb_type_report.type,tb_event.report_number,tb_event.event_name,tb_event.event_start,tb_status_report.status,tb_event.create_at from tb_event , tb_type_report,tb_status_report where tb_event.id_type_event = tb_type_report.id and tb_event.status = tb_status_report.id and (tb_type_report.type like '%$cari%' or tb_event.report_number like '%$cari%' or tb_event.event_name like '%$cari%' or tb_status_report.status like '%$cari%') order by $orderBy $sort  limit $start,$length";			
		}	
		

		
		$proses_data=$this->M_EventReport->getDataEvent($qstr2);

		$data = array();
		$no=1;
		

		foreach ($proses_data as $key) 
		{

			switch( strtolower($key->status) )
			{
				case 'open':
					$button_status = "<input type='button' class='btn btn-danger btn-xs' value='$key->status'/>";
				break;

				case 'closed':
					$button_status = "<input type='button' class='btn btn-success btn-xs' value='$key->status'/>";
				break;

				case 'investigation':
					$button_status = "<input type='button' class='btn btn-warning btn-xs' value='$key->status'/>";
				break;

				case 'cancel':
					$button_status = "<input type='button' class='btn btn-secondary btn-xs' value='$key->status'/>";
				break;

				default:
					$button_status = "<input type='button btn-xs' value='error button'/>";
				break;	


			}

			
			$event = array(
				"no"=>$no,
				"type"=>$key->type,
				"report_number"=>$key->report_number,
				"create_at"=>$key->create_at,
				"event_name"=>$key->event_name,
				"event_start"=>$key->event_start,
				"status"=>$button_status,
				"action"=>"<a href='".base_url()."index.php/EventReport/updateEvent/$key->id_event/edit' class='btn btn-primary btn-xs' title='edit data'><i class='fa fa-pencil'></i></a>&nbsp;

					<a href='".base_url()."index.php/EventReport/updateEvent/$key->id_event/show' class='btn btn-warning btn-xs' title='show data'><i class='glyphicon glyphicon-eye-open'></i></a>
					"
			
			);

			

			$no++;
			array_push($data,$event);
		}



		$output = array(

			"draw"				=>$this->input->post('draw'),
			"recordsTotal"		=>$jumlah_data,
			"recordsFiltered"	=>$jumlah_data,		
			"data"				=>$data
		);

		

		echo json_encode($output);
	}
	

	public function validasiEmail()
	{
		$emailaddress = $this->input->post("parameter");
		$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

		

		if (preg_match($pattern, $emailaddress) === 1) {
		    // emailaddress is valid
		    $status =true;
		}else{
			$status =false;
		}
			
		
		$output = array("data"=>$status);
		echo json_encode($output);
	}

	public function getDataReportType()
	{
		$result=$this->M_EventReport->getDataTypeReport();
		$output = array("data"=>$result);

		echo json_encode($output);
	}

	public function getDataStatus()
	{
		$result=$this->M_EventReport->getDataStatus();
		$output = array("data"=>$result);

		echo json_encode($output);
	}

	public function getDataEnginer()
	{
		$parameter=$this->input->get("param");
		$result=$this->M_EventReport->getDataEnginer($parameter);

		//echo $parameter;
		
		$output = array();
		foreach ($result as $key) {
			$data=array(
				//"id"=>$key->id,
				"id"=>$key->id."_".$key->nama,
				"text"=>$key->nama
			);

			array_push($output, $data);
		}

		echo json_encode($output);
	}


	public function getNewDataEnginer()
	{
		
		$result=$this->M_EventReport->getNewDataEnginer();

		//echo $parameter;
		
		$output = array();
		foreach ($result as $key) {
			$data=array(
				"id"=>$key->id,
				"text"=>$key->nama
			);

			array_push($output, $data);
		}

		echo json_encode($output);
	}

	public function getTime()
	{
		$data = "Entry time : ".date("H:i:s");
		$output = array("time"=>$data);
		echo json_encode($output);
	}

	
	public function getOptionLocation()
	{
		$param = $this->input->get("parameter");
		$process = $this->M_EventReport->getOptionLocation($param);
		$output = array();
		foreach ($process as $key) {
			$data=array(
				"id"=>$key->id,
				"text"=>$key->name
			);

			array_push($output, $data);
		}

		echo json_encode($output);
	}

	public function getDataOperator()
	{
		$param = $this->input->get("parameter");
		$process = $this->M_EventReport->getDataOperator($param);
		$output = array();
		foreach ($process as $key) {
			$data=array(
				// "id"=>$key->id,
				"id"=>$key->id."_".$key->nama,
				"text"=>$key->nama
			);

			array_push($output, $data);
		}

		echo json_encode($output);
	}
	
	
	/* tambahan damar, untuk permintaan Pak Irwan*/
	public function list_event_by_type($type=0){
		
		//$data["data"]="";
		
		switch($type){
									case 1:
										$event = "Planning/Maintenance";
										break;
									case 2:
										$event = "Incident";
										break;
									case 3:
										$event = "Activity";
										break;
									case 4:
										$event = "Request";
										break;
								}
		
		$data["page"] = "Event List ".$event;
        $data['title'] = "Event List ".$event;
		$data['event'] = $event;
		$data['data'] = $this->db->select('*')
						->from('tb_event')
						->where('id_type_event',$type)
						->get()->result();
			$data['judul'] = 'List Of Event '.$event ;
		$this->template->views('event_report/view_group_by_type/list_event_by_type',$data);
	}
}

?>