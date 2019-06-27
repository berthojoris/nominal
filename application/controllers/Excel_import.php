<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_excel_import');
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
}

?>