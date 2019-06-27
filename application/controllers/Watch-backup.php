<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Watch extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_watch','m_dashboard'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		//$data['page'] = 'home';
		//$this->template->views('home',$data);
		//redirect('Dashboard/All_Kanwil');
		if ($this->session->userdata('role')==10) {
            redirect('Dashboard/Dash_Prov');
        }else{
			redirect('Dashboard/All_Kanwil');
		}
	}

	function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

	function main_branch()
	{

		$data['page'] = 'main-branch-watch';
		$data['title'] = 'Main And Sub Branch Watch';
		
		$data['watch_1'] = 'KC';
		$data['watch_2'] = 'KCP';
		$main_branches = $this->m_watch->get_main_branch('2');
		$data['main_branch']= $main_branches;
		for ($i=0; $i < count($main_branches) ; $i++) { 
			$remote = $main_branches[$i];
			$data['jarkom_main_branch'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		$submain_branches = $this->m_watch->get_main_branch('3');
		$data['submain_branch']= $submain_branches;
		for ($i=0; $i < count($submain_branches) ; $i++) { 
			$remote = $submain_branches[$i];
			$data['jarkom_submain_branch'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		
		$this->template->views('reporting/main_branch_watch',$data);
	}
	
	function priority_atm()
	{
		$data['page']  = 'atm-priority';
		$data['title'] = 'Priority ATM Watch';
		
		$priority_atm = $this->m_watch->get_priority_atm('7');
		$data['priority_atm']= $priority_atm;
		for ($i=0; $i < count($priority_atm) ; $i++) { 
			$remote = $priority_atm[$i];
			$data['jarkom_priority_atm'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		for ($i=0; $i < count($priority_atm) ; $i++) { 
			$remote = $priority_atm[$i];
			$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->getTid($remote->id_remote);			
		}
		
		$this->template->views('reporting/priority_atm',$data);
	}
	
	
	function sub_branch()
	{

		$data['page'] = 'sub-watch';
		$data['title'] = 'Sub and Small Branch Watch';

		$data['watch_1'] = 'Unit';
		$data['watch_2'] = 'KK';
		$main_branches = $this->m_watch->get_sub_branch('4');
		$data['main_branch']= $main_branches;
		for ($i=0; $i < count($main_branches) ; $i++) { 
			$remote = $main_branches[$i];
			$data['jarkom_main_branch'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		$submain_branches = $this->m_watch->get_sub_branch('5');
		$data['submain_branch']= $submain_branches;
		for ($i=0; $i < count($submain_branches) ; $i++) { 
			$remote = $submain_branches[$i];
			$data['jarkom_submain_branch'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		
		$this->template->views('reporting/sub_branch_watch',$data);
	}
	
	
	function dashboard_down()
	{

		$data['page'] = 'alarm-watch';
		$data['title'] = 'Alarm Watch';
	
		$now = date('Y-m-d H:i:s');
		$now_int = strtotime($now);		

		$data['total_remote_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->get()->result());

		$data['total_remote_offline_less_1_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					->get()->result());
		
		$data['total_remote_offline_1_4_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					->get()->result());					
		
		$data['total_remote_offline_4_12_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					->get()->result());					
		
		$data['total_remote_offline_12_24_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					->get()->result());	
					
		$data['total_remote_offline_1_5_day'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());	

		$data['total_remote_offline_more_5_day'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());
		
		$data['total_remote_nop'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('kode_op_asli','2')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());	
		
		
		$data['total_remote_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm>','0')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_unack_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm','2')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_ack_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm','3')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_ack_alarm_define'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm','4')
					->where('status_name<>','NOP')
					->get()->result());
					
		$data['total_network_alarm'] = count($this->db->select('id_jarkom')
					->from('v_all_remote_jarkom')
					->where('status_alarm>','0')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_network_unack_alarm'] = count($this->db->select('id_jarkom')
					->from('v_all_remote_jarkom')
					->where('status_alarm','2')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_network_ack_alarm'] = count($this->db->select('id_jarkom')
					->from('v_all_remote_jarkom')
					->where('status_alarm','3')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_network_unack_alarm_define'] = count($this->db->select('id_jarkom')
					->from('v_all_remote_jarkom')
					->where('status_alarm','4')
					->where('status_name<>','NOP')
					->get()->result()); 
		
		
		
		

		
		//var_dump($data);
		
		
		$this->template->views('watch/offline',$data);
	}


	function ListDown()
	{

		$data['page'] = 'alarm-watch';
		$data['title'] = 'List Alarm Watch';
	
		$now = date('Y-m-d H:i:s');
		$now_int = strtotime($now);		

		if($this->uri->segment(3) == 'total_remote_offline'){
			$data['data'] = $this->db->select('*')
						->from('v_all_remote')
						->where('status_name','OFFLINE')
						->get()->result();
			$data['judul'] = 'Remote Offline';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_less_1_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					->get()->result();
			$data['judul'] = 'Remote Offline Less 1 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_1_4_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					->get()->result();
			$data['judul'] = 'Remote Offline 1-4 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_4_12_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					->get()->result();
			$data['judul'] = 'Remote Offline 4-12 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_12_24_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					->get()->result();	
			$data['judul'] = 'Remote Offline 12-24 Hours';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_1_5_day') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();
			$data['judul'] = 'Remote Offline 1-5 Days';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_more_5_day') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();	
			$data['judul'] = 'Remote Offline More 5 Days';
			
		}

		

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
		}
		
		
		$this->template->views('watch/list_remote_down',$data);
	}


	function ExcelListDown()
	{

		$data['page'] = 'alarm-watch';
		$data['title'] = 'List Alarm Watch';
	
		$now = date('Y-m-d H:i:s');
		$now_int = strtotime($now);		

		if($this->uri->segment(3) == 'total_remote_offline'){
			$data['data'] = $this->db->select('*')
						->from('v_all_remote')
						->where('status_name','OFFLINE')
						->get()->result();
			$data['judul'] = 'Remote Offline';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_less_1_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					->get()->result();
			$data['judul'] = 'Remote Offline Less 1 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_1_4_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					->get()->result();
			$data['judul'] = 'Remote Offline 1-4 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_4_12_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					->get()->result();
			$data['judul'] = 'Remote Offline 4-12 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_12_24_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					->get()->result();	
			$data['judul'] = 'Remote Offline 12-24 Hours';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_1_5_day') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();
			$data['judul'] = 'Remote Offline 1-5 Days';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_more_5_day') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();	
			$data['judul'] = 'Remote Offline More 5 Days';
			
		}

		

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
		}
		
		
		$this->load->view('watch/excel_watch',$data);
	}
	
	
	function maps_dasboard(){
		
		
		$data['page'] = 'maps-dashboard';
		$data['title'] = 'Maps & Offline Dashboard';
	
	
	
		$now = date('Y-m-d H:i:s');
		$now_int = strtotime($now);		

		$data['total_remote_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->get()->result());
		
		$data['total_remote_nop'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('kode_op_asli','2')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());	
		
		$data['total_kc_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KC')
					->get()->result());
					
		$data['total_kcp_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KCP')
					->get()->result());	

		$data['total_kk_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KK')
					->get()->result());			

		$data['total_unit_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('kode_op_asli',1)
					->where('tipe_uker','UNIT')
					->get()->result());
					
		$data['total_atm_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','ATM')
					->get()->result());		
					
					
	
		
		$data['total_remote_offline_less_1_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					->get()->result());
		
		$data['total_remote_offline_1_4_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					->get()->result());					
		
		$data['total_remote_offline_4_12_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					->get()->result());					
		
		$data['total_remote_offline_12_24_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					->get()->result());	
					
		$data['total_remote_offline_1_5_day'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());	

		$data['total_remote_offline_more_5_day'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());
		
		
		
		/* $data['total_remote_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm>','0')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_unack_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm','2')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_ack_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm','3')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_ack_alarm_define'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm','4')
					->where('status_name<>','NOP')
					->get()->result()); */
		
		
		$this->template->views('watch/maps_dashboard',$data);
	}
	
	

}

