<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_excel_import');
		$this->load->model('M_master');
		$this->load->library('excel');
		$this->load->helper(array('url','download'));
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

	function Download_Format(){				
		force_download('FileDownload/FormatRemote.xlsx',NULL);
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
			$datauker = $this->M_master->GetData_Project($start,$length,'');
			$total = $this->M_master->CountData_Project();
		}else{
			$datauker = $this->M_master->GetData_Project($start,$length,$cari_data);
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

	function GetProject()
	{
		$project = $_GET["id_project"];

		$output = array();

		$spk = $this->db->select('*')->from('tb_project')->like('nama_project',$project)->limit(10)->get()->result();

		foreach ($spk as $s) {
			$data['id'] = $s->id_project;
	        $data['text'] = $s->nama_project;
	        array_push($output, $data);
		}

		if (! empty($output)) {
			// Encode ke format JSON.
			echo json_encode($output);
			//var_dump($output);
		}
	}

	function SaveProject()
	{

		if(isset($_POST['nama_project'])) {

	        $data = array(
	        	'nama_project'  => $_POST['nama_project'],
	        	'keterangan' 	=> $_POST['keterangan'],
	        	'id_project'   	=> '',
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
		$data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('nama_provider','asc')->get()->result();
		$data['project'] = $this->db->select('*')->from('tb_project')->order_by('nama_project','asc')->get()->result();
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
			$datauker = $this->M_master->GetData_SPK($start,$length,'');
			$total = $this->M_master->CountData_SPK();
		}else{
			$datauker = $this->M_master->GetData_SPK($start,$length,$cari_data);
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

	function SaveSPK()
	{

		if(isset($_POST['no_spk'])) {
			$no_spk_perpanjangan = '';
			if (isset($_POST['no_spk_perpanjangan'])) {
				$no_spk_perpanjangan = $_POST['no_spk_perpanjangan'];
			}
	        $data = array(
	        	'no_spk'  				=> $_POST['no_spk'],
	        	'jenis_spk'  			=> $_POST['jenis_spk'],
	        	'id_project' 			=> $_POST['id_project'],
	        	'kode_provider' 		=> $_POST['kode_provider'],
	        	'tanggal_spk' 			=> $_POST['tanggal_spk'],
	        	'jatuh_tempo'   		=> $_POST['jatuh_tempo'],
	        	'no_spk_perpanjangan' 	=> $no_spk_perpanjangan,
	        	'user_create'			=> $this->session->userdata('id_user'),
	        	'create_at'				=> date('d-m-Y H:i:s'),
	        	'id_spk'   				=> '',
	        );

	        //print_r($data);die();

	        $return = $this->db->insert('tb_spk',$data);
	        if ($return) {
	        	$return = true;
	        }else{
	        	$return = false;
			}
	    }

	    echo json_encode($return);
	}

	function SaveNet()
	{
		//$kode_jarkom = $this->m_dashboard->get_id_last_jarkom();
		if ($_POST['kode_jenis_jarkom']!=1) {
			$_POST['brisat'] = 0;
		}
		//var_dump($kode_jarkom);die();
        $data = array(
        	'id_remote'   		=> $_POST['remote'],
        	'kode_jarkom'  		=> $_POST['kode_jarkom'],
        	'keterangan'    	=> $_POST['keterangan'],
        	'kode_provider' 	=> $_POST['kode_provider'],
        	'kode_jenis_jarkom' => $_POST['kode_jenis_jarkom'],
        	'ip_wan'   	    	=> $_POST['ip_wan'],
        	'bandwidth'   		=> $_POST['bandwidth'],
        	'brisat'  			=> $_POST['brisat'],
        	'id_spk'   			=> 1,
        	'used_status'  		=> 1
        );

        var_dump($data);
        $return = $this->db->insert('tb_jarkom', $data);
        if ($return) {
        	$return = $this->db->insert('tb_jarkom_history', $data);
        	if ($return) {
        		$return = true;
        	}else{
        		$return = false;
        	}
        }else{
        	$return = false;
		}

        echo json_encode($return);
	}

	function GetRemote()
	{
		$nama_remote = $_GET["nama_remote"];

		$output = array();

		$remote = $this->db->select('*')->from('tb_remote')->like('nama_remote',$nama_remote)->limit(10)->get()->result();

		foreach ($remote as $r) {
			$data['id'] = $r->id_remote;
	        $data['text'] = $r->nama_remote;
	        array_push($output, $data);
		}

		if (! empty($output)) {
			// Encode ke format JSON.
			echo json_encode($output);
			//var_dump($output);
		}
	}

	function GetSpk()
	{
		$spk = $_GET["spk"];

		$output = array();

		$spk = $this->db->select('*')->from('tb_spk')->like('no_spk',$spk)->limit(10)->get()->result();

		foreach ($spk as $s) {
			$data['id'] = $s->id_spk;
	        $data['text'] = $s->no_spk;
	        array_push($output, $data);
		}

		if (! empty($output)) {
			// Encode ke format JSON.
			echo json_encode($output);
			//var_dump($output);
		}
	}



	function Remote()
	{

		$data['kanca'] = $this->db->select('*')->from('tb_kanca')->order_by('nama_kanca','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
        $data['tipe_uker'] = $this->db->select('*')->from('tb_tipe_uker')->order_by('kode_tipe_uker','asc')->get()->result();

        $data['page'] = 'remote';
        $data['title'] = 'Remote List';

		$this->template->views('List/list_remote',$data);
	}

	function Network()
	{
        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
        $data['remote'] = $this->db->select('*')->from('tb_remote')->limit(10)->order_by('nama_remote','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
		$data['page'] = 'jarkom';
		$data['title'] = 'Network List';
		$this->template->views('List/new_list_allprov',$data);
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
		
		
		if ($this->session->userdata('role')==10) {
			$kode_provider = $this->session->userdata('provider');
			if(empty($cari_data))
			{
				$datauker = $this->M_master->GetData_AlarmProv($kode_provider,$start,$length,'');
				$total = $this->M_master->CountData_AlarmProv($kode_provider,'');
			}else{
				$datauker = $this->M_master->GetData_AlarmProv($kode_provider,$start,$length,$cari_data);
				$total = $this->M_master->CountData_AlarmProv($kode_provider,$cari_data);
			}
		}else{
			if(empty($cari_data))
			{
				$datauker = $this->M_master->GetData_Alarm($start,$length,'');
				$total = $this->M_master->CountData_Alarm();
			}else{
				$datauker = $this->M_master->GetData_Alarm($start,$length,$cari_data);
				$total = $this->M_master->CountData_Alarm($cari_data);
			}
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

	        if ( in_array($key->current_state, array(1,2,3)) ) {
	        	$data["Current Type"]='<span class="label label-danger">Active,Unack</span>';
	        }else if( in_array($key->current_state, array(4)) ){
	        	$data["Current Type"]='<span class="label label-warning">Active,Ack</span>';
	        }else if( $key->current_state == 9 ){
	        	$data["Current Type"]='<span class="label label-primary">Cleared,Unack</span>';
	        }else if( $key->current_state == 10 ){
	        	$data["Current Type"]='<span class="label label-primary">CLeared,Ack</span>';
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
					                    <!-- <li><a>Ack</a></li> -->
					                    <li><button class="button hover" style="background-color: Transparent;border: none;color:#777777">Edit Alarm</button></li>
					                    <li><button class="button hover" style="background-color: Transparent;border: none;color:#777777"  data-toggle="modal" data-target="#detail_alarm" onclick="DetailAlarm('.$key->id.')">
		                                Detail Alarm
		                              </button></li>
					                  </ul>
					                </div>';
	        }else{
				if ($key->id_jarkom == '') {
		        	$data["Action"]='<div class="input-group-btn">
					                  <button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
					                    <span class="fa fa-caret-down"></span></button>
					                  <ul class="dropdown-menu">
					                    <!--<li><a href="'.base_url().'index.php/Master/ActionAck/'.$key->current_state.'/'.$key->id.'/R/'.$key->id_remote.'">Ack</a></li>
					                    <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" onclick="ActionAck('."'".base_url().'index.php/Master/ActionAck/'.$key->current_state.'/'.$key->id.'/R/'.$key->id_remote."'".')">Ack</button></li>-->
					                    <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" data-toggle="modal" data-target="#modal-default" onclick="GetAlarm('.$key->id.')">Edit Alarm</button></li>
					                    <li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left"  data-toggle="modal" data-target="#detail_alarm" onclick="DetailAlarm('.$key->id.')">
		                                Detail Alarm
		                              </button></li>
					                    <!--<li><a href="#">Clear</a></li>-->
					                  </ul>
					                </div>';
		        }else{
					$data["Action"]='<div class="input-group-btn">
										<button type="button" class="btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Action
											<span class="fa fa-caret-down"></span></button>
										<ul class="dropdown-menu">
											<!--<li><a href="'.base_url().'index.php/Master/ActionAck/'.$key->current_state.'/'.$key->id.'/N/'.$key->id_jarkom.'">Ack</a></li>
											<li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" onclick="ActionAck('."'".base_url().'index.php/Master/ActionAck/'.$key->current_state.'/'.$key->id.'/N/'.$key->id_jarkom."'".')">Ack</button></li>-->
											<li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left" data-toggle="modal" data-target="#modal-default"  onclick="GetAlarm('.$key->id.')">Edit Alarm</button></li>
											<li><button style="background-color: Transparent;border: none;color:#777777;width: 100%;text-align:left"  data-toggle="modal" data-target="#detail_alarm" onclick="DetailAlarm('.$key->id.')">
														Detail Alarm
													</button></li>
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

	function GetAlarmRemote()
	{
		$id_remote = $this->uri->segment(3);
		$columns = array("No","Site Id"/*,"Remote Name","Remote Type","Region","Main Branch","Branch Code"*/,"Last Note","Alarm Type","Provider","Network Type","Current Type","Ack Time","Acked By","Alarm Start","Alarm End"); // data array columns harus sama dengan data header table yang tadi di buat di view

		$start=$this->input->post("start");//0
		$length=$this->input->post("length");//10
		$order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
		$sort = $this->input->post("order[0][dir]"); // asc
		$cari_data = $this->input->post("search[value]");
		
		
		if(empty($cari_data))
		{
			$datauker = $this->M_master->GetData_AlarmRemote($id_remote,$start,$length,'');
			$total = $this->M_master->CountData_AlarmRemote($id_remote,'');
		}else{
			$datauker = $this->M_master->GetData_AlarmRemote($id_remote,$start,$length,$cari_data);
			$total = $this->M_master->CountData_AlarmRemote($id_remote,$cari_data);
		}
		
		

		//var_dump($datauker);die();
		//var_dump($total);die();

		$array_data =array();

		$no=$start+1;
		foreach ($datauker as $key) {
			
			$data["No"]=$no;
	        $data["Site Id"]=$key->id;
	        $data["Remote Name"]=$key->remote_name;
	        $data["Remote Type"]=$key->remote_type;
	        $data["Region"]=$key->region;
	        $data["Main Branch"]=$key->main_branch;
	        $data["Branch Code"]=$key->branch_code;
	        $data["IP Address"]=$key->ip_address;
	        $data["Alarm Type"]=$key->alarm_type;
	        $data["Last Note"]=$key->last_note;

	      	if ($key->priority == 'HIGH') {
	        	$data["Priority"]='<span class="label label-danger">'.$key->priority.'</span>';
	        }else if($key->priority == 'MEDIUM'){
	        	$data["Priority"]='<span class="label label-warning">'.$key->priority.'</span>';
	        }else{
	        	$data["Priority"]='<span class="label" style="background-color:#ffd11a">'.$key->priority.'</span>';
	        }

	        if ( in_array($key->current_state, array(1,2,3)) ) {
	        	$data["Current Type"]='<span class="label label-danger">Active,Unack</span>';
	        }else if( in_array($key->current_state, array(4)) ){
	        	$data["Current Type"]='<span class="label label-warning">Active,Ack</span>';
	        }else if( $key->current_state == 9 ){
	        	$data["Current Type"]='<span class="label label-primary">Cleared,Unack</span>';
	        }else if( $key->current_state == 10 ){
	        	$data["Current Type"]='<span class="label label-primary">CLeared,Ack</span>';
	        }
	        
	        $data["Provider"]=$key->provider;
	        $data["Network Type"]=$key->jenis_jarkom;
	        $data["Ack Time"]=$key->ack_at;
	        $data["Acked By"]=$key->user_acked;
	        $data["Alarm Start"]=$key->start_at;
	        $data["Alarm End"]=$key->stop_at;
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

	function GetAlarmJarkom()
	{
		$id_jarkom = $this->uri->segment(3);
		$columns = array("No","Site Id"/*,"Remote Name","Remote Type","Region","Main Branch","Branch Code","IP Address","Priority"*/,"Last Note","Alarm Type","Provider","Network Type","Current Type","Ack Time","Acked By","Alarm Start","Alarm End"); // data array columns harus sama dengan data header table yang tadi di buat di view

		$start=$this->input->post("start");//0
		$length=$this->input->post("length");//10
		$order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
		$sort = $this->input->post("order[0][dir]"); // asc
		$cari_data = $this->input->post("search[value]");
		
		
		if(empty($cari_data))
		{
			$datauker = $this->M_master->GetData_AlarmJarkom($id_jarkom,$start,$length,'');
			$total = $this->M_master->CountData_AlarmJarkom($id_jarkom,'');
		}else{
			$datauker = $this->M_master->GetData_AlarmJarkom($id_jarkom,$start,$length,$cari_data);
			$total = $this->M_master->CountData_AlarmJarkom($id_jarkom,$cari_data);
		}
		
		

		//var_dump($datauker);die();
		//var_dump($total);die();

		$array_data =array();

		$no=$start+1;
		foreach ($datauker as $key) {
			
			$data["No"]=$no;
	        $data["Site Id"]=$key->id;
	        $data["Remote Name"]=$key->remote_name;
	        $data["Remote Type"]=$key->remote_type;
	        $data["Region"]=$key->region;
	        $data["Main Branch"]=$key->main_branch;
	        $data["Branch Code"]=$key->branch_code;
	        $data["IP Address"]=$key->ip_address;
	        $data["Alarm Type"]=$key->alarm_type;
	        $data["Last Note"]=$key->last_note;

	      	if ($key->priority == 'HIGH') {
	        	$data["Priority"]='<span class="label label-danger">'.$key->priority.'</span>';
	        }else if($key->priority == 'MEDIUM'){
	        	$data["Priority"]='<span class="label label-warning">'.$key->priority.'</span>';
	        }else{
	        	$data["Priority"]='<span class="label" style="background-color:#ffd11a">'.$key->priority.'</span>';
	        }

	        if ( in_array($key->current_state, array(1,2,3)) ) {
	        	$data["Current Type"]='<span class="label label-danger">Active,Unack</span>';
	        }else if( in_array($key->current_state, array(4)) ){
	        	$data["Current Type"]='<span class="label label-warning">Active,Ack</span>';
	        }else if( $key->current_state == 9 ){
	        	$data["Current Type"]='<span class="label label-primary">Cleared,Unack</span>';
	        }else if( $key->current_state == 10 ){
	        	$data["Current Type"]='<span class="label label-primary">CLeared,Ack</span>';
	        }
	        
	        $data["Provider"]=$key->provider;
	        $data["Network Type"]=$key->jenis_jarkom;
	        $data["Ack Time"]=$key->ack_at;
	        $data["Acked By"]=$key->user_acked;
	        $data["Alarm Start"]=$key->start_at;
	        $data["Alarm End"]=$key->stop_at;
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
		$current_state = $this->uri->segment(3);
		$id_alarm = $this->uri->segment(4);
		$kategori = $this->uri->segment(5);
		$id = $this->uri->segment(6);

		$return = 0;

		if ($current_state == 2) {

			$cek = $this->db->select('*')->from('tb_alarm')->where('id',$id_alarm)->get()->result();

			if (empty($cek[0]->user_acked) && empty($cek[0]->ack_at)) {
				$data = array(
					'user_acked'			=> $this->session->userdata('username'),
					'ack_at'   	 			=> date('Y-m-d H:i:s'),
					'current_state'   		=> '3'
				);
				$return = $this->db->where('id',$id_alarm)->update('tb_alarm',$data);
				//echo $return;
			}		

			if ($kategori=='R') {
				$cek = $this->db->select('*')->from('tb_remote')->where('id_remote',$id)->get()->result();
				if ($cek[0]->status_l!=3) {
					$return = $this->db->set('status_alarm',3)->where('id_remote',$id)->update('tb_remote');
				}else{
					$return = 0;
					echo $return;
				}
				
			}else if($kategori=='N'){
				$cek = $this->db->select('*')->from('tb_jarkom')->where('id',$id)->get()->result();
				if ($cek[0]->status_l!=3) {
					$return = $this->db->set('status_alarm',3)->where('id',$id)->update('tb_jarkom');
				}else{
					$return = 0;
					echo $return;
				}
				
			}

			if ($return) {
				$return = 1;
			}else{
				$return = 0;
			}

			echo $return;

		}else{
			$return = 0;
			echo $return;
		}
	}

	function ActionAckByRemote()
	{
		$id_remote = $this->uri->segment(3);
		$status_alarm = $this->uri->segment(4);

		$cek = $this->db->select('*')->from('tb_alarm')
						->where('id_remote',$id_remote)
						->where('id_jarkom IS NULL',null)
						->where('current_state != ',9)
						->where('current_state != ',10)
						->order_by('start_at','desc')
						->limit(1)->get()->result();

		//echo $id_alarm;

		$return = 0;

		if ($cek[0]->current_state == 2) {

			if (empty($cek[0]->user_acked) && empty($cek[0]->ack_at)) {
				$data = array(
					'user_acked' 	  => $this->session->userdata('username'),
					'ack_at'   	 	  => date('Y-m-d H:i:s'),
					'current_state'   => '3'
				);
				$return = $this->db->where('id',$cek[0]->id)->update('tb_alarm',$data);
				//echo $return;
			}	

			
			$cek = $this->db->select('*')->from('tb_remote')->where('id_remote',$id_remote)->get()->result();

			if ($cek[0]->status_l!=3) {
				$return = $this->db->set('status_alarm',3)->where('id_remote',$id_remote)->update('tb_remote');
			}else{
				$return = 0;
				echo $return;
			}

			if ($return) {
				$return = 1;
			}else{
				$return = 0;
			}

			echo $return;

		}else{
			$return = 0;
			echo $return;
		}
	}

	function ActionAckByJarkom()
	{
		$id_jarkom = $this->uri->segment(3);
		$status_alarm = $this->uri->segment(4);

		$cek = $this->db->select('*')->from('tb_alarm')
						->where('id_jarkom',$id_jarkom)
						->where('current_state != ',9)
						->where('current_state != ',10)
						->order_by('start_at','desc')
						->limit(1)->get()->result();

		//echo $id_alarm;

		$return = 0;

		if ($cek[0]->current_state == 2) {

			if (empty($cek[0]->user_acked) && empty($cek[0]->ack_at)) {
				$data = array(
					'user_acked' 	  => $this->session->userdata('username'),
					'ack_at'   	 	  => date('Y-m-d H:i:s'),
					'current_state'   => '3'
				);
				$return = $this->db->where('id',$cek[0]->id)->update('tb_alarm',$data);
				//echo $return;
			}	

			$cek = $this->db->select('*')->from('tb_jarkom')->where('id',$id_jarkom)->get()->result();

			if ($cek[0]->status_l!=3) {
				$return = $this->db->set('status_alarm',3)->where('id',$id_jarkom)->update('tb_jarkom');
			}else{
				$return = 0;
				echo $return;
			}

			if ($return) {
				$return = 1;
			}else{
				$return = 0;
			}

			echo $return;

		}else{
			$return = 0;
			echo $return;
		}
	}

	function Getdata_Alarm()
	{
		$id = $_POST['id'];

		$cek = $this->db->select('*')->from('tb_alarm')
						->where('id',$id)
						->get()->result();

   //      $data = array(
			// 	// 'user_acked'	  => $this->session->userdata('username'),
			// 	// 'ack_at'   		  => date('Y-m-d H:i:s'),
			// 	'current_state'   => '3'
			// );

   //      if ($cek[0]->current_state > 4) {
			// $this->db->where('id',$id);
	  //       $this->db->update('tb_alarm',$data);
   //      }

		$data = $this->M_master->GetAlarm($id);

		if (empty($cek[0]->user_acked) && empty($cek[0]->ack_at)) {
			$data = array(
				// 'user_acked'			=> $this->session->userdata('username'),
				// 'ack_at'   	 			=> date('Y-m-d H:i:s'),
				'current_state'   		=> '3'
			);
			$return = $this->db->where('id',$id)->update('tb_alarm',$data);
			//echo $return;
		}

		if($cek[0]->id_jarkom){
			$this->db->set('status_alarm',3)->where('id',$cek[0]->id_jarkom)->update('tb_jarkom');
		}else{
			$this->db->set('status_alarm',3)->where('id_remote',$cek[0]->id_remote)->update('tb_remote');
		}

		$data = $this->M_master->GetAlarm($id);
		$data[0]->notes = $this->M_master->GetNote($id);
		echo json_encode($data[0]);
	}



	function Getdata_AlarmRemote()
	{
		$id_remote = $_POST['id'];

		$cek = $this->db->select('*')->from('tb_alarm')
						->where('id_remote',$id_remote)
						->where('id_jarkom IS NULL',null)
						->where('current_state != ',9)
						->where('current_state != ',10)
						->order_by('start_at','desc')
						->limit(1)->get()->result();
		$id = $cek[0]->id;

  //       $data = array(
		// 	// 'user_acked'	  => $this->session->userdata('username'),
		// 	// 'ack_at'   		  => date('Y-m-d H:i:s'),
		// 	'current_state'   => '3'
		// );

  //       if ($cek[0]->current_state > 4) {
		// 	$this->db->where('id',$id);
	 //        $this->db->update('tb_alarm',$data);
  //       }

		if (empty($cek[0]->user_acked) && empty($cek[0]->ack_at)) {
			$data = array(
				// 'user_acked' 	  => $this->session->userdata('username'),
				// 'ack_at'   	 	  => date('Y-m-d H:i:s'),
				'current_state'   => '3'
			);
			$return = $this->db->where('id',$cek[0]->id)->update('tb_alarm',$data);
			$this->db->set('status_alarm',3)->where('id_remote',$id_remote)->update('tb_remote');
			//echo $return;
		}

		$data = $this->M_master->GetAlarm($id);
		$data[0]->notes = $this->M_master->GetNote($id);
		echo json_encode($data[0]);
	}

	function Getdata_AlarmJarkom()
	{
		$id_jarkom = $_POST['id'];

		$cek = $this->db->select('*')->from('tb_alarm')
						->where('id_jarkom',$id_jarkom)
						->where('current_state != ',9)
						->where('current_state != ',10)
						->order_by('start_at','desc')
						->limit(1)->get()->result();
		$id = $cek[0]->id;

  //       $data = array(
		// 	// 'user_acked'	  => $this->session->userdata('username'),
		// 	// 'ack_at'   		  => date('Y-m-d H:i:s'),
		// 	'current_state'   => '3'
		// );

  //       if ($cek[0]->current_state > 4) {
		// 	$this->db->where('id',$id);
	 //        $this->db->update('tb_alarm',$data);
  //       }

		if (empty($cek[0]->user_acked) && empty($cek[0]->ack_at)) {
			$data = array(
				// 'user_acked' 	  => $this->session->userdata('username'),
				// 'ack_at'   	 	  => date('Y-m-d H:i:s'),
				'current_state'   => '3'
			);
			$return = $this->db->where('id',$cek[0]->id)->update('tb_alarm',$data);
			$this->db->set('status_alarm',3)->where('id',$id_jarkom)->update('tb_jarkom');
			//echo $return;
		}

		$data = $this->M_master->GetAlarm($id);
		$data[0]->notes = $this->M_master->GetNote($id);
		echo json_encode($data[0]);
	}

	function Detail_Alarm()
	{
		$id = $_POST['id'];
		$data = $this->M_master->GetAlarm($id);
		echo json_encode($data[0]);
	}

	function DetailAlarmById()
	{
		$id = $_POST['id'];
		$kode = $_POST['kode'];
		$data = $this->M_master->GetAlarmById($id,$kode);
		echo json_encode($data[0]);
	}

	function SaveAlarm()
	{
		$id_alarm = $_POST['id_alarm'];
		$alarm_type = $_POST['alarm_type'];
		
		if ($alarm_type>=0) {

			$cek = $this->db->select('*')->from('tb_alarm')->where('id',$id_alarm)->get()->result();

			if ($cek[0]->current_state <9) {

				$data = array(
					'user_acked'			=> $this->session->userdata('username'),
					'ack_at'   	 			=> date('Y-m-d H:i:s'),
					'id_alarm_type'   	 	=> $alarm_type,
					'current_state'   		=> 4
				);

				$return = $this->db->where('id',$id_alarm)->update('tb_alarm',$data);

				//$return = $this->db->set('id_alarm_type',$alarm_type)->set('current_state',4)->where('id',$id_alarm)->update('tb_alarm');

				if($cek[0]->id_jarkom){
					$this->db->set('id_alarm_type',$alarm_type)->set('status_alarm',4)->where('id',$cek[0]->id_jarkom)->update('tb_jarkom');
				}else{
					$this->db->set('id_alarm_type',$alarm_type)->set('status_alarm',4)->where('id_remote',$cek[0]->id_remote)->update('tb_remote');
				}
			}	

		}else{
			$return = false;
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

		$cek = $this->db->select('*')->from('tb_alarm')->where('id',$id)->get()->result();

		if ($cek[0]->current_state <9) {
			if($cek[0]->id_jarkom){
				$this->db->set('notes_alarm',"[".date('Y-m-d H:i:s')."] ".$note)->where('id',$cek[0]->id_jarkom)->update('tb_jarkom');
				$this->db->set('last_note',"[".date('Y-m-d H:i:s')."] ".$note)->where('id',$id)->update('tb_alarm');
			}else{
				$this->db->set('notes_alarm',"[".date('Y-m-d H:i:s')."] ".$note)->where('id_remote',$cek[0]->id_remote)->update('tb_remote');
				$this->db->set('last_note',"[".date('Y-m-d H:i:s')."] ".$note)->where('id',$id)->update('tb_alarm');
			}
		}

		if ($return) {
			$return = true;
		}else{
			$return = false;
		}

		echo $return;
	}


}

?>