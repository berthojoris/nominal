<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class H2h extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model(array('m_watch','m_dashboard'));

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
					->where('status_alarm>','0')
					->where('status_name<>','NOP')
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
						->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
						->where('status_name','OFFLINE')
						->get()->result();
			$data['judul'] = 'Remote Offline';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_less_1_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('status_alarm>','0')
					->where('status_name<>','NOP')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					->get()->result();
			$data['judul'] = 'Remote Offline Less 1 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_1_4_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					->get()->result();
			$data['judul'] = 'Remote Offline 1-4 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_4_12_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					->get()->result();
			$data['judul'] = 'Remote Offline 4-12 Hour';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_12_24_hour') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					->get()->result();	
			$data['judul'] = 'Remote Offline 12-24 Hours';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_1_5_day') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();
			$data['judul'] = 'Remote Offline 1-5 Days';
			
		}elseif ($this->uri->segment(3) == 'total_remote_offline_more_5_day') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();	
			$data['judul'] = 'Remote Offline More 5 Days';
		}elseif ($this->uri->segment(3) == 'total_kc_offline') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KC')
					->where('status_alarm>','0')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();	
			$data['judul'] = 'KC Offline';
		}elseif ($this->uri->segment(3) == 'total_kcp_offline') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KCP')
					->where('status_alarm>','0')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();	
			$data['judul'] = 'KCP Offline';
		}elseif ($this->uri->segment(3) == 'total_kk_offline') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KK')
					->where('status_alarm>','0')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();	
			$data['judul'] = 'KK Offline';
		}elseif ($this->uri->segment(3) == 'total_unit_offline') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('kode_op_asli',1)
					->where('tipe_uker','UNIT')
					->where('status_alarm>','0')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();	
			$data['judul'] = 'UNIT Offline';
		}elseif ($this->uri->segment(3) == 'total_atm_offline') {
			$data['data'] = $this->db->select('*')
					->from('v_all_remote')
					->join('tb_alarm_type', 'v_all_remote.id_alarm_type = tb_alarm_type.id','left')
					->where('status_name','OFFLINE')
					->where('tipe_uker','ATM')
					->where('status_alarm>','0')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result();	
			$data['judul'] = 'ATM Offline';
		}

		

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
		}

		//var_dump($data['data']);
		
		
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
					
					->where('kode_op_asli',1)
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
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
					->where('kode_op_asli',1)
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());
					
		$data['total_kcp_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KCP')
					->where('kode_op_asli',1)
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());	

		$data['total_kk_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KK')
					->where('kode_op_asli',1)
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-900)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());			

		$data['total_unit_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('kode_op_asli',1)
					->where('tipe_uker','UNIT')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-900)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());
					
		$data['total_atm_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','ATM')
					->where('kode_op_asli',1)
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());		
					
					
	
		
		$data['total_remote_offline_less_1_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
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
		

		

		$data['total_remote_offline_less_1_hour_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_offline_less_1_hour_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());

		$data['total_remote_offline_1_4_hour_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_offline_1_4_hour_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());

		$data['total_remote_offline_4_12_hour_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	
		$data['total_remote_offline_4_12_hour_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	

		$data['total_remote_offline_12_24_hour_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	
		$data['total_remote_offline_12_24_hour_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	

		$data['total_remote_offline_1_5_day_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	
		$data['total_remote_offline_1_5_day_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	

		$data['total_remote_offline_more_5_day_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_offline_more_5_day_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());


		
		 $data['total_remote_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm>','0')
					->where('status_name','OFFLINE')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_unack_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					//->where('status_alarm<','3')
					->where('id_alarm_type is NULL', NULL, FALSE)
					->where('status_alarm>','0')
					->where('status_name','OFFLINE')
					->where('status_name<>','NOP')
					->get()->result());
		/*$data['total_remote_ack_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm','3')
					->where('id_alarm_type is NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());*/
		$data['total_remote_ack_alarm_define'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm=','3')
					->where('id_alarm_type is NOT NULL', NULL, FALSE)
					->where('status_name','OFFLINE')
					->where('status_name<>','NOP')
					->get()->result());
		
		
		$this->template->views('watch/maps_dashboard',$data);
	}
	
	
	function militan_lebaran()
	{
		
		//$where = $this->uri->segment(3);
		//$where_count = substr_count($where,'-');
		$data['page'] = 'LEBARAN MILITAN';
		$data['title'] = 'LEBARAN WATCH 2019';

		//for ($i=0; $i < $where_count; $i++) { 
			$data['weekend_banking'] = $this->db->select("b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update, CASE WHEN b.status_name = 'OFFLINE' THEN 1 WHEN b.status_name = 'NOP' THEN 3 WHEN b.status_name = 'ONLINE' THEN 2 ELSE 4 END as urutan")
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('urutan','asc')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 
								 ->like('a.event','WEEKEND BANKING')
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();

			$data['online_weekend_banking'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','WEEKEND BANKING')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_weekend_banking'] = "<font style='background-color: Grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','WEEKEND BANKING')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_weekend_banking'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','WEEKEND BANKING')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";

			//echo $data['online_weekend_banking'];
			//echo $data['nop_weekend_banking'];
			//echo $data['offline_weekend_banking'];
			$data['title_weekend_banking'] = 'WEEKEND BANKING';

			$data['layanan_terbatas'] = $this->db->select("b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update, CASE WHEN b.status_name = 'OFFLINE' THEN 1 WHEN b.status_name = 'NOP' THEN 3 WHEN b.status_name = 'ONLINE' THEN 2 ELSE 4 END as urutan")
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','LAYANAN TERBATAS')
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();


			$data['online_layanan_terbatas'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','LAYANAN TERBATAS')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_layanan_terbatas'] = "<font style='background-color: grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','LAYANAN TERBATAS')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_layanan_terbatas'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','LAYANAN TERBATAS')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			//$data['page'] = $where.'-reporting';
			$data['title_layanan_terbatas'] = 'Layanan Terbatas';
		//}








			#======================================================
		
		$data['posko'] = $this->db->select("b.*,a.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update, CASE WHEN b.status_name = 'OFFLINE' THEN 1 WHEN b.status_name = 'NOP' THEN 3 WHEN b.status_name = 'ONLINE' THEN 2 ELSE 4 END as urutan")
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('urutan','asc')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 
								 ->like('a.event','POSKO')
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();

			$data['online_posko'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','POSKO')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_posko'] = "<font style='background-color: Grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','POSKO')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_posko'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','POSKO')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";

			//echo $data['online_weekend_banking'];
			//echo $data['nop_weekend_banking'];
			//echo $data['offline_weekend_banking'];
			$data['title_posko'] = 'Posko';

			$data['atm_prioritas'] = $this->db->select("b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update, CASE WHEN b.status_name = 'OFFLINE' THEN 1 WHEN b.status_name = 'NOP' THEN 3 WHEN b.status_name = 'ONLINE' THEN 2 ELSE 4 END as urutan")
								 ->from('v_all_remote b')
								 ->join('tb_militan a','b.id_remote=a.id_remote','left')
								 ->order_by('urutan','asc')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','ATM PRIORITAS 2019')
								 //->group_by("a.id_remote") 
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();




			$data['online_atm_prioritas'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','ATM PRIORITAS 2019')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_atm_prioritas'] = "<font style='background-color: grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','ATM PRIORITAS 2019')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_atm_prioritas'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','ATM PRIORITAS 2019')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			//$data['page'] = $where.'-reporting';
			$data['title_atm_prioritas'] = 'ATM Prioritas';



		//echo $where;
		/*if ($where!=null) {
			$data['data'] = $this->db->select('b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event',$where)
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();
			$data['page'] = $where.'-reporting';
			$data['title'] = 'Branch Monitoring';
		}else{
			$data['data'] = $this->db->select('b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 // ->where_in('kode_op',array(1,2))
								 // ->limit(100,0)
								 ->get()
									 ->result();
			$data['page'] = 'naru-reporting';
			$data['title'] = 'NARU Monitoring';
		}*/


		/*for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
			
		}*/

		$this->template->views('watch/militan',$data);
	}




	function tangara_test()
	{

		$data['page'] = 'tangara-test';
		$data['title'] = 'Tangara Test';
		
		//$data['watch_1'] = 'KC';
		//$data['watch_2'] = 'KCP';
		//$main_branches = $this->m_watch->get_main_branch('2');
		$data['tangara_test'] = $this->db->select("b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update, CASE WHEN b.status_name = 'OFFLINE' THEN 1 WHEN b.status_name = 'NOP' THEN 3 WHEN b.status_name = 'ONLINE' THEN 2 ELSE 4 END as urutan")
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('urutan','asc')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 
								 ->like('a.event','TANGARA TEST')
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();		
		
		$this->template->views('watch/tangara_test',$data);
	}




	function militan_lebaran_v2()
	{
		
		//$where = $this->uri->segment(3);
		//$where_count = substr_count($where,'-');
		$data['page'] = 'LEBARAN MILITAN';
		$data['title'] = 'LEBARAN WATCH 2019';

		//for ($i=0; $i < $where_count; $i++) { 
			$data['weekend_banking'] = $this->db->select("b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update, CASE WHEN b.status_name = 'OFFLINE' THEN 1 WHEN b.status_name = 'NOP' THEN 3 WHEN b.status_name = 'ONLINE' THEN 2 ELSE 4 END as urutan")
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('urutan','asc')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 
								 ->like('a.event','WEEKEND BANKING')
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();

			$data['total_weekend_banking']="Total Site (".count($data['weekend_banking']).")";

			$data['online_weekend_banking'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','WEEKEND BANKING')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_weekend_banking'] = "<font style='background-color: Grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','WEEKEND BANKING')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_weekend_banking'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','WEEKEND BANKING')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";

			//echo $data['online_weekend_banking'];
			//echo $data['nop_weekend_banking'];
			//echo $data['offline_weekend_banking'];
			$data['title_weekend_banking'] = 'WEEKEND BANKING';

			$data['layanan_terbatas'] = $this->db->select("b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update, CASE WHEN b.status_name = 'OFFLINE' THEN 1 WHEN b.status_name = 'NOP' THEN 3 WHEN b.status_name = 'ONLINE' THEN 2 ELSE 4 END as urutan")
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','LAYANAN TERBATAS')
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();

			$data['total_layanan_terbatas']="<font >Total Site (".count($data['layanan_terbatas']).")</font>";

			$data['online_layanan_terbatas'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','LAYANAN TERBATAS')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_layanan_terbatas'] = "<font style='background-color: grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','LAYANAN TERBATAS')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_layanan_terbatas'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','LAYANAN TERBATAS')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			//$data['page'] = $where.'-reporting';
			$data['title_layanan_terbatas'] = 'Layanan Terbatas';
		//}


			#======================================================
		
		$data['posko'] = $this->db->select("b.*,a.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update, CASE WHEN b.status_name = 'OFFLINE' THEN 1 WHEN b.status_name = 'NOP' THEN 3 WHEN b.status_name = 'ONLINE' THEN 2 ELSE 4 END as urutan")
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('urutan','asc')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 
								 ->like('a.event','POSKO')
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();

			$data['total_posko']="<font >Total Site (".count($data['posko']).")</font>";		 

			$data['online_posko'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','POSKO')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_posko'] = "<font style='background-color: Grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','POSKO')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_posko'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','POSKO')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";

			$data['title_posko'] = 'Posko';



		$this->template->views('watch/militan_v2',$data);
	}


	function dirkom()
	{
		
		//$where = $this->uri->segment(3);
		//$where_count = substr_count($where,'-');
		$data['page'] = 'Direksi & Komisaris Location Priority';
		$data['title'] = 'DIREKSI KOMISARIS PRIORITY';

		//for ($i=0; $i < $where_count; $i++) { 
		$data['direksi'] = $this->db->select("*")
								 ->from('tb_militan a')
								 ->group_by("nama")
								 ->like('a.event','DIREKSI')
								 ->get()
								 ->result();
			//echo count($data['direksi']);
			$data['data_direksi'] = array();
			$j=0;
			foreach ($data['direksi'] as $datas) {
				$i=0;
				$data['data_direksi'][$j] = $this->db->select("*")
					->from('tb_militan a')
					->join('v_all_remote b','b.id_remote=a.id_remote','left')
					->like('a.event','DIREKSI')
					->where('a.nama',$datas->nama)
					->get()
					->result();
				$j++;
			}

			$data['total_direksi']="Total Site (".count($data['direksi']).")";

			$data['online_direksi'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','DIREKSI')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_direksi'] = "<font style='background-color: Grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','DIREKSI')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_direksi'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','DIREKSI')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['title_direksi'] = 'DIREKSI';

			$data['komisaris'] = $this->db->select("*")
								 ->from('tb_militan a')
								 ->group_by("nama")
								 ->like('a.event','KOMISARIS')
								 ->get()
								 ->result();
			//echo count($data['direksi']);
			$data['data_komisaris'] = array();
			$j=0;
			foreach ($data['komisaris'] as $datas) {
				$i=0;
				$data['data_komisaris'][$j] = $this->db->select("*")
					->from('tb_militan a')
					->join('v_all_remote b','b.id_remote=a.id_remote','left')
					->like('a.event','KOMISARIS')
					->where('a.nama',$datas->nama)
					->get()
					->result();
				$j++;
			}

			$data['total_komisaris']="Total Site (".count($data['komisaris']).")";

			$data['online_komisaris'] = "<font style='background-color: green;'>Online (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','KOMISARIS')
								 ->where('b.status',3)
								 // ->limit(100,0)
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['nop_komisaris'] = "<font style='background-color: grey;'>NOP (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','KOMISARIS')
								 ->where("(status=1 AND kode_op=2) OR (kode_op='active' AND status=1 AND (kode_tipe_uker=10 OR kode_tipe_uker=6 OR kode_tipe_uker=11 OR kode_tipe_uker=13))")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			$data['offline_komisaris'] = "<font style='background-color: red;'>Offline (".$this->db->select('count(*) as total')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event','KOMISARIS')
								 ->where("status=1 AND kode_op=1")
								 // ->limit(100,0)$datas->status==1 && $datas->kode_op==2 || ( $datas->kode_op==1 && $datas->status==1 && in_array($datas->kode_tipe_uker, array(10,6,11,13)) 
								 ->get()
								 ->result()[0]->total.")</font>";
			//$data['page'] = $where.'-reporting';
			$data['title_komisaris'] = 'KOMISARIS';
		//}


			#======================================================
		

		$this->template->views('watch/dirkom',$data);
	}


	function office_region()
	{

		$data['page'] = 'office-watch';
		$data['title'] = 'Kanins, Sendik, Kanwil Watch';
		
		$data['watch_1'] = 'Office Region';
		//$data['watch_2'] = 'KCP';
		$where = "kode_tipe_uker=0 OR kode_tipe_uker=1";
		$main_branches = $this->m_watch->get_branch_by_type($where);
		$data['office_data']= $main_branches;
		for ($i=0; $i < count($main_branches) ; $i++) { 
			$remote = $main_branches[$i];
			$data['jarkom_main_branch'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		
		$this->template->views('watch/office_watch',$data);
	}


	function weathermap_dc()
	{

		$data['page'] = 'IDC';
		$data['title'] = 'Kanins, Sendik, Kanwil Watch';
				
		
		$this->load->view('watch/dashboard_reload',$data);
	}

}

