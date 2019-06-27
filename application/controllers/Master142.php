<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_excel_import');
		$this->load->model('M_master');
		$this->load->library('excel');
	}

	function index()
	{
		$this->load->view('excel_import');
	}
	
	function fetch_remote()
	{
		$return = array();
		$data = $this->M_excel_import->select_remote();
		$check = $this->M_excel_import->check();
		$output = '';
		$return['jumlah'] = $data->num_rows();
		$row = $data->result();
		for($i = 0;$i<$data->num_rows();$i++)
		{
			if ($row[$i]->ip_lan == $check[$i]->ip_lan || $row[$i]->ip_lan == '' || $row[$i]->nama_remote == '' || $row[$i]->nama_remote == $check[$i]->nama_remote || $row[$i]->kode_kanca == '' || $row[$i]->kode_tipe_uker == '' || strlen($row[$i]->kode_uker) != 5) {
				$output .= '
				<tr>
					<td>'.($i+1).'</td>
					<td '.($row[$i]->ip_lan == $check[$i]->ip_lan ? 'style="color:red;"' : '').'>'.$row[$i]->ip_lan.''.($row[$i]->ip_lan == $check[$i]->ip_lan ? '<br>(IP LAN Sudah Ada)' : '').'</td>
					<td '.($row[$i]->nama_remote == $check[$i]->nama_remote || $row[$i]->nama_remote == '' ? 'style="color:red;"' : '').'>'.$row[$i]->nama_remote.''.($row[$i]->nama_remote == $check[$i]->nama_remote ? '<br>(Nama Remote Sudah Ada / Nama Remote Kosong)' : '').'</td>
					<td '.(strlen($row[$i]->kode_uker) != 5 ? 'style="color:red;"' : '').'>'.$row[$i]->kode_uker.'<br>(Kode Uker Tidak 5 Digit)</td>
					<td '.($row[$i]->kode_kanca == '' ? 'style="color:red;"' : '').'>'.$row[$i]->kode_kanca.'<br>(Kode Kanca Kosong)</td>
				</tr>
				';
			}else{
				$output .= '
				<tr>
					<td>'.($i+1).'</td>
					<td>'.$row[$i]->ip_lan.'</td>
					<td>'.$row[$i]->nama_remote.'</td>
					<td>'.$row[$i]->kode_uker.'</td>
					<td>'.$row[$i]->kode_kanca.'</td>
				</tr>
				';
			}
		}
		//$output .= '</tbody></table>';
		$return['output'] = $output;

		echo json_encode($return);
		//echo $output;
	}

	function import_remote()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$nama_remote 	= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$kode_uker 		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$keterangan 	= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$ip_lan 		= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$alamat 		= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$telp 			= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$nama_pic		= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$latitude 		= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$longitude 		= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$kode_kanca 	= $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$kode_tipe_uker = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
					$kode_op 		= $worksheet->getCellByColumnAndRow(15, $row)->getValue();
					$start_nop 		= $worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$end_nop 		= $worksheet->getCellByColumnAndRow(17, $row)->getValue();
					$pic_uker 		= $worksheet->getCellByColumnAndRow(18, $row)->getValue();



					$data[] = array(
						'id_remote'		=> '',
			        	'nama_remote'   => $nama_remote,
			        	'kode_uker'   	=> $kode_uker,
			        	'keterangan'  	=> $keterangan,
			        	'ip_lan'   	  	=> $ip_lan,
			        	'alamat_uker' 	=> $alamat,
			        	'telp_uker'  	=> $telp,
			        	'nama_pic'		=> $nama_pic,
			        	'latitude'  	=> $latitude,
			        	'longitude'  	=> $longitude,
			        	'user_update'	=> $this->session->userdata('username'),
			        	'user_creator'	=> $this->session->userdata('username'),
			        	'create_at'		=> date('d-m-Y H:i:s'),
			        	'update_at'		=> date('d-m-Y H:i:s'),
			        	'kode_kanca'  	=> $kode_kanca,
			        	'kode_tipe_uker'=> $kode_tipe_uker,
			        	'kode_op'     	=> $kode_op,
			        	'start_nop'   	=> $start_nop,
			        	'end_nop'  	  	=> $end_nop,
			        	'pic_uko'    	=> $pic_uker,
			        );
				}
			}
			$this->M_excel_import->insert_remote($data);
			echo 'Data Imported Successfully';
		}else{
			echo 'Error!!';
		}	
	}

	function insert_remote()
	{
		$get_data = $this->M_excel_import->get_data_new();
		$this->M_excel_import->insert_remote_new($get_data);
		echo 'Data Insert Successfully';

	}

	function remote_excel($type)
	{
		// if ($type=='valid') {
		// 	$data['data'] = $this->M_excel_import->valid();
		// }else{
		// 	$data['data'] = $this->M_excel_import->invalid();
		// }

		$valid = array();
		$invalid = array();

		$remote = $this->M_excel_import->select_remote();
		$check = $this->M_excel_import->check();
		$row = $remote->result();
		for($i = 0;$i<$remote->num_rows();$i++)
		{
			if ($row[$i]->ip_lan == $check[$i]->ip_lan || $row[$i]->ip_lan == '' || $row[$i]->nama_remote == '' || $row[$i]->nama_remote == $check[$i]->nama_remote || $row[$i]->kode_kanca == '' || $row[$i]->kode_tipe_uker == '' || strlen($row[$i]->kode_uker) != 5) {
				$invalid[] = $row[$i];
			}else{
				$valid[] = $row[$i];
			}
		}

		if ($type=='valid') {
			$data['data'] = $valid;
		}else{
			$data['data'] = $invalid;
		}

		//var_dump($data);
		$this->load->view('remote_excel',$data);
	}

	function test()
	{
		$data = $this->M_excel_import->invalid();

		var_dump($data[0]);
	}

	function Project()
	{
		$data['page']='project';
		$data['title']='Master Project';
		$this->template->views('List/list_project',$data);
	}

	function GetData_Project()
	{
		$columns = array("No","Project ID","Project Name","Note"); // data array columns harus sama dengan data header table yang tadi di buat di view

		$start=$this->input->post("start");//0
		$length=$this->input->post("length");//10
		$order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
		$sort = $this->input->post("order[0][dir]"); // asc
		$cari_data = $this->input->post("search[value]");
		
		
		if(empty($cari_data))
		{
			$datauker = $this->M_master->GetData_Project();
			$total = $this->M_master->CountData_Project();
		}else{
			$datauker = $this->M_master->GetData_Project($cari_data);
			$total = $this->M_master->CountData_Project($cari_data);
		}
		
		

		//var_dump($datauker);die();
		//var_dump($total);die();

		$array_data =array();

		$no=$start+1;
		foreach ($datauker as $key) {
			
			$data["No"]=$no;
	        $data["Project ID"]=$key->id_project;
	        $data["Project Name"]=$key->nama_project;
	        $data["Note"]=$key->keterangan;

			array_push($array_data,$data);
			$no++;

		}


		//settingan terpenting dari datatable

		$output=array(

			"draw"=>intval($this->input->post("draw")),
			"recordsTotal"=>intval($total),
			"recordsFiltered"=>intval($total),
			"data"=>$array_data
		);

		echo json_encode($output);
	}

	function SaveProject()
	{

		if(isset($_POST['nama_project'])) {

	        $data = array(
	        	'nama_project'     => $_POST['nama_project'],
	        	'keterangan' 		=> $_POST['keterangan'],
	        	'id_project'   			=> '',
	        );

	        //print_r($data);die();

	        $return = $this->db->insert('tb_project',$data);
	        if ($return) {
	        	$return = true;
	        }else{
	        	$return = false;
			}
	    }

	    echo json_encode($return);
	}

	function SPK()
	{
		$data['page']='spk';
		$data['title']='Master SPK';
		$this->template->views('List/list_spk',$data);
	}

	function GetData_SPK()
	{
		$columns = array("No","No SPK","Provider","Date","Due Date","SPK Type","Project"); // data array columns harus sama dengan data header table yang tadi di buat di view

		$start=$this->input->post("start");//0
		$length=$this->input->post("length");//10
		$order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
		$sort = $this->input->post("order[0][dir]"); // asc
		$cari_data = $this->input->post("search[value]");
		
		
		if(empty($cari_data))
		{
			$datauker = $this->M_master->GetData_SPK();
			$total = $this->M_master->CountData_SPK();
		}else{
			$datauker = $this->M_master->GetData_SPK($cari_data);
			$total = $this->M_master->CountData_SPK($cari_data);
		}
		
		

		//var_dump($datauker);die();
		//var_dump($total);die();

		$array_data =array();

		$no=$start+1;
		foreach ($datauker as $key) {
			
			$data["No"]=$no;
	        $data["No SPK"]=$key->no_spk;
	        $data["Provider"]=$key->nama_provider;
	        $data["Date"]=$key->tanggal_spk;
	        $data["Due Date"]=$key->jatuh_tempo;
	        $data["SPK Type"]=$key->jenis_spk;
	        $data["Project"]=$key->nama_project;

			array_push($array_data,$data);
			$no++;

		}


		//settingan terpenting dari datatable

		$output=array(

			"draw"=>intval($this->input->post("draw")),
			"recordsTotal"=>intval($total),
			"recordsFiltered"=>intval($total),
			"data"=>$array_data
		);

		echo json_encode($output);
	}


	function Alarm()
	{
		$data['type_alarm'] = $this->db->select('*')->from('tb_alarm_type')->get()->result();
		$data['page'] = 'alarm';
		$data['title'] = 'List Alarm';
		$this->template->views('List/list_alarm',$data);
	}

	function GetAlarm()
	{
		$columns = array("No","Site Id","Remote Name","Remote Type","Region","Main Branch","Branch Code","IP Address","Priority","Provider","Network Type","Current Type","Ack Time","Acked By","Alarm Start","Alarm End","Action"); // data array columns harus sama dengan data header table yang tadi di buat di view

		$start=$this->input->post("start");//0
		$length=$this->input->post("length");//10
		$order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
		$sort = $this->input->post("order[0][dir]"); // asc
		$cari_data = $this->input->post("search[value]");
		
		
		if(empty($cari_data))
		{
			$datauker = $this->M_master->GetData_Alarm($start,$length,'');
			$total = $this->M_master->CountData_Alarm();
		}else{
			$datauker = $this->M_master->GetData_Alarm($start,$length,$cari_data);
			$total = $this->M_master->CountData_Alarm($cari_data);
		}
		
		

		//var_dump($datauker);die();
		//var_dump($total);die();

		$array_data =array();

		$no=$start+1;
		foreach ($datauker as $key) {
			
			$data["No"]=$no;
	        $data["Site Id"]=$key->kode_jarkom;
	        $data["Remote Name"]=$key->remote_name;
	        $data["Remote Type"]=$key->remote_type;
	        $data["Region"]=$key->region;
	        $data["Main Branch"]=$key->main_branch;
	        $data["Branch Code"]=$key->branch_code;
	        $data["IP Address"]=$key->ip_address;

	        if ($key->priority == 'HIGH') {
	        	$data["Priority"]='<span class="label label-danger">'.$key->priority.'</span>';
	        }else if($key->priority == 'MEDIUM'){
	        	$data["Priority"]='<span class="label label-warning">'.$key->priority.'</span>';
	        }else{
	        	$data["Priority"]='<span class="label" style="background-color:#ffd11a">'.$key->priority.'</span>';
	        }

	        if ( in_array($key->current_state, array(1,2)) ) {
	        	$data["Current Type"]='<span class="label label-danger">Active,Unack</span>';
	        }else if( in_array($key->current_state, array(3,4)) ){
	        	$data["Current Type"]='<span class="label label-warning">Active,Ack</span>';
	        }else if( $key->current_state == 9 ){
	        	$data["Current Type"]='<span class="label label-default">Cleared,Unack</span>';
	        }else if( $key->current_state == 10 ){
	        	$data["Current Type"]='<span class="label label-default">CLeared,Ack</span>';
	        }
	        
	        $data["Provider"]=$key->provider;
	        $data["Network Type"]=$key->jenis_jarkom;
	        $data["Ack Time"]=$key->ack_at;
	        $data["Acked By"]=$key->user_acked;
	        $data["Alarm Start"]=$key->start_at;
	        $data["Alarm End"]=$key->stop_at;
	        //$data["Action"]="";
	        if ($key->current_state == 9 || $key->current_state == 10) {
	        	$data["Action"]='<div class="input-group-btn">
					                  <button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
					                    <span class="fa fa-caret-down"></span></button>
					                  <ul class="dropdown-menu">
					                    <li><a>Ack</a></li>
					                    <li><button class="button hover" style="background-color: Transparent;border: none;color:#777777">Edit Alarm</button></li>
					                  </ul>
					                </div>';
	        }else{
		        if ($key->id_jarkom == '') {
		        	$data["Action"]='<div class="input-group-btn">
					                  <button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
					                    <span class="fa fa-caret-down"></span></button>
					                  <ul class="dropdown-menu">
					                    <li><a href="'.base_url().'index.php/Master/ActionAck/'.$key->current_state.'/'.$key->id.'/R/'.$key->id_remote.'">Ack</a></li>
					                    <li><button class="button hover" style="background-color: Transparent;border: none;color:#777777" data-toggle="modal" data-target="#modal-default" onclick="GetAlarm('.$key->id.')">Edit Alarm</button></li>
					                    <!--<li><a href="#">Clear</a></li>-->
					                  </ul>
					                </div>';
		        }else{
			    	$data["Action"]='<div class="input-group-btn">
					                  <button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
					                    <span class="fa fa-caret-down"></span></button>
					                  <ul class="dropdown-menu">
					                    <li><a href="'.base_url().'index.php/Master/ActionAck/'.$key->current_state.'/'.$key->id.'/N/'.$key->id_jarkom.'">Ack</a></li>
					                    <li><button class="button hover" style="background-color: Transparent;border: none;color:#777777" data-toggle="modal" data-target="#modal-default"  onclick="GetAlarm('.$key->id.')">Edit Alarm</button></li>
					                    <!--<li><a href="#">Clear</a></li>-->
					                  </ul>
					                </div>';   
		        }
		    	}
			array_push($array_data,$data);
			$no++;

		}


		//settingan terpenting dari datatable

		$output=array(

			"draw"=>intval($this->input->post("draw")),
			"recordsTotal"=>intval($total),
			"recordsFiltered"=>intval($total),
			"data"=>$array_data
		);

		echo json_encode($output);
	}

	function ActionAck()
	{
		$action = $this->uri->segment(3);
		$id_alarm = $this->uri->segment(4);
		$kategori = $this->uri->segment(5);
		$id = $this->uri->segment(6);

		if ($action == 1) {

			$cek = $this->db->select('user_acked,ack_at')->from('tb_alarm')->where('id',$id_alarm)->get()->result();

			if (empty($cek[0]->user_acked) && empty($cek[0]->ack_at)) {
				$data = array(
					'user_acked' 	=> $this->session->userdata('username'),
					'ack_at'   		=> date('Y-m-d H:i:s'),
					'current_state' => 3
				);

				$this->db->where('id',$id_alarm);
		        $this->db->update('tb_alarm',$data);
			}	

	        if ($kategori=='R') {
	        	$this->db->set('status_alarm',3);
		        $this->db->where('id_remote',$id);
		        $this->db->update('tb_remote');
	        }else if($kategori=='N'){
	        	$this->db->set('status_alarm',3);
		        $this->db->where('id',$id);
		        $this->db->update('tb_jarkom');
	        }

		}

		$data['type_alarm'] = $this->db->select('*')->from('tb_alarm_type')->get()->result();
		$data['page'] = 'alarm';
		$data['title'] = 'List Alarm';
		$this->template->views('List/list_alarm',$data);
	}

	function Getdata_Alarm()
	{
		$id = $_POST['id'];
		$cek = $this->db->select('user_acked,ack_at')->from('tb_alarm')->where('id',$id)->get()->result();

		if (empty($cek[0]->user_acked) && empty($cek[0]->ack_at)) {
			$data = array(
				'user_acked' 	=> $this->session->userdata('username'),
				'ack_at'   		=> date('Y-m-d H:i:s'),
				'current_state' => 3
			);

			$this->db->where('id',$id);
			$this->db->update('tb_alarm',$data);
		}

		$data = $this->M_master->GetAlarm($id);
		$data[0]->notes = $this->M_master->GetNote($id);
		echo json_encode($data[0]);
	}

	function SaveAlarm()
	{
		$id = $_POST['id_alarm'];
		$alarm_type = $_POST['alarm_type'];

		$dataalarm = $this->db->select('*')->from('tb_alarm')->where('id',$id)->get()->result();

		if ($alarm_type>0) {
			$return = $this->db->set('id_alarm_type',$alarm_type)->set('current_state',4)->where('id',$id)->update('tb_alarm');
			if ($dataalarm[0]->id_jarkom!='') {
	        	$this->db->set('status_alarm',4);
		        $this->db->where('id',$dataalarm[0]->id_jarkom);
				$this->db->update('tb_jarkom');
	        }else{
				$this->db->set('status_alarm',4);
		        $this->db->where('id_remote',$dataalarm[0]->id_remote);
		        $this->db->update('tb_remote');
	        }
		}else{
			$return = true;
		}
		

		if ($return) {
			$return = true;
		}else{
			$return = false;
		}

		echo $return;
	}

	function SaveNoteAlarm()
	{
		$id = $_POST['id_alarm'];
		$note = $_POST['note'];
        $data = array(
        		'id'			  => '',
				'id_alarm'	  	  => $id,
				'notes'			  => $note,
				'create_at'   	  => date('Y-m-d H:i:s'),
				'user_create'	  => $this->session->userdata('username')
				
			);

		$return = $this->db->insert('tb_alarm_notes', $data);

		if ($return) {
			$return = true;
		}else{
			$return = false;
		}

		echo $return;
	}

}

?>