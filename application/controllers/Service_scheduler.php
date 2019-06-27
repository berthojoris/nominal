<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_scheduler extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_scheduler'));
		
		//$this->load->helper('form');
        //$this->load->library('session');
		//if ($this->session->userdata('username')==null) {
         //   redirect('login');
       // }
	}
	
	public function remote_count(){
		$kanwil = $this->m_scheduler->get_kanwil();
		foreach($kanwil as $key => $value_kanwil){
			$type_remote = $this->m_scheduler->get_type_remote();
			$data = array();
			$online = 0;
			$offline = 0;
			$nop = 0;
			$percentage_online=0;
			foreach($type_remote as $key => $value_type_remote){
				
				${$value_type_remote->singkatan.'_on'}  = $this->m_scheduler->get_online(3,$value_kanwil->kode_kanwil,$value_type_remote->kode_tipe_uker);
				${$value_type_remote->singkatan.'_off'} = $this->m_scheduler->get_offline(1,$value_kanwil->kode_kanwil,$value_type_remote->kode_tipe_uker);
				${$value_type_remote->singkatan.'_nop'} = $this->m_scheduler->get_nop(1,$value_kanwil->kode_kanwil,$value_type_remote->kode_tipe_uker);
				
				$online = $online + ${$value_type_remote->singkatan.'_on'};
				$offline = $offline + ${$value_type_remote->singkatan.'_off'};
				$nop = $nop + ${$value_type_remote->singkatan.'_nop'};
				
				$data[$value_type_remote->singkatan.'_on'] = ${$value_type_remote->singkatan.'_on'};
				$data[$value_type_remote->singkatan.'_off'] = ${$value_type_remote->singkatan.'_off'};
				$data[$value_type_remote->singkatan.'_nop'] = ${$value_type_remote->singkatan.'_nop'};
				$data['total_on'] = $online;
				$data['total_off'] = $offline;
				$data['total_nop'] = $nop;
				//echo $data['total_on'];
				//$data['percentage_online'] = $data['total_on']*100/$data['total_on'];
				$data['pdate']=date("Y-m-d H:i:s");
				
				
			}
			var_dump($data);
			$data['percentage_online'] = number_format($online*100/($online + $offline),2);
			
			
			$this->m_scheduler->set_dashboard($value_kanwil->kode_kanwil,$data);
		}
		
		//var_dump($data);
		//var_dump($value_kanwil->kode_kanwil);
		//$count = $this->m_scheduler->get_online($status,$region,$type_remote);
		
		//echo $count;
	}


	public function remote_count_history(){
		$date = date("Y-m-d H:i").":00";
		$this->m_scheduler->insert_history_dashboard($date);
		
	}
	
}

